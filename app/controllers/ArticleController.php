<?php

namespace App\controllers;

use App\View;
use App\models\Article;
use App\models\Category;
use Core\Session;
use Router\Router;
use Valitron\Validator;

class ArticleController extends Controller
{
    private function ensureSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['auth']);
    }

    private function authorize(): void
    {
        if (!$this->ensureSession()) {
            header('Location: ' . Router::route('/'));
            exit;
        }

        if (!Session::ensureRole('semi-admin', $_SESSION['user']['role'])) {
            Router::respondWithError(403);
            exit;
        }
    }

    private function uploadDir(): string
    {
        return dirname(__DIR__, 2) . '/public/uploads/articles/';
    }

    private function handleImageUpload(?array $file, ?string $existing = null): ?string
    {
        if ($file === null || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return $existing;
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            Session::flash('error', 'Échec du téléversement de l’image.');
            return null;
        }

        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        if (!in_array($mime, $allowed, true)) {
            Session::flash('error', 'Format d’image non supporté (JPG, PNG, WebP, GIF uniquement).');
            return null;
        }

        if (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            Session::flash('error', 'L’image ne doit pas dépasser 5 Mo.');
            return null;
        }

        $dir = $this->uploadDir();
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            Session::flash('error', 'Impossible de créer le dossier de téléversement.');
            return null;
        }

        $ext = match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            default => 'jpg',
        };

        $filename = 'article_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $destination = $dir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            Session::flash('error', 'Impossible d’enregistrer l’image.');
            return null;
        }

        if ($existing && is_file(dirname(__DIR__, 2) . '/public' . $existing)) {
            @unlink(dirname(__DIR__, 2) . '/public' . $existing);
        }

        return '/uploads/articles/' . $filename;
    }

    public function index(): void
    {
        $this->authorize();

        $filters = [
            'status' => $_GET['status'] ?? '',
            'category_id' => $_GET['category_id'] ?? '',
            'q' => trim($_GET['q'] ?? ''),
        ];

        $articles = new Article();
        $categories = new Category();

        View::view('admin.articles.index', [
            'pageTitle' => 'Articles',
            'articles' => $articles->findFiltered($filters),
            'categories' => $categories->all(),
            'filters' => $filters,
        ], 'layouts.admin');
    }

    public function create(): void
    {
        $this->authorize();

        $categories = new Category();
        View::view('admin.articles.create', [
            'pageTitle' => 'Nouvel article',
            'categories' => $categories->all(),
            'old' => $_SESSION['old_input'] ?? [],
        ], 'layouts.admin');
        unset($_SESSION['old_input']);
    }

    public function store(): void
    {
        $this->authorize();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . Router::route('/admin/articles/create'));
            exit;
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'status' => $_POST['status'] ?? 'pending',
            'category' => $_POST['category'] ?? '',
            'link' => trim($_POST['link'] ?? ''),
        ];

        $v = new Validator($data);
        $v->rule('required', ['title', 'content', 'status']);
        $v->rule('lengthMax', 'title', 255);
        $v->rule('in', 'status', ['pending', 'published']);
        $v->labels([
            'title' => 'Titre',
            'content' => 'Contenu',
            'status' => 'Statut',
        ]);

        if (!$v->validate()) {
            $_SESSION['old_input'] = $data;
            $errors = $v->errors();
            $first = reset($errors);
            Session::flash('error', is_array($first) ? $first[0] : 'Formulaire invalide.');
            header('Location: ' . Router::route('/admin/articles/create'));
            exit;
        }

        $imagePath = $this->handleImageUpload($_FILES['image'] ?? null);
        if ($imagePath === null && isset($_FILES['image']) && ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            $_SESSION['old_input'] = $data;
            header('Location: ' . Router::route('/admin/articles/create'));
            exit;
        }

        $articles = new Article();
        $ok = $articles->create([
            'title' => $data['title'],
            'excerpt' => $data['excerpt'] ?: null,
            'content' => $data['content'],
            'status' => $data['status'],
            'category_id' => $data['category'] !== '' ? (int) $data['category'] : null,
            'user_id' => (int) ($_SESSION['user']['id'] ?? 0) ?: null,
            'image' => $imagePath,
            'link' => $data['link'] ?: null,
            'sort_order' => $articles->nextSortOrder(),
        ]);

        if (!$ok) {
            $_SESSION['old_input'] = $data;
            Session::flash('error', 'Impossible d’enregistrer l’article. Vérifiez la base de données.');
            header('Location: ' . Router::route('/admin/articles/create'));
            exit;
        }

        Session::flash('success', 'Article créé avec succès.');
        header('Location: ' . Router::route('/admin/articles'));
        exit;
    }

    public function show(array $params): void
    {
        $this->authorize();

        $articles = new Article();
        $article = $articles->findOne((int) $params['id']);

        if (!$article) {
            Router::respondWithError(404);
            exit;
        }

        View::view('admin.articles.show', [
            'pageTitle' => $article->title ?: 'Article',
            'article' => $article,
        ], 'layouts.admin');
    }

    public function edit(array $params): void
    {
        $this->authorize();

        $articles = new Article();
        $article = $articles->findOne((int) $params['id']);

        if (!$article) {
            Router::respondWithError(404);
            exit;
        }

        $categories = new Category();
        View::view('admin.articles.edit', [
            'pageTitle' => 'Modifier l’article',
            'article' => $article,
            'categories' => $categories->all(),
        ], 'layouts.admin');
    }

    public function update($params): void
    {
        $this->authorize();

        $id = (int) ($params['id'] ?? 0);
        $articles = new Article();
        $article = $articles->findOne($id);

        if (!$article) {
            Router::respondWithError(404);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . Router::route('/admin/articles/' . $id . '/edit'));
            exit;
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'status' => $_POST['status'] ?? 'pending',
            'category' => $_POST['category'] ?? '',
            'link' => trim($_POST['link'] ?? ''),
            'sort_order' => (int) ($_POST['sort_order'] ?? $article->sort_order),
        ];

        $v = new Validator($data);
        $v->rule('required', ['title', 'content', 'status']);
        $v->rule('lengthMax', 'title', 255);
        $v->rule('in', 'status', ['pending', 'published']);
        $v->labels([
            'title' => 'Titre',
            'content' => 'Contenu',
            'status' => 'Statut',
        ]);

        if (!$v->validate()) {
            $errors = $v->errors();
            $first = reset($errors);
            Session::flash('error', is_array($first) ? $first[0] : 'Formulaire invalide.');
            header('Location: ' . Router::route('/admin/articles/' . $id . '/edit'));
            exit;
        }

        $imagePath = $this->handleImageUpload($_FILES['image'] ?? null, $article->image ?? null);
        if ($imagePath === null && isset($_FILES['image']) && ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            header('Location: ' . Router::route('/admin/articles/' . $id . '/edit'));
            exit;
        }

        $ok = $articles->update([
            'title' => $data['title'],
            'excerpt' => $data['excerpt'] ?: null,
            'content' => $data['content'],
            'status' => $data['status'],
            'category_id' => $data['category'] !== '' ? (int) $data['category'] : null,
            'image' => $imagePath ?? $article->image,
            'link' => $data['link'] ?: null,
            'sort_order' => $data['sort_order'],
        ], $id);

        if (!$ok) {
            Session::flash('error', 'Impossible de mettre à jour l’article.');
            header('Location: ' . Router::route('/admin/articles/' . $id . '/edit'));
            exit;
        }

        Session::flash('success', 'Article mis à jour avec succès.');
        header('Location: ' . Router::route('/admin/articles'));
        exit;
    }

    public function delete($params): void
    {
        $this->authorize();

        $id = (int) ($params['id'] ?? 0);
        $articles = new Article();
        $article = $articles->findOne($id);

        if (!$article) {
            Router::respondWithError(404);
            exit;
        }

        if (!empty($article->image)) {
            $path = dirname(__DIR__, 2) . '/public' . $article->image;
            if (is_file($path)) {
                @unlink($path);
            }
        }

        $articles->delete($id);
        Session::flash('success', 'Article supprimé.');
        header('Location: ' . Router::route('/admin/articles'));
        exit;
    }

    public function reorder(array $params): void
    {
        $this->authorize();

        $id = (int) $params['id'];
        $direction = $_POST['direction'] ?? 'up';
        if (!in_array($direction, ['up', 'down'], true)) {
            $direction = 'up';
        }

        $articles = new Article();
        if (!$articles->findOne($id)) {
            Router::respondWithError(404);
            exit;
        }

        $moved = $articles->move($id, $direction);
        Session::flash(
            $moved ? 'success' : 'warning',
            $moved ? 'Ordre mis à jour.' : 'Impossible de déplacer davantage cet article.'
        );
        header('Location: ' . Router::route('/admin/articles'));
        exit;
    }
    public function articles(): void
    {
        $articles = new Article();
        $articles = $articles->findAll();
       $this->status(200)->json($articles);
    }
}

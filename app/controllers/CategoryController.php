<?php

namespace App\controllers;

use App\models\Category;
use App\View;
use Core\Session;
use Router\Router;

class CategoryController extends Controller
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

    public function index(): void
    {
        $this->authorize();
        $categories = new Category();

        View::view('admin.categories.index', [
            'pageTitle' => 'Catégories',
            'categories' => $categories->all(),
        ], 'layouts.admin');
    }

    public function create(): void
    {
        $this->authorize();
        View::view('admin.categories.create', [
            'pageTitle' => 'Nouvelle catégorie',
        ], 'layouts.admin');
    }

    public function show(array $params): void
    {
        $this->authorize();
        $category = new Category();
        $item = $category->findBy(['id' => (int) $params['id']], \PDO::FETCH_OBJ);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        View::view('admin.categories.show', [
            'pageTitle' => $item->name,
            'category' => $item,
        ], 'layouts.admin');
    }

    public function update($params): void
    {
        $this->authorize();
        $category = new Category();
        $item = $category->findBy(['id' => (int) $params['id']], \PDO::FETCH_OBJ);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if ($name === '') {
                Session::flash('error', 'Le nom de la catégorie est requis.');
                header('Location: ' . Router::route('/admin/categories/' . (int) $params['id'] . '/edit'));
                exit;
            }

            $category->update(['name' => $name], (int) $params['id']);
            Session::flash('success', 'Catégorie mise à jour.');
            header('Location: ' . Router::route('/admin/categories'));
            exit;
        }
    }

    public function store(): void
    {
        $this->authorize();
        $category = new Category();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if ($name === '') {
                Session::flash('error', 'Le nom de la catégorie est requis.');
                header('Location: ' . Router::route('/admin/categories/create'));
                exit;
            }

            $category->create(['name' => $name]);
            Session::flash('success', 'Catégorie créée avec succès.');
            header('Location: ' . Router::route('/admin/categories'));
            exit;
        }
    }

    public function edit(array $params): void
    {
        $this->authorize();
        $category = new Category();
        $item = $category->findBy(['id' => (int) $params['id']], \PDO::FETCH_OBJ);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        View::view('admin.categories.edit', [
            'pageTitle' => 'Modifier la catégorie',
            'category' => $item,
        ], 'layouts.admin');
    }

    public function delete($params): void
    {
        $this->authorize();
        $category = new Category();
        $item = $category->findBy(['id' => (int) $params['id']], \PDO::FETCH_OBJ);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        $category->delete((int) $params['id']);
        Session::flash('success', 'Catégorie supprimée.');
        header('Location: ' . Router::route('/admin/categories'));
        exit;
    }
}

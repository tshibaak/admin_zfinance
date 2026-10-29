<?php

namespace App\controllers;

use App\models\TestimonialModel;
use App\View;
use Core\Session;
use Router\Router;
use Valitron\Validator;

class TestiMonialController extends Controller
{
    public function index(): void
    {
        $this->authorizeSemiAdmin();

        $model = new TestimonialModel();
        $q = trim($_GET['q'] ?? '');
        $list = $model->findAll();

        if ($q !== '') {
            $needle = mb_strtolower($q);
            $list = array_values(array_filter(
                $list,
                static function ($t) use ($needle) {
                    $hay = mb_strtolower(($t->author ?? '') . ' ' . ($t->company ?? '') . ' ' . ($t->message ?? ''));
                    return str_contains($hay, $needle);
                }
            ));
        }

        View::view('admin.testimonials.index', [
            'pageTitle' => 'Témoignages',
            'testimonials' => $list,
            'total' => $model->countAll(),
            'filters' => ['q' => $q],
        ], 'layouts.admin');
    }

    public function create(): void
    {
        $this->authorizeSemiAdmin();

        View::view('admin.testimonials.create', [
            'pageTitle' => 'Nouveau témoignage',
            'old' => $_SESSION['old_input'] ?? [],
        ], 'layouts.admin');
        unset($_SESSION['old_input']);
    }

    public function store(): void
    {
        $this->authorizeSemiAdmin();

        $data = [
            'author' => trim($_POST['author'] ?? ''),
            'company' => trim($_POST['company'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'rating' => (int) ($_POST['rating'] ?? 5),
        ];

        $v = new Validator($data);
        $v->rule('required', ['author', 'message']);
        $v->rule('integer', 'rating');
        $v->rule('min', 'rating', 1);
        $v->rule('max', 'rating', 5);
        $v->labels(['author' => 'Auteur', 'message' => 'Message', 'rating' => 'Note']);

        if (!$v->validate()) {
            $_SESSION['old_input'] = $data;
            $errors = $v->errors();
            $first = reset($errors);
            Session::flash('error', is_array($first) ? $first[0] : 'Formulaire invalide.');
            header('Location: ' . Router::route('/admin/temoignages/create'));
            exit;
        }

        (new TestimonialModel())->create($data);
        Session::flash('success', 'Témoignage créé avec succès.');
        header('Location: ' . Router::route('/admin/temoignages'));
        exit;
    }

    public function show(array $params): void
    {
        $this->authorizeSemiAdmin();

        $item = (new TestimonialModel())->findOne((int) $params['id']);
        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        View::view('admin.testimonials.show', [
            'pageTitle' => 'Témoignage #' . $item->id,
            'testimonial' => $item,
        ], 'layouts.admin');
    }

    public function edit(array $params): void
    {
        $this->authorizeSemiAdmin();

        $item = (new TestimonialModel())->findOne((int) $params['id']);
        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        View::view('admin.testimonials.edit', [
            'pageTitle' => 'Modifier le témoignage',
            'testimonial' => $item,
        ], 'layouts.admin');
    }

    public function update($params): void
    {
        $this->authorizeSemiAdmin();

        $id = (int) ($params['id'] ?? 0);
        $model = new TestimonialModel();
        $item = $model->findOne($id);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        $data = [
            'author' => trim($_POST['author'] ?? ''),
            'company' => trim($_POST['company'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'rating' => (int) ($_POST['rating'] ?? 5),
        ];

        $v = new Validator($data);
        $v->rule('required', ['author', 'message']);
        $v->rule('integer', 'rating');
        $v->rule('min', 'rating', 1);
        $v->rule('max', 'rating', 5);

        if (!$v->validate()) {
            $errors = $v->errors();
            $first = reset($errors);
            Session::flash('error', is_array($first) ? $first[0] : 'Formulaire invalide.');
            header('Location: ' . Router::route('/admin/temoignages/' . $id . '/edit'));
            exit;
        }

        $model->update($data, $id);
        Session::flash('success', 'Témoignage mis à jour.');
        header('Location: ' . Router::route('/admin/temoignages'));
        exit;
    }

    public function delete($params): void
    {
        $this->authorizeSemiAdmin();

        $id = (int) ($params['id'] ?? 0);
        $model = new TestimonialModel();

        if (!$model->findOne($id)) {
            Router::respondWithError(404);
            exit;
        }

        $model->delete($id);
        Session::flash('success', 'Témoignage supprimé.');
        header('Location: ' . Router::route('/admin/temoignages'));
        exit;
    }
}

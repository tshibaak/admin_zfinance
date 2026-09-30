<?php

namespace App\controllers;

use App\models\Subscriber;
use App\View;
use Core\Session;
use Helper\String\Stringy;
use Router\Router;

class SubscriberController extends Controller
{
    public function index(): void
    {
        $this->authorizeSemiAdmin();

        $model = new Subscriber();
        $q = trim($_GET['q'] ?? '');
        $list = $model->findAll();

        if ($q !== '') {
            $needle = mb_strtolower($q);
            $list = array_values(array_filter(
                $list,
                static fn($s) => str_contains(mb_strtolower($s->email ?? ''), $needle)
            ));
        }

        View::view('admin.newsletter.index', [
            'pageTitle' => 'Newsletter',
            'subscribers' => $list,
            'total' => $model->countAll(),
            'filters' => ['q' => $q],
        ], 'layouts.admin');
    }

    public function create(): void
    {
        $this->authorizeSemiAdmin();

        View::view('admin.newsletter.create', [
            'pageTitle' => 'Ajouter un abonné',
            'old' => $_SESSION['old_input'] ?? [],
        ], 'layouts.admin');
        unset($_SESSION['old_input']);
    }

    public function storeAdmin(): void
    {
        $this->authorizeSemiAdmin();

        $email = trim($_POST['email'] ?? '');

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['old_input'] = ['email' => $email];
            Session::flash('error', 'Adresse email invalide.');
            header('Location: ' . Router::route('/admin/subscribers/create'));
            exit;
        }

        $model = new Subscriber();
        if ($model->findByEmail($email)) {
            $_SESSION['old_input'] = ['email' => $email];
            Session::flash('error', 'Cet email est déjà inscrit.');
            header('Location: ' . Router::route('/admin/subscribers/create'));
            exit;
        }

        $model->create($email);
        Session::flash('success', 'Abonné ajouté avec succès.');
        header('Location: ' . Router::route('/admin/subscribers'));
        exit;
    }

    public function edit(array $params): void
    {
        $this->authorizeSemiAdmin();

        $model = new Subscriber();
        $subscriber = $model->findOne((int) $params['id']);

        if (!$subscriber) {
            Router::respondWithError(404);
            exit;
        }

        View::view('admin.newsletter.edit', [
            'pageTitle' => 'Modifier l’abonné',
            'subscriber' => $subscriber,
        ], 'layouts.admin');
    }

    public function update($params): void
    {
        $this->authorizeSemiAdmin();

        $id = (int) ($params['id'] ?? 0);
        $model = new Subscriber();
        $subscriber = $model->findOne($id);

        if (!$subscriber) {
            Router::respondWithError(404);
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('error', 'Adresse email invalide.');
            header('Location: ' . Router::route('/admin/subscribers/' . $id . '/edit'));
            exit;
        }

        $existing = $model->findByEmail($email);
        if ($existing && (int) $existing->id !== $id) {
            Session::flash('error', 'Cet email est déjà utilisé par un autre abonné.');
            header('Location: ' . Router::route('/admin/subscribers/' . $id . '/edit'));
            exit;
        }

        $model->updateEmail($id, $email);
        Session::flash('success', 'Abonné mis à jour.');
        header('Location: ' . Router::route('/admin/subscribers'));
        exit;
    }

    public function delete($params): void
    {
        $this->authorizeSemiAdmin();

        $id = (int) ($params['id'] ?? 0);
        $model = new Subscriber();

        if (!$model->findOne($id)) {
            Router::respondWithError(404);
            exit;
        }

        $model->delete($id);
        Session::flash('success', 'Abonné supprimé.');
        header('Location: ' . Router::route('/admin/subscribers'));
        exit;
    }

    /** API publique — inscription site. */
    public function store(): void
    {
        $email = ($this->inputs())['email'] ?? '';

        if (!Stringy::empty($email)) {
            $this->status(422)->json([
                'status' => 'error',
                'message' => 'Email manquant',
            ]);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status(422)->json([
                'status' => 'error',
                'message' => 'Email invalide',
            ]);
            return;
        }

        try {
            $model = new Subscriber();
            if ($model->findByEmail($email)) {
                $this->status(409)->json([
                    'status' => 'error',
                    'message' => 'Email déjà enregistré',
                ]);
                return;
            }

            $model->create($email);

            $this->status(200)->json([
                'status' => 'success',
                'message' => 'Email enregistré avec succès',
                'data' => ['email' => $email],
            ]);
        } catch (\PDOException $e) {
            $this->status(500)->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
            ]);
        }
    }
}

<?php

namespace App\controllers;

use App\models\ContactModel;
use App\View;
use Core\Session;
use Helper\Build\Database;
use Router\Router;

class ContactController extends Controller
{
    public function index(): void
    {
        $this->authorizeSemiAdmin();

        $contacts = new ContactModel();
        $filters = [
            'statut' => $_GET['statut'] ?? '',
            'q' => trim($_GET['q'] ?? ''),
        ];

        $list = $contacts->findAll();
        if ($filters['statut'] !== '') {
            $list = array_values(array_filter(
                $list,
                static fn($c) => ($c->statut ?? '') === $filters['statut']
            ));
        }
        if ($filters['q'] !== '') {
            $q = mb_strtolower($filters['q']);
            $list = array_values(array_filter(
                $list,
                static function ($c) use ($q) {
                    $hay = mb_strtolower(
                        ($c->name ?? '') . ' ' . ($c->email ?? '') . ' ' . ($c->sujet ?? '') . ' ' . ($c->message ?? '')
                    );
                    return str_contains($hay, $q);
                }
            ));
        }

        View::view('admin.contacts.index', [
            'pageTitle' => 'Messages contact',
            'contacts' => $list,
            'pendings' => $contacts->countUnread(),
            'filters' => $filters,
        ], 'layouts.admin');
    }

    public function show(array $params): void
    {
        $this->authorizeSemiAdmin();

        $model = new ContactModel();
        $contact = $model->findOne((int) $params['id']);

        if (!$contact) {
            Router::respondWithError(404);
            exit;
        }

        if (($contact->statut ?? '') === 'non_lu') {
            $model->markAsRead((int) $contact->id);
            $contact->statut = 'lu';
        }

        View::view('admin.contacts.show', [
            'pageTitle' => 'Message #' . $contact->id,
            'contact' => $contact,
        ], 'layouts.admin');
    }

    public function markRead(array $params): void
    {
        $this->authorizeSemiAdmin();

        $model = new ContactModel();
        $contact = $model->findOne((int) $params['id']);

        if (!$contact) {
            Router::respondWithError(404);
            exit;
        }

        $model->markAsRead((int) $contact->id);
        Session::flash('success', 'Message marqué comme lu.');
        header('Location: ' . Router::route('/admin/contacts'));
        exit;
    }

    public function markUnread(array $params): void
    {
        $this->authorizeSemiAdmin();

        $model = new ContactModel();
        $contact = $model->findOne((int) $params['id']);

        if (!$contact) {
            Router::respondWithError(404);
            exit;
        }

        $model->markAsUnread((int) $contact->id);
        Session::flash('success', 'Message marqué comme non lu.');
        header('Location: ' . Router::route('/admin/contacts'));
        exit;
    }

    public function delete($params): void
    {
        $this->authorizeSemiAdmin();

        $id = (int) ($params['id'] ?? 0);
        $model = new ContactModel();
        $contact = $model->findOne($id);

        if (!$contact) {
            Router::respondWithError(404);
            exit;
        }

        $model->delete($id);
        Session::flash('success', 'Message supprimé.');
        header('Location: ' . Router::route('/admin/contacts'));
        exit;
    }

    /** API publique — formulaire site. */
    public function store(): void
    {
        $datas = $this->inputs();

        $required = ['name', 'email', 'sujet', 'message'];
        foreach ($required as $field) {
            if (empty($datas[$field])) {
                $this->status(422)->json([
                    'status' => 'error',
                    'message' => "Le champ '$field' est obligatoire",
                ]);
            }
        }

        $email = filter_var($datas['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status(422)->json([
                'status' => 'error',
                'message' => 'Email invalide',
            ]);
            return;
        }

        try {
            Database::Instance()->prepare(
                'INSERT INTO contacts (name, email, phone, sujet, message) VALUES (?, ?, ?, ?, ?)',
                [
                    $datas['name'],
                    $email,
                    $datas['phone'] ?? null,
                    $datas['sujet'],
                    $datas['message'],
                ]
            );

            $this->status(201)->json([
                'status' => 'success',
                'message' => 'Contact enregistré avec succès',
                'data' => [
                    'name' => $datas['name'],
                    'email' => $email,
                    'sujet' => $datas['sujet'],
                ],
            ]);
        } catch (\PDOException $e) {
            $this->status(500)->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
            ]);
        }
    }

    /** API — marquer lu (legacy front). */
    public function read(mixed $id): void
    {
        $id = (int) ($id['id'] ?? $id);

        try {
            if ($id <= 0) {
                $this->status(422)->json([
                    'status' => 'error',
                    'message' => 'ID invalide',
                ]);
                return;
            }

            $model = new ContactModel();
            if (!$model->findOne($id)) {
                $this->status(404)->json([
                    'status' => 'error',
                    'message' => 'Message introuvable',
                ]);
                return;
            }

            $model->markAsRead($id);

            $this->status(200)->json([
                'status' => 'success',
                'message' => 'Message marqué comme lu',
                'data' => ['id' => $id],
            ]);
        } catch (\PDOException $e) {
            $this->status(500)->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
            ]);
        }
    }
}

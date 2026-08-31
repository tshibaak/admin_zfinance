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
     
        View::view('admin.categories.index', ['categories' => $categories->all()]);
    }

    public function create(): void
    {
        $this->authorize();
        View::view('admin.categories.create');
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

        View::view('admin.categories.show', ['category' => $item]);
    }

    public function update($params)
    {
        $this->authorize();
        $category = new Category();
        $item = $category->findBy(['id' => (int) $params['id']], \PDO::FETCH_OBJ);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                Router::respondWithError(400, 'Le nom de la catégorie est requis.');
                exit;
            }

            $category->update(['name' => $name], (int) $params['id']);
            header('Location: ' . Router::route('/admin/categories'));
            exit;
        }
    }
   
    public function store(): void
    {
        $this->authorize();
        $category = new Category();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                Router::respondWithError(400, 'Le nom de la catégorie est requis.');
                exit;
            }

            $category->create(['name' => $name ]);
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

        View::view('admin.categories.edit', ['category' => $item]);
    }

    public function delete($params)
    {
        $this->authorize();
        $category = new Category();
        $item = $category->findBy(['id' => (int) $params['id']], \PDO::FETCH_OBJ);

        if (!$item) {
            Router::respondWithError(404);
            exit;
        }

        $category->delete((int) $params['id']);
        header('Location: ' . Router::route('/admin/categories'));
        exit;
    }
}

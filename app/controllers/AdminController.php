<?php

namespace App\controllers;

use App\View;
use App\models\ContactModel;
use App\models\Subscriber;
use App\models\TestimonialModel;
use Router\Router;

class AdminController extends Controller
{
    private function ensureAdminSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['admin_logged']);
    }

    public function index()
    {
        if (!$this->ensureAdminSession()) {
            header('Location:'. Router::route('/'));
            exit;
        }

        $contactModel = new ContactModel();
        $subscriberModel = new Subscriber();
        $testimonialModel = new TestimonialModel();

        View::view('admin.index', [
            'totalContacts' => $contactModel->countAll(),
            'totalSubscribers' => $subscriberModel->countAll(),
            'totalTestimonials' => $testimonialModel->countAll(),
            'unread' => $contactModel->countUnread(),
        ]);
    }


    public function testimonials()
    {
        if (!$this->ensureAdminSession()) {
            header('Location: '.  Router::route('/'));
            exit;
        }

        $testimonialModel = new TestimonialModel();
        View::view('admin.testimonials', [
            'testimonials' => $testimonialModel->findAll(),
        ]);
    }
}

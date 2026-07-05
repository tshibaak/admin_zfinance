<?php

namespace App\controllers;

use App\View;
use App\models\ContactModel;
use App\models\SubscriberModel;
use App\models\TestimonialModel;

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
        // if (!$this->ensureAdminSession()) {
        //     header('Location: /login');
        //     exit;
        // }

        $contactModel = new ContactModel();
        $subscriberModel = new SubscriberModel();
        $testimonialModel = new TestimonialModel();

        View::view('admin.index', [
            'totalContacts' => $contactModel->countAll(),
            'totalSubscribers' => $subscriberModel->countAll(),
            'totalTestimonials' => $testimonialModel->countAll(),
            'unread' => $contactModel->countUnread(),
        ]);
    }

    public function contacts()
    {
        // if (!$this->ensureAdminSession()) {
        //     header('Location: /login');
        //     exit;
        // }

        $contactModel = new ContactModel();
        View::view('admin.contacts', [
            'contacts' => $contactModel->findAll(),
        ]);
    }

    public function newsletter()
    {
        // if (!$this->ensureAdminSession()) {
        //     header('Location: /login');
        //     exit;
        // }

        $subscriberModel = new SubscriberModel();
        View::view('admin.newsletter', [
            'subscribers' => $subscriberModel->findAll(),
        ]);
    }

    public function testimonials()
    {
        // if (!$this->ensureAdminSession()) {
        //     header('Location: /login');
        //     exit;
        // }

        $testimonialModel = new TestimonialModel();
        View::view('admin.testimonials', [
            'testimonials' => $testimonialModel->findAll(),
        ]);
    }
}

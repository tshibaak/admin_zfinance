<?php

namespace App\controllers;

use App\View;
use App\models\Article;
use App\models\ContactModel;
use App\models\Subscriber;
use App\models\TestimonialModel;
use Router\Router;

class SemiAdminController extends Controller
{
    public function index(): void
    {
        $this->authorizeSemiAdmin();

        $contactModel = new ContactModel();
        $subscriberModel = new Subscriber();
        $testimonialModel = new TestimonialModel();
        $articleModel = new Article();

        $recentContacts = array_slice($contactModel->findAll(), 0, 5);
        $recentTestimonials = array_slice($testimonialModel->findAll(), 0, 3);

        View::view('admin.index', [
            'pageTitle' => 'Tableau de bord',
            'totalContacts' => $contactModel->countAll(),
            'totalSubscribers' => $subscriberModel->countAll(),
            'totalTestimonials' => $testimonialModel->countAll(),
            'totalArticles' => $articleModel->countAll(),
            'unread' => $contactModel->countUnread(),
            'recentContacts' => $recentContacts,
            'recentTestimonials' => $recentTestimonials,
        ], 'layouts.admin');
    }
}

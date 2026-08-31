<?php

namespace App\controllers;

use App\View;
use App\models\ContactModel;
use App\models\Subscriber;
use App\models\TestimonialModel;
use Router\Router;
use Core\Session;
class SemiAdminController extends Controller
{
    private function ensureSession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return !empty($_SESSION['auth']);
    }

    public function index()
    {
        if (!$this->ensureSession()) {
            header('Location:'. Router::route('/'));
            exit;
        }
        

        if(!Session::ensureRole('semi-admin',$_SESSION['user']['role'])){
            \Router\Router::respondWithError(403);
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



}

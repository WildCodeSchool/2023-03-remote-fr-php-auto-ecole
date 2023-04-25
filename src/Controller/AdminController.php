<?php

namespace App\Controller;

use App\Model\UserManager;

class AdminController extends AbstractController
{
    public function index()
    {
        if (!$this->user) {
            header('Location: /login');
            exit();
        }
        return $this->twig->render('Admin/index.html.twig');
    }

    public function login(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);

            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($credentials['email']);
            if ($user && password_verify($credentials['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /admin');
            }
        }
        return $this->twig->render('Admin/login.html.twig');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('Location: /');
    }
}

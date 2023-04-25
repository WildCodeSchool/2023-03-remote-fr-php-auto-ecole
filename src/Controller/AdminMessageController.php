<?php

namespace App\Controller;

class AdminMessageController extends AbstractController
{
    public function index()
    {
        if (!$this->user) {
            echo 'Unauthorized access';
            header('HTTP/1.1 401 Unauthorized');
            exit();
        }
        return $this->twig->render('Admin/Messages/index.html.twig');
    }
}

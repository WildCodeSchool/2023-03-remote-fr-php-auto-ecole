<?php

namespace App\Controller;

class MessageController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Message/index.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Model\LicenceManager;
use App\Model\MessageManager;
use App\Model\TrainingManager;

class MessageController extends AbstractController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {// soumission du form
            // clean $_POST data
            // $message = array_map('trim', $_POST);
            $message = $_POST;
             // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $messageManager = new MessageManager();
            $messageManager->insert($message);

            header('Location: /message/success');
            return null;
        }

        $trainingManager = new TrainingManager();
        $licenceManager = new LicenceManager();
        return $this->twig->render('Message/index.html.twig', [
            'trainings' => $trainingManager->selectAll(),
            'licences' => $licenceManager->selectAll()
        ]);
    }

    public function success()
    {
        return $this->twig->render('Message/success.html.twig');
    }
}

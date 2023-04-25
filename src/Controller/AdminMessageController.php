<?php

namespace App\Controller;

use App\Model\MessageManager;

class AdminMessageController extends AbstractController
{
    public function index()
    {
        if (!$this->user) {
            echo 'Unauthorized access';
            header('HTTP/1.1 401 Unauthorized');
            exit();
        }
        $messageManager = new MessageManager();
        return $this->twig->render('Admin/Messages/index.html.twig', [
            'messages' => $messageManager->selectAll()
        ]);
    }
}

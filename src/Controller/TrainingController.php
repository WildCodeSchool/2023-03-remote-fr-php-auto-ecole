<?php

namespace App\Controller;

use App\Model\TrainingManager;

class TrainingController extends AbstractController
{
    public function index()
    {
        $trainingManager = new TrainingManager();
        $trainings = $trainingManager->selectAll();
        return $this->twig->render('Training/index.html.twig', [
            'trainings' => $trainings
        ]);
    }
}

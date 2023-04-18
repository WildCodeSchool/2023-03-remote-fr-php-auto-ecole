<?php

namespace App\Controller;

use App\Model\LicenceManager;
use App\Model\TrainingManager;

class TrainingController extends AbstractController
{
    public function index()
    {
        $trainingManager = new TrainingManager();
        $trainings = $trainingManager->selectAll();
        $licenceManager = new LicenceManager();
        $licences = $licenceManager->selectAll();
        return $this->twig->render('Training/index.html.twig', [
            'trainings' => $trainings,
            'licences' => $licences
        ]);
    }
}

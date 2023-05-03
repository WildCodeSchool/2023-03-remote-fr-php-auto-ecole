<?php

namespace App\Controller;

use App\Model\LicenceManager;
use App\Model\TrainingManager;

class TrainingController extends AbstractController
{
    public function index()
    {
        $licenceManager = new LicenceManager();
        $licences = $licenceManager->selectAll();
        return $this->twig->render('Training/index.html.twig', [
            'licences' => $licences
        ]);
    }

    public function show(int $id)
    {
        $trainingManager = new TrainingManager();
        return $this->twig->render('Training/show.html.twig', [
            'training' => $trainingManager->selectOneById($id)
        ]);
    }
}

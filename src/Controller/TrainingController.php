<?php

namespace App\Controller;

use App\Model\LicenceManager;
use App\Model\TrainingManager;

class TrainingController extends AbstractController
{
    public function index()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $training = array_map('trim', $_POST);

            // TODO validations (length, format...)
            if (empty($training['title'])) {
                $errors[] = "Le champ titre est obligatoire";
            }

            if (empty($errors)) {
                $trainingManager = new TrainingManager();
                $trainingManager->insert($training);
                header('Location: /training');
                return null;
            }
        }
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

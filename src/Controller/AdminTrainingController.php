<?php

namespace App\Controller;

use App\Model\TrainingManager;

class AdminTrainingController extends AbstractController
{
    public function index()
    {
        $trainingManager = new TrainingManager();

        return $this->twig->render('Admin/Training/index.html.twig', [
            'trainings' => $trainingManager->selectAll()
        ]);
    }

    public function add()
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
                header('Location: /admin/trainings');
                return null;
            }
        }
        return $this->twig->render('Admin/Training/add.html.twig');
    }

    public function edit(int $id)
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
                $trainingManager->update($training);
                header('Location: /admin/trainings');
                return null;
            }
        }
        $trainingManager = new TrainingManager();
        return $this->twig->render('Admin/Training/edit.html.twig', [
            'training' => $trainingManager->selectOneById($id)
        ]);
    }
}

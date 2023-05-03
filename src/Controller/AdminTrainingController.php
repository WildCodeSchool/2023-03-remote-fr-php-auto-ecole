<?php

namespace App\Controller;

use App\Model\FileManager;
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
        $fileManager = new FileManager();
        return $this->twig->render('Admin/Training/edit.html.twig', [
            'training' => $trainingManager->selectOneById($id),
            'files' => $fileManager->selectAllByTrainingId($id)
        ]);
    }

    public function addFiles()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            $trainingId = $_POST['training_id'];
            $fileManager = new FileManager();
            foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['files']['name'][$index];
                $fileName = pathinfo(basename($_FILES['files']['name'][$index]), PATHINFO_FILENAME);
                $fileExt = pathinfo(basename($_FILES['files']['name'][$index]), PATHINFO_EXTENSION);
                $fullFileName = $fileName . "-" . uniqid() . "." . $fileExt;
                $uploadFile = $uploadDir . $fullFileName;
                move_uploaded_file($tmpName, $uploadFile);
                $fileManager->insert($fullFileName, $trainingId);
            }
            header('Location: /admin/trainings/edit?id=' . $trainingId);
        }
    }

    public function deleteFile(int $id)
    {
        $fileManager = new FileManager();
        $file = $fileManager->selectOneById($id);
        if (unlink(__DIR__ . '/../../public/uploads/' . $file['name'])) {
            $fileManager->delete($id);
        }
        header('Location: /admin/trainings/edit?id=' . $file['training_id']);
    }
}

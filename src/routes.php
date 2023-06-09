<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'trainings' => ['TrainingController', 'index'],
    'trainings/show' => ['TrainingController', 'show', ['id']],
    'message' => ['MessageController', 'index'],
    'message/success' => ['MessageController', 'success'],
    'admin' => ['AdminController', 'index'],
    'admin/messages' => ['AdminMessageController', 'index'],
    'admin/trainings' => ['AdminTrainingController', 'index'],
    'admin/trainings/add' => ['AdminTrainingController', 'add'],
    'admin/trainings/edit' => ['AdminTrainingController', 'edit', ['id']],
    'admin/trainings/add-files' => ['AdminTrainingController', 'addFiles', ],
    'admin/trainings/delete-file' => ['AdminTrainingController', 'deleteFile', ['id'],],
    'login' => ['AdminController', 'login'],
    'logout' => ['AdminController', 'logout'],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id',]],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
];

<?php

namespace App\Model;

class TrainingManager extends AbstractManager
{
    public const TABLE = 'training';

    public function insert(array $training): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`, `content`) 
        VALUES (:title, :content)");
        $statement->bindValue('title', $training['title'], \PDO::PARAM_STR);
        $statement->bindValue('content', $training['content'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}

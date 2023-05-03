<?php

namespace App\Model;

use PDO;

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

    public function update(array $training): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `title` = :title, `content` = :content WHERE id=:id");
        $statement->bindValue('id', $training['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $training['title'], PDO::PARAM_STR);
        $statement->bindValue('content', $training['content'], PDO::PARAM_STR);

        return $statement->execute();
    }
}

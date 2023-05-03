<?php

namespace App\Model;

use PDO;

class FileManager extends AbstractManager
{
    public const TABLE = 'file';

    public function insert(string $fileName, int $trainingId): int
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET position=position+1 WHERE training_id=:training_id");
        $statement->bindValue('training_id', $trainingId, PDO::PARAM_STR);
        $statement->execute();

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `training_id`, `position`)
         VALUES (:name, :training_id, 1)");
        $statement->bindValue('name', $fileName, PDO::PARAM_STR);
        $statement->bindValue('training_id', $trainingId, PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectAllByTrainingId(int $trainingId)
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE training_id=:training_id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':training_id', $trainingId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function delete(int $id): void
    {
        $file = $this->selectOneById($id);
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET position=position-1 WHERE position>:position AND training_id=:training_id");
        $statement->bindValue('training_id', $file['training_id'], PDO::PARAM_INT);
        $statement->bindValue('position', $file['position'], PDO::PARAM_INT);
        $statement->execute();
        parent::delete($id);
    }
}

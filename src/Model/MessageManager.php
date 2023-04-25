<?php

namespace App\Model;

use PDO;

class MessageManager extends AbstractManager
{
    public const TABLE = 'message';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT message.*, training.title AS trainingTitle FROM ' . self::TABLE .
        ' JOIN ' . TrainingManager::TABLE . ' ON message.training_id=training.id ';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }


        $messages = $this->pdo->query($query)->fetchAll();
        $licenceManager = new LicenceManager();
        foreach ($messages as &$message) {
            $message['licences'] = $licenceManager->selectAllByMessageId($message['id']);
        }
        return $messages;
    }


    public function insert(array $message): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (`email`, `content`, `sended_at`, `training_id`)
        VALUES (:email, :content, NOW(), :training_id)");
        $statement->bindValue('email', $message['email'], PDO::PARAM_STR);
        $statement->bindValue('content', $message['content'], PDO::PARAM_STR);
        $statement->bindValue('training_id', $message['training_id'], PDO::PARAM_INT);

        $statement->execute();
        $newMessageId = (int)$this->pdo->lastInsertId();

        if (isset($message['licences']) && !empty($message['licences'])) {
            foreach ($message['licences'] as $licenceId) {
                $query = "INSERT INTO message_licence (message_id, licence_id) VALUES (:message_id, :licence_id)";
                $statement = $this->pdo->prepare($query);
                $statement->bindValue(':message_id', $newMessageId);
                $statement->bindValue(':licence_id', $licenceId);
                $statement->execute();
            }
        }
        return $newMessageId;
    }
}

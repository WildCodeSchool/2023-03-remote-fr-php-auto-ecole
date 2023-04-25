<?php

namespace App\Model;

class LicenceManager extends AbstractManager
{
    public const TABLE = 'licence';

    public function selectAllByMessageId(int $messageId)
    {
        $query = 'SELECT * FROM ' . self::TABLE .
        ' l JOIN message_licence ml ON l.id=ml.licence_id WHERE ml.message_id=:messageId';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':messageId', $messageId);
        $statement->execute();
        return $statement->fetchAll();
    }
}

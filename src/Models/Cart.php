<?php


namespace Tunglam\BasicPhp2\Models;

use Tunglam\BasicPhp2\Commons\Model;

class Cart extends Model
{
    protected string $tableName = 'carts';


    public function findUserById($userID)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('user_id = ?')
            ->setParameter(0, $userID)
            ->fetchAssociative();
    }
}

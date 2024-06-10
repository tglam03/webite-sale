<?php

namespace Tunglam\BasicPhp2\Models;

use Tunglam\BasicPhp2\Commons\Model;

class User extends Model
{
    protected string $tableName = 'users';

    public function findByEmail($email)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('email = ?')
            ->setParameter(0, $email)
            ->fetchAssociative();
    }

    public function emailExists($email, $ignoreId = null)
    {
        try {
            $query = $this->queryBuilder
                ->select('*')
                ->from($this->tableName)
                ->where("email = :email")
                ->setParameter('email', $email);

            if ($ignoreId) {
                $query->andWhere("id != :id")
                    ->setParameter('id', $ignoreId);
            }

            $existingUser = $query->executeQuery()->fetchAssociative();

            return $existingUser !== false;
        } catch (\Exception $e) {
            die('LuxChill: ' . $e->getMessage());
        }
    }
}

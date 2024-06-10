<?php


namespace Tunglam\BasicPhp2\Models;

use Tunglam\BasicPhp2\Commons\Model;

class CartDetail extends Model
{
    protected string $tableName = 'cart_details';

    public function findByCartIdAndProductID($cartID, $productID)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)

            ->where('cart_id = ?')->setParameter(0, $cartID)
            ->where('productID = ?')->setParameter(1, $productID)

            ->fetchAssociative();
    }
    public function deleteByCartId($cartID)
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('cart_id = ?')
            ->setParameter(0, $cartID)
            ->executeQuery();
    }


    public function deleteByCartIDAndProductID($cartID, $productID)
    {
        return $this->queryBuilder
            ->delete($this->tableName)

            ->where('cart_id = ?')->setParameter(0, $cartID)
            ->andWhere('product_id = ?')->setParameter(1, $productID)

            ->executeQuery();
    }

    public function updateByCartIDAndProductID($cartID, $productID, $quantity)
    {
        $query = $this->queryBuilder->update($this->tableName);

        $query
            ->set('quantity', '?')->setParameter(0, $quantity)
            ->where('cart_id = ?')->setParameter(1, $cartID)
            ->andWhere('product_id = ?')->setParameter(2, $productID)

            ->executeQuery();
    }
}

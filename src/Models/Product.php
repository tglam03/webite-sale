<?php

namespace Tunglam\BasicPhp2\Models;

use Tunglam\BasicPhp2\Commons\Model;


class Product extends Model
{
    protected string $tableName = 'products';

    // hiển thị tên danh mục 
    public function allsanphamcungloai($id, $category_id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('id <> ?')  // Sử dụng dấu <>
            ->andWhere('category_id = ?')  // Sử dụng dấu =
            ->setParameter(0, $id)
            ->setParameter(1, $category_id)
            ->fetchAllAssociative();
    }


    public function paginate($page = 1, $perPage = 5)
    {
        $queryBuilder = clone ($this->queryBuilder);

        $totalPage = ceil($this->count() / $perPage);

        $offSet = $perPage * ($page - 1);


        $data = $queryBuilder
            ->select(
                'p.id',
                'p.category_id',
                'p.name',
                'p.img_thumbnail',
                'p.price_regular',
                'p.price_sale',
                'p.created_at',
                'p.updated_at',
                'c.name as c_name'
            )
            ->from($this->tableName, 'p')
            ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
            ->setFirstResult($offSet)
            ->setMaxResults($perPage)
            ->orderBy('p.id', 'desc')
            ->fetchAllAssociative();

        return [$data, $totalPage];
    }
}

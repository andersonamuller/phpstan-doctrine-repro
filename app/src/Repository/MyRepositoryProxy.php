<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MyEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryProxy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepositoryProxy<MyEntity>
 */
class MyRepositoryProxy extends ServiceEntityRepositoryProxy
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyEntity::class);
    }

    public function findFirst(): ?MyEntity
    {
        return $this->find(1);
    }
}

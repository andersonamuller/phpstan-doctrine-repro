<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MyRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

#[Entity(MyRepository::class)]
class MyEntity
{
    public function __construct(
        #[Id]
        #[Column]
        public int $id,
        #[Column]
        public string $name,
    ) {}
}

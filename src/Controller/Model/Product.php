<?php

namespace App\Controller\Model;

class Product
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $price,
        private readonly bool $inStock,
        private readonly string $createdAt,
        private readonly string $updatedAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function isInStock(): bool
    {
        return $this->inStock;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    //    getter
}

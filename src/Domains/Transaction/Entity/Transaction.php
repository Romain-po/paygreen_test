<?php

namespace App\Domains\Transaction\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="transaction")
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * @Groups({"transaction_list"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Groups({"transaction_list"})
     */
    private string $reference;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @Groups({"transaction_list"})
     */
    private ?\DateTime $createdAt = null;

    /**
     * @ORM\Column(name="active", type="boolean", options={"default": false})
     * @Groups({"transaction_list"})
     */
    protected bool $active = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt = null): self
    {
        $this->createdAt = ($createdAt ?? new \DateTime());

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}

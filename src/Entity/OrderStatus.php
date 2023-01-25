<?php

namespace App\Entity;

use App\Repository\OrderStatusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderStatusRepository::class)]
class OrderStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatusCatalog $statusCatalog = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ts = null;

    #[ORM\ManyToOne(inversedBy: 'orderStatus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlacedOrder $placedOrder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusCatalog(): ?StatusCatalog
    {
        return $this->statusCatalog;
    }

    public function setStatusCatalog(?StatusCatalog $statusCatalog): self
    {
        $this->statusCatalog = $statusCatalog;

        return $this;
    }

    public function getTs(): ?\DateTimeInterface
    {
        return $this->ts;
    }

    public function setTs(\DateTimeInterface $ts): self
    {
        $this->ts = $ts;

        return $this;
    }

    public function getPlacedOrder(): ?PlacedOrder
    {
        return $this->placedOrder;
    }

    public function setPlacedOrder(?PlacedOrder $placedOrder): self
    {
        $this->placedOrder = $placedOrder;

        return $this;
    }
}

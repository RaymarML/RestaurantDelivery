<?php

namespace App\Entity;

use App\Repository\OrderMenuItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderMenuItemRepository::class)]
class OrderMenuItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderMenuItems')]
    private ?OfferMenuItem $offerMenuItem = null;

    #[ORM\ManyToOne(inversedBy: 'orderMenuItems')]
    private ?MenuItem $menuItem = null;

    #[ORM\Column]
    private ?int $quatity = null;

    #[ORM\Column]
    private ?float $itemPrice = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'orderMenuItem')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlacedOrder $placedOrder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferMenuItem(): ?OfferMenuItem
    {
        return $this->offerMenuItem;
    }

    public function setOfferMenuItem(?OfferMenuItem $offerMenuItem): self
    {
        $this->offerMenuItem = $offerMenuItem;

        return $this;
    }

    public function getMenuItem(): ?MenuItem
    {
        return $this->menuItem;
    }

    public function setMenuItem(?MenuItem $menuItem): self
    {
        $this->menuItem = $menuItem;

        return $this;
    }

    public function getQuatity(): ?int
    {
        return $this->quatity;
    }

    public function setQuatity(int $quatity): self
    {
        $this->quatity = $quatity;

        return $this;
    }

    public function getItemPrice(): ?float
    {
        return $this->itemPrice;
    }

    public function setItemPrice(float $itemPrice): self
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

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

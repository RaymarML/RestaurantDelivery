<?php

namespace App\Entity;

use App\Repository\OfferMenuItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferMenuItemRepository::class)]
class OfferMenuItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'offerMenuItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MenuItem $menuItem = null;

    #[ORM\ManyToOne(inversedBy: 'offerMenuItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $offer = null;

    #[ORM\OneToMany(mappedBy: 'offerMenuItem', targetEntity: OrderMenuItem::class)]
    private Collection $orderMenuItems;

    public function __construct()
    {
        $this->orderMenuItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return Collection<int, OrderMenuItem>
     */
    public function getOrderMenuItems(): Collection
    {
        return $this->orderMenuItems;
    }

    public function addOrderMenuItem(OrderMenuItem $orderMenuItem): self
    {
        if (!$this->orderMenuItems->contains($orderMenuItem)) {
            $this->orderMenuItems->add($orderMenuItem);
            $orderMenuItem->setOfferMenuItem($this);
        }

        return $this;
    }

    public function removeOrderMenuItem(OrderMenuItem $orderMenuItem): self
    {
        if ($this->orderMenuItems->removeElement($orderMenuItem)) {
            // set the owning side to null (unless already changed)
            if ($orderMenuItem->getOfferMenuItem() === $this) {
                $orderMenuItem->setOfferMenuItem(null);
            }
        }

        return $this;
    }
}

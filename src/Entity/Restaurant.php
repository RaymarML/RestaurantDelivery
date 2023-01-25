<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\ManyToOne(inversedBy: 'restaurants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: PlacedOrder::class, orphanRemoval: true)]
    private Collection $placedOrders;

    public function __construct()
    {
        $this->placedOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, PlacedOrder>
     */
    public function getPlacedOrders(): Collection
    {
        return $this->placedOrders;
    }

    public function addPlacedOrder(PlacedOrder $placedOrder): self
    {
        if (!$this->placedOrders->contains($placedOrder)) {
            $this->placedOrders->add($placedOrder);
            $placedOrder->setRestaurant($this);
        }

        return $this;
    }

    public function removePlacedOrder(PlacedOrder $placedOrder): self
    {
        if ($this->placedOrders->removeElement($placedOrder)) {
            // set the owning side to null (unless already changed)
            if ($placedOrder->getRestaurant() === $this) {
                $placedOrder->setRestaurant(null);
            }
        }

        return $this;
    }
}

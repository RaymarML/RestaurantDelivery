<?php

namespace App\Entity;

use App\Repository\MenuItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuItemRepository::class)]
class MenuItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'menuItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MenuCategory $category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ingredients = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recipe = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'menuItem', targetEntity: OfferMenuItem::class, orphanRemoval: true)]
    private Collection $offerMenuItems;

    #[ORM\OneToMany(mappedBy: 'menuItem', targetEntity: OrderMenuItem::class)]
    private Collection $orderMenuItems;

    public function __construct()
    {
        $this->offerMenuItems = new ArrayCollection();
        $this->orderMenuItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?MenuCategory
    {
        return $this->category;
    }

    public function setCategory(?MenuCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(string $recipe): self
    {
        $this->recipe = $recipe;

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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, OfferMenuItem>
     */
    public function getOfferMenuItems(): Collection
    {
        return $this->offerMenuItems;
    }

    public function addOfferMenuItem(OfferMenuItem $offerMenuItem): self
    {
        if (!$this->offerMenuItems->contains($offerMenuItem)) {
            $this->offerMenuItems->add($offerMenuItem);
            $offerMenuItem->setMenuItem($this);
        }

        return $this;
    }

    public function removeOfferMenuItem(OfferMenuItem $offerMenuItem): self
    {
        if ($this->offerMenuItems->removeElement($offerMenuItem)) {
            // set the owning side to null (unless already changed)
            if ($offerMenuItem->getMenuItem() === $this) {
                $offerMenuItem->setMenuItem(null);
            }
        }

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
            $orderMenuItem->setMenuItem($this);
        }

        return $this;
    }

    public function removeOrderMenuItem(OrderMenuItem $orderMenuItem): self
    {
        if ($this->orderMenuItems->removeElement($orderMenuItem)) {
            // set the owning side to null (unless already changed)
            if ($orderMenuItem->getMenuItem() === $this) {
                $orderMenuItem->setMenuItem(null);
            }
        }

        return $this;
    }
}

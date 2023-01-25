<?php

namespace App\Entity;

use App\Repository\PlacedOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlacedOrderRepository::class)]
class PlacedOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'placedOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\ManyToOne(inversedBy: 'placedOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\OneToMany(mappedBy: 'placedOrder', targetEntity: OrderStatus::class, orphanRemoval: true)]
    private Collection $orderStatus;

    #[ORM\OneToMany(mappedBy: 'placedOrder', targetEntity: OrderMenuItem::class, orphanRemoval: true)]
    private Collection $orderMenuItem;

    #[ORM\OneToMany(mappedBy: 'placedOrder', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $feedBackComment;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $orderTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $estimatedDelivery = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $foodReady = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $actualDelivery = null;

    #[ORM\Column(length: 255)]
    private ?string $addressDelivery = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $discount = null;

    #[ORM\Column]
    private ?float $finalPrice = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ts = null;

    public function __construct()
    {
        $this->orderStatus = new ArrayCollection();
        $this->orderMenuItem = new ArrayCollection();
        $this->feedBackComment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, OrderStatus>
     */
    public function getOrderStatus(): Collection
    {
        return $this->orderStatus;
    }

    public function addOrderStatus(OrderStatus $orderStatus): self
    {
        if (!$this->orderStatus->contains($orderStatus)) {
            $this->orderStatus->add($orderStatus);
            $orderStatus->setPlacedOrder($this);
        }

        return $this;
    }

    public function removeOrderStatus(OrderStatus $orderStatus): self
    {
        if ($this->orderStatus->removeElement($orderStatus)) {
            // set the owning side to null (unless already changed)
            if ($orderStatus->getPlacedOrder() === $this) {
                $orderStatus->setPlacedOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderMenuItem>
     */
    public function getOrderMenuItem(): Collection
    {
        return $this->orderMenuItem;
    }

    public function addOrderMenuItem(OrderMenuItem $orderMenuItem): self
    {
        if (!$this->orderMenuItem->contains($orderMenuItem)) {
            $this->orderMenuItem->add($orderMenuItem);
            $orderMenuItem->setPlacedOrder($this);
        }

        return $this;
    }

    public function removeOrderMenuItem(OrderMenuItem $orderMenuItem): self
    {
        if ($this->orderMenuItem->removeElement($orderMenuItem)) {
            // set the owning side to null (unless already changed)
            if ($orderMenuItem->getPlacedOrder() === $this) {
                $orderMenuItem->setPlacedOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getFeedBackComment(): Collection
    {
        return $this->feedBackComment;
    }

    public function addFeedBackComment(Comment $feedBackComment): self
    {
        if (!$this->feedBackComment->contains($feedBackComment)) {
            $this->feedBackComment->add($feedBackComment);
            $feedBackComment->setPlacedOrder($this);
        }

        return $this;
    }

    public function removeFeedBackComment(Comment $feedBackComment): self
    {
        if ($this->feedBackComment->removeElement($feedBackComment)) {
            // set the owning side to null (unless already changed)
            if ($feedBackComment->getPlacedOrder() === $this) {
                $feedBackComment->setPlacedOrder(null);
            }
        }

        return $this;
    }

    public function getOrderTime(): ?\DateTimeInterface
    {
        return $this->orderTime;
    }

    public function setOrderTime(\DateTimeInterface $orderTime): self
    {
        $this->orderTime = $orderTime;

        return $this;
    }

    public function getEstimatedDelivery(): ?\DateTimeInterface
    {
        return $this->estimatedDelivery;
    }

    public function setEstimatedDelivery(\DateTimeInterface $estimatedDelivery): self
    {
        $this->estimatedDelivery = $estimatedDelivery;

        return $this;
    }

    public function getFoodReady(): ?\DateTimeInterface
    {
        return $this->foodReady;
    }

    public function setFoodReady(?\DateTimeInterface $foodReady): self
    {
        $this->foodReady = $foodReady;

        return $this;
    }

    public function getActualDelivery(): ?\DateTimeInterface
    {
        return $this->actualDelivery;
    }

    public function setActualDelivery(\DateTimeInterface $actualDelivery): self
    {
        $this->actualDelivery = $actualDelivery;

        return $this;
    }

    public function getAddressDelivery(): ?string
    {
        return $this->addressDelivery;
    }

    public function setAddressDelivery(string $addressDelivery): self
    {
        $this->addressDelivery = $addressDelivery;

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

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getFinalPrice(): ?float
    {
        return $this->finalPrice;
    }

    public function setFinalPrice(float $finalPrice): self
    {
        $this->finalPrice = $finalPrice;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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
}

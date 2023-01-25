<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $customerName = null;

    #[ORM\ManyToOne(inversedBy: 'customers')]
    private ?City $city = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $confirmationCode = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $RegistrationDate = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: PlacedOrder::class, orphanRemoval: true)]
    private Collection $placedOrders;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->placedOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getConfirmationCode(): ?string
    {
        return $this->confirmationCode;
    }

    public function setConfirmationCode(?string $confirmationCode): self
    {
        $this->confirmationCode = $confirmationCode;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->RegistrationDate;
    }

    public function setRegistrationDate(?\DateTimeInterface $RegistrationDate): self
    {
        $this->RegistrationDate = $RegistrationDate;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCustomer($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCustomer() === $this) {
                $comment->setCustomer(null);
            }
        }

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
            $placedOrder->setCustomer($this);
        }

        return $this;
    }

    public function removePlacedOrder(PlacedOrder $placedOrder): self
    {
        if ($this->placedOrders->removeElement($placedOrder)) {
            // set the owning side to null (unless already changed)
            if ($placedOrder->getCustomer() === $this) {
                $placedOrder->setCustomer(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ts = null;

    #[ORM\Column]
    private ?bool $isComplain = null;

    #[ORM\Column]
    private ?bool $isPraise = null;

    #[ORM\ManyToOne(inversedBy: 'feedBackComment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlacedOrder $placedOrder = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isIsComplain(): ?bool
    {
        return $this->isComplain;
    }

    public function setIsComplain(bool $isComplain): self
    {
        $this->isComplain = $isComplain;

        return $this;
    }

    public function isIsPraise(): ?bool
    {
        return $this->isPraise;
    }

    public function setIsPraise(bool $isPraise): self
    {
        $this->isPraise = $isPraise;

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

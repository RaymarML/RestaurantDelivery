<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateActiveFrom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateActiveTo = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timeActiveFrom = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timeActiveTo = null;

    #[ORM\Column]
    private ?float $offerDiscount = null;

    #[ORM\OneToMany(mappedBy: 'offer', targetEntity: OfferMenuItem::class, orphanRemoval: true)]
    private Collection $offerMenuItems;

    public function __construct()
    {
        $this->offerMenuItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateActiveFrom(): ?\DateTimeInterface
    {
        return $this->dateActiveFrom;
    }

    public function setDateActiveFrom(\DateTimeInterface $dateActiveFrom): self
    {
        $this->dateActiveFrom = $dateActiveFrom;

        return $this;
    }

    public function getDateActiveTo(): ?\DateTimeInterface
    {
        return $this->dateActiveTo;
    }

    public function setDateActiveTo(\DateTimeInterface $dateActiveTo): self
    {
        $this->dateActiveTo = $dateActiveTo;

        return $this;
    }

    public function getTimeActiveFrom(): ?\DateTimeInterface
    {
        return $this->timeActiveFrom;
    }

    public function setTimeActiveFrom(\DateTimeInterface $timeActiveFrom): self
    {
        $this->timeActiveFrom = $timeActiveFrom;

        return $this;
    }

    public function getTimeActiveTo(): ?\DateTimeInterface
    {
        return $this->timeActiveTo;
    }

    public function setTimeActiveTo(\DateTimeInterface $timeActiveTo): self
    {
        $this->timeActiveTo = $timeActiveTo;

        return $this;
    }

    public function getOfferDiscount(): ?float
    {
        return $this->offerDiscount;
    }

    public function setOfferDiscount(float $offerDiscount): self
    {
        $this->offerDiscount = $offerDiscount;

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
            $offerMenuItem->setOffer($this);
        }

        return $this;
    }

    public function removeOfferMenuItem(OfferMenuItem $offerMenuItem): self
    {
        if ($this->offerMenuItems->removeElement($offerMenuItem)) {
            // set the owning side to null (unless already changed)
            if ($offerMenuItem->getOffer() === $this) {
                $offerMenuItem->setOffer(null);
            }
        }

        return $this;
    }
}

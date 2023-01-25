<?php

namespace App\Entity;

use App\Repository\StatusCatalogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusCatalogRepository::class)]
class StatusCatalog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'statusCatalog', targetEntity: OrderStatus::class)]
    private Collection $orderStatuses;

    public function __construct()
    {
        $this->orderStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, OrderStatus>
     */
    public function getOrderStatuses(): Collection
    {
        return $this->orderStatuses;
    }

    public function addOrderStatus(OrderStatus $orderStatus): self
    {
        if (!$this->orderStatuses->contains($orderStatus)) {
            $this->orderStatuses->add($orderStatus);
            $orderStatus->setStatusCatalog($this);
        }

        return $this;
    }

    public function removeOrderStatus(OrderStatus $orderStatus): self
    {
        if ($this->orderStatuses->removeElement($orderStatus)) {
            // set the owning side to null (unless already changed)
            if ($orderStatus->getStatusCatalog() === $this) {
                $orderStatus->setStatusCatalog(null);
            }
        }

        return $this;
    }
}

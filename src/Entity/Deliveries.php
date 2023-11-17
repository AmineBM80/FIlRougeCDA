<?php

namespace App\Entity;

use App\Repository\DeliveriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveriesRepository::class)]
class Deliveries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_delivery = null;

    #[ORM\OneToMany(mappedBy: 'deliveries', targetEntity: Products::class)]
    private Collection $livraison;

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->date_delivery;
    }

    public function setDateDelivery(\DateTimeInterface $date_delivery): static
    {
        $this->date_delivery = $date_delivery;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getLivraison(): Collection
    {
        return $this->livraison;
    }

    public function addLivraison(Products $livraison): static
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison->add($livraison);
            $livraison->setDeliveries($this);
        }

        return $this;
    }

    public function removeLivraison(Products $livraison): static
    {
        if ($this->livraison->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getDeliveries() === $this) {
                $livraison->setDeliveries(null);
            }
        }

        return $this;
    }
}

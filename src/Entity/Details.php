<?php

namespace App\Entity;

use App\Repository\DetailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsRepository::class)]
class Details
{
    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $price = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'details')]
    private ?Products $produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'details')]
    private ?Commande $commande = null;

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getProduit(): ?Products
    {
        return $this->produit;
    }

    public function setProduit(?Products $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}

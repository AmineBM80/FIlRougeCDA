<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Payments $paiment = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Users $user = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Details::class)]
    private Collection $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPaiment(): ?Payments
    {
        return $this->paiment;
    }

    public function setPaiment(?Payments $paiment): static
    {
        $this->paiment = $paiment;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Details>
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Details $detail): static
    {
        if (!$this->details->contains($detail)) {
            $this->details->add($detail);
            $detail->setCommande($this);
        }

        return $this;
    }

    public function removeDetail(Details $detail): static
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCommande() === $this) {
                $detail->setCommande(null);
            }
        }

        return $this;
    }
}

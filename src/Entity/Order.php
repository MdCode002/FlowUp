<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?int $Livraison = null;

    #[ORM\Column(length: 255)]
    private ?string $addresse = null;

    #[ORM\OneToMany(mappedBy: 'myorder', targetEntity: OrderDetais::class)]
    private Collection $orderDetais;

    #[ORM\Column]
    private ?bool $isPaid = null;

    public function __construct()
    {
        $this->orderDetais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getOrderDetais()->getValues() as $produit){
         $total = $total +(( $produit->getPrix() * $produit->getQuantite()));}
        
        
        return $total*100;

    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLivraison(): ?int
    {
        return $this->Livraison;
    }

    public function setLivraison(int $Livraison): static
    {
        $this->Livraison = $Livraison;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): static
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetais>
     */
    public function getOrderDetais(): Collection
    {
        return $this->orderDetais;
    }

    public function addOrderDetai(OrderDetais $orderDetai): static
    {
        if (!$this->orderDetais->contains($orderDetai)) {
            $this->orderDetais->add($orderDetai);
            $orderDetai->setMyorder($this);
        }

        return $this;
    }

    public function removeOrderDetai(OrderDetais $orderDetai): static
    {
        if ($this->orderDetais->removeElement($orderDetai)) {
            // set the owning side to null (unless already changed)
            if ($orderDetai->getMyorder() === $this) {
                $orderDetai->setMyorder(null);
            }
        }

        return $this;
    }

    public function isIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): static
    {
        $this->isPaid = $isPaid;

        return $this;
    }
}

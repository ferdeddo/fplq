<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DetailsCommande
 *
 * @ORM\Table(name="details_commande")
 * @ORM\Entity
 */
class DetailsCommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Commande", inversedBy="details", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entree", inversedBy="commandes")
     */
    private $entree;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Menu", inversedBy="commandes")
     */
    private $menu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Dessert", inversedBy="commandes")
     */
    private $dessert;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Boisson", inversedBy="commandes")
     */
    private $boisson;

    public function __construct()
    {
        $this->entree = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->dessert = new ArrayCollection();
        $this->boisson = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * @return Collection|Entree[]
     */
    public function getEntree(): Collection
    {
        return $this->entree;
    }

    public function addEntree(Entree $entree): self
    {
        if (!$this->entree->contains($entree)) {
            $this->entree[] = $entree;
        }

        return $this;
    }

    public function removeEntree(Entree $entree): self
    {
        if ($this->entree->contains($entree)) {
            $this->entree->removeElement($entree);
        }

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menu->contains($menu)) {
            $this->menu->removeElement($menu);
        }

        return $this;
    }

    /**
     * @return Collection|Dessert[]
     */
    public function getDessert(): Collection
    {
        return $this->dessert;
    }

    public function addDessert(Dessert $dessert): self
    {
        if (!$this->dessert->contains($dessert)) {
            $this->dessert[] = $dessert;
        }

        return $this;
    }

    public function removeDessert(Dessert $dessert): self
    {
        if ($this->dessert->contains($dessert)) {
            $this->dessert->removeElement($dessert);
        }

        return $this;
    }

    /**
     * @return Collection|Boisson[]
     */
    public function getBoisson(): Collection
    {
        return $this->boisson;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boisson->contains($boisson)) {
            $this->boisson[] = $boisson;
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        if ($this->boisson->contains($boisson)) {
            $this->boisson->removeElement($boisson);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entrée
 *
 * @ORM\Table(name="entree")
 * @ORM\Entity
 */
class Entree /*extends \App\Entity\Menu*/
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     */
    private $description;

    /**
     * @var double
     *
     * @ORM\Column(name="prix", type="float", nullable=false)
     */
    private $prix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=180, nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DetailsCommande", mappedBy="entree")
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Restaurant", inversedBy="entrees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurant;

    /**
     * Entree constructor.
     * @param $commandes
     */
    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $restaurant
     * @return Restaurant
     */
    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection|DetailsCommande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(DetailsCommande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addEntree($this);
        }

        return $this;
    }

    public function removeCommande(DetailsCommande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removeEntree($this);
        }

        return $this;
    }


}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Restaurant
 *
 * @ORM\Table(name="restaurant")
 * @ORM\Entity
 */
class Restaurant
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
     * @Assert\NotBlank(message="Entrez le nom de votre restaurant SVP.")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=80, nullable=false)
     * @Assert\NotBlank(message="Entrez l'adresse de votre restaurant SVP.")
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=false)
     * @Assert\NotBlank(message="Entrez le code postal de votre restaurant SVP.")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Entrez la ville de votre restaurant SVP.")
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="horaires", type="string", length=80, nullable=false)
     * @Assert\NotBlank(message="Entrez les horaires de votre restaurant SVP.")
     */
    private $horaires;

    /**
     * @var double
     *
     * @ORM\Column(name="commande_min", type="float", nullable=false)
     * @Assert\NotBlank(message="Entrez le montant min. de commande SVP.")
     */
    private $commandeMin;

    /**
     * @var double
     *
     * @ORM\Column(name="prix_livraison", type="float", nullable=false)
     * @Assert\NotBlank(message="Entrez le prix de vos livraisons SVP.")
     */
    private $prixLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=180, nullable=false)
     * @Assert\NotBlank(message="Entrez la photo de votre restaurant SVP.")
     */
    private $photo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     * @Assert\NotBlank(message="Entrez la description de votre restaurant SVP.")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="restaurants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entree", mappedBy="restaurant")
     */
    private $entrees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Menu", mappedBy="restaurant")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dessert", mappedBy="restaurant")
     */
    private $desserts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Boisson", mappedBy="restaurant")
     */
    private $boissons;

    private $roles;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->entrees = new ArrayCollection();
        $this->desserts = new ArrayCollection();
        $this->boissons = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): self
    {
        $this->horaires = $horaires;

        return $this;
    }

    public function getCommandeMin(): ?int
    {
        return $this->commandeMin;
    }

    public function setCommandeMin(int $commandeMin): self
    {
        $this->commandeMin = $commandeMin;

        return $this;
    }

    public function getPrixLivraison(): ?int
    {
        return $this->prixLivraison;
    }

    public function setPrixLivraison(int $prixLivraison): self
    {
        $this->prixLivraison = $prixLivraison;

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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

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

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return Collection|Entree[]
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(Entree $entree): self
    {
        if (!$this->entrees->contains($entree)) {
            $this->entrees[] = $entree;
            $entree->setRestaurant($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entree): self
    {
        if ($this->entrees->contains($entree)) {
            $this->entrees->removeElement($entree);
            // set the owning side to null (unless already changed)
            if ($entree->getRestaurant() === $this) {
                $entree->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setRestaurant($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getRestaurant() === $this) {
                $menu->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dessert[]
     */
    public function getDesserts(): Collection
    {
        return $this->desserts;
    }

    public function addDessert(Dessert $dessert): self
    {
        if (!$this->desserts->contains($dessert)) {
            $this->desserts[] = $dessert;
            $dessert->setRestaurant($this);
        }

        return $this;
    }

    public function removeDessert(Dessert $dessert): self
    {
        if ($this->desserts->contains($dessert)) {
            $this->desserts->removeElement($dessert);
            // set the owning side to null (unless already changed)
            if ($dessert->getRestaurant() === $this) {
                $dessert->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Boisson[]
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
            $boisson->setRestaurant($this);
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        if ($this->boissons->contains($boisson)) {
            $this->boissons->removeElement($boisson);
            // set the owning side to null (unless already changed)
            if ($boisson->getRestaurant() === $this) {
                $boisson->setRestaurant(null);
            }
        }

        return $this;
    }

}

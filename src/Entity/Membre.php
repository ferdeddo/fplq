<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 * @UniqueEntity(fields={"email"}, errorPath="email", message="Ce compte existe déjà !")
 */
class Membre implements UserInterface
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
     * @Assert\NotBlank(message="Entrez votre nom SVP.")
     * @Assert\Length(
     *     min="3",
     *     minMessage="votre nom doit comporter au moins 3 caracteres.",
     *     max="20",
     *     maxMessage="votre nom est trop long, 20 caractères maximum.")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Entrez votre prénom SVP.")
     * @Assert\Length(
     *     min="3",
     *     minMessage="votre prénom doit comporter au moins 3 caracteres.",
     *     max="20",
     *     maxMessage="votre prénom est trop long, 20 caractères maximum.")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=false)
     * @Assert\NotBlank(message="Saisissez votre email.")
     * @Assert\Email(message="Verifiez votre email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank(message="N'oubliez pas votre mot de passe.")
     * @Assert\Length(
     *     min="8",
     *     minMessage="Votre mot de passe est trop court. 8 caractères min.",
     *     max="20",
     *     maxMessage="Votre mot de passe est trop long. 20 caractères max."
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$/",
     *     message="Votre mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre."
     * )
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10, nullable=false)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=180, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livraison", mappedBy="membre")
     */
    private $livraisons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="membre")
     */
    private $commandes;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    public function __construct()
    {
        $this->livraisons = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    function addRole($role) {
        $this->roles[] = $role;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setPassword(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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
     * @return Collection|Livraison[]
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setMembre($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->contains($livraison)) {
            $this->livraisons->removeElement($livraison);
            // set the owning side to null (unless already changed)
            if ($livraison->getMembre() === $this) {
                $livraison->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setMembre($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getMembre() === $this) {
                $commande->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }
    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }


    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}

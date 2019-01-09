<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 * @UniqueEntity(fields={"email"}, errorPath="email", message="Ce compte existe déjà !")

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
     * @Assert\NotBlank(message="Entrez votre nom SVP.")
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
     * @Assert\Email(message="Verifiez votre email")
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=180, nullable=true)
     */

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];


    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livraison", mappedBy="membre")
     */

    private $livraison;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="membre")
     */
    private $commande;

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
        $this->commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getLivraison()
    {
        return $this->livraison;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison[] = $livraison;
            $livraison->setMembre($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraison->contains($livraison)) {
            $this->livraison->removeElement($livraison);
            // set the owning side to null (unless already changed)
            if ($livraison->getMembre() === $this) {
                $livraison->setMembre(null);
            }
        }

        return $this;
    }


    public function getCommande()
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setMembre($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->contains($commande)) {
            $this->commande->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getMembre() === $this) {
                $commande->setMembre(null);
            }
        }

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
    }
}

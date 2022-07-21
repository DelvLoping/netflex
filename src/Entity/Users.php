<?php

namespace App\Entity;

use App\Entity\Favorites;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1483A5E9F85E0677", columns={"username"})})
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
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
     * @ORM\Column(name="username", type="string", length=180, nullable=false)
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json",nullable=false)
     */
    private $roles= ['ROLE_USER'];

    /**
     * @ORM\OneToMany(targetEntity="Favorites",cascade={"persist"}, mappedBy="idUsers")
     */
    private $favorites;

    
    /**
     * @ORM\OneToMany(targetEntity="Seen",cascade={"persist"}, mappedBy="idUsers")
     */
    private $seen;

    public function __construct(){
        $this->favorites = new ArrayCollection();
        $this->seen = new ArrayCollection();
    }

    /**
     * @return Collection|Favorites[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorites(Favorites $favorites)
    {
        $this->favorites->add($favorites);
        $favorites->setidUsers($this);
    }

        /**
     * @return Collection|Seen[]
     */
    public function getSeen(): Collection
    {
        return $this->seen;
    }

    public function addSeen(Seen $seen)
    {
        $this->seen->add($seen);
        $seen->setidUsers($this);
    }


    public function __toString():string
    {
        return $this->username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
            $roles = $this->roles;
            return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
            $this->roles = $roles;
            return $this;
    }
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
            return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
            $this->password = $password;
            return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
            // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
            // If you store any temporary, sensitive data on the user, clear it here
            // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}




/*
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 *
 *
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
    private $id;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *
    private $username;
    /**
     * @ORM\Column(type="json")
     *
    private $roles = [];
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
    private $password;
    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true, options={"default"="NULL"})
     *
    private $email = 'NULL';
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     *
    public function getUsername(): string
    {
            return (string) $this->username;
    }
    public function setUsername(string $username): self
    {
            $this->username = $username;
            return $this;
    }
    /**
     * @see UserInterface
     *
    public function getRoles(): array
    {
            $roles = $this->roles;
            // guarantee every user at least has ROLE_USER
            $roles[] = 'ROLE_USER';
            return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
            $this->roles = $roles;
            return $this;
    }
    /**
     * @see PasswordAuthenticatedUserInterface
     *
    public function getPassword(): string
    {
            return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
            $this->password = $password;
            return $this;
    }
    /**
     * @see UserInterface
     *
    public function getSalt()
    {
            // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     *
    public function eraseCredentials()
    {
            // If you store any temporary, sensitive data on the user, clear it here
            // $this->plainPassword = null;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __toString():string{
        return $this->title;
    }
}

*/
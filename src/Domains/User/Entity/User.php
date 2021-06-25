<?php

namespace App\Domains\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Domains\User\Repository\UserRepository;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    const ROLE_USER = "ROLE_USER";
    const ROLE_ADMINISTRATEUR = "ROLE_ADMINISTRATEUR";
    const ROLES_LIST = [
        self::ROLE_USER,
        self::ROLE_ADMINISTRATEUR
    ];

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * @Groups({"user_list"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Groups({"user_list"})
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     * @Groups({"user_list"})
     */
    private string $username;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function hasRole(string $role): bool
    {
        if (!$this->roles) {
            return false;
        }

        return \in_array($role, $this->roles);
    }

    public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return null;
    }
}

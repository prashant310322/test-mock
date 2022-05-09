<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\UserDeleteController;
use App\Dto\UserInputDto;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    itemOperations: [
        'get',
        'put',
        'patch',
        'delete'
//        'delete'=>[
//            'controller'=>UserDeleteController::class
//        ]
    ],
         //  input: UserInputDto::class,
   //denormalizationContext: ['groups' => ['user.write' ]],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]

    private $id;


    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;


    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[Groups(["user.write"])]
    #[ORM\Column(type: 'string')]
    private $password;

    #[Groups(["user.write"])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Address::class, cascade: ['persist','remove'])]
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
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
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }

        return $this;
    }

    public function manageAddresses($addresses): self
    {
        //dd($addresses);
        if (is_array($addresses)) {
            $addresses = new ArrayCollection($addresses);
        }

        foreach ($addresses as $address) {
            $this->addAddress($address);
        }

        $this->cleanupAddresses($addresses);
        //dd($this);
        return $this;
    }

    public function cleanupAddresses(Collection $newAddresses): self
    {
        foreach ($this->addresses as $address) {
            if (!$newAddresses->contains($address)) {
                $this->removeAddress($address);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\AddressInputDto;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ApiResource(input: AddressInputDto::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["user.write"])]
    private $id;

    #[Groups(["user.write"])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[Groups(["user.write"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $useAddress;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'addresses')]
    #[ORM\JoinColumn(nullable: false)]

    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUseAddress(): ?string
    {
        return $this->useAddress;
    }

    public function setUseAddress(string $useAddress): self
    {
        $this->useAddress = $useAddress;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        //dd('hello');
        $this->user = $user;

        return $this;
    }
}

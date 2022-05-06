<?php


namespace App\Dto;


use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class UserInputDto
{

    public ?int $id =null;
    public ?string $email = null;
    public ?string $password = null;


    public static function fromEntity(?User $user): self
    {
        $dto = new self();

        if (!$user) {
            return $dto;
        }

        $dto->email = $user->getEmail();
        $dto->password = $user->getPassword();
        //$dto->addresses = AddressInputDto::fromEntities($user->getAddresses());

        return $dto;

    }


    public function toEntity(?User $user, Collection  $addresses): User
    {
        $user = $user ?? new User();



        $user->setEmail($this->email)
            ->setPassword($this->password)
           // ->manageAddresses($addresses)
        ;




        return $user;
    }

}
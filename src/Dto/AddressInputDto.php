<?php


namespace App\Dto;


use App\Entity\Address;
use Symfony\Component\Serializer\Annotation\Groups;

class AddressInputDto
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $useAddress= null;


    public static function  fromEntity(?Address $address): self
    {
        $dto = new self();

        if(!$address){
            return $dto;
        }

        $dto->name = $address->getName() ;
        $dto->useAddress = $address->getUseAddress();


        return $dto;
    }

    public static function fromEntities($addresses): array
    {
        $addressDtos = [];

        foreach ($addresses as $address) {
            $addressDtos[] = self::fromEntity($address);
        }

        return $addressDtos;
    }


    public function toEntity(?Address $address): Address
    {

        $address = $address ?? new Address(strval($this->id));
        $address->setName($this->name);
        $address->setUseAddress($this->useAddress);

        // dd($address);

        return  $address;
    }

}
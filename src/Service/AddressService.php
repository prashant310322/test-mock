<?php


namespace App\Service;


use App\Dto\AddressInputDto;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Serializer\Normalizer\AddressInputDenormalizer;

class AddressService
{
    private AddressRepository $repository;
    private AddressInputDenormalizer $denormalizer;

    public function  __construct(AddressRepository $repository, AddressInputDenormalizer $denormalizer)
    {

        $this->repository = $repository;
        $this->denormalizer = $denormalizer;
    }

    public  function  populateAddresses(array $data): Collection
    {

         $addresses = new ArrayCollection();

         foreach ($data as $item)
         {
             //dd($item);
             $addressInputDto = $this->denormalizer->denormalize($item, AddressInputDto::class);

             $address =  $this->repository->find($item->id);

             if(!$addresses->contains($address)){
                 $addresses[]= $addressInputDto->toEntity($address);
             }


         }
        return  $addresses;
         //dd($addresses);


    }
}
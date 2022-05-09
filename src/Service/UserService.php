<?php


namespace App\Service;


use App\Repository\AddressRepository;
use App\Repository\UserRepository;

class UserService
{

    public function __construct(private UserRepository $userRepository, private AddressRepository $addressRepository)
    {
    }

    public  function  findUserById($userId){

        return $this->userRepository->find($userId);
    }

    public function deleteUserByUserId($userId){
        $deleteAddressStatus = $this->deleteAllAddressesByUserId($userId);
        if($deleteAddressStatus){
            return $this->userRepository->deleteUserByUserId($userId);
        }
    }

    private function deleteAllAddressesByUserId($userId){
        return $this->addressRepository->deleteAddressByUserId($userId);
    }


}
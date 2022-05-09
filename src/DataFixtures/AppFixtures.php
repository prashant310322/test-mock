<?php


namespace App\DataFixtures;


use App\Entity\Address;
use App\Entity\User;
use App\Factory\AddressFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends  Fixture
{
    public  function  load(ObjectManager $manager)
    {
        for($i=0;$i<10; $i++)
        {
            $user = UserFactory::createOne();

            AddressFactory::createOne( ['user'=> $user]);
        }



    }
}
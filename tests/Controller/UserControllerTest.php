<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends  WebTestCase
{


    public  function  testGetUsers(){
         $client = static::createClient();

         $client->request('GET', '/api/users/2');

         $this->assertEquals(200, $client->getResponse()->getStatusCode());
     }
}
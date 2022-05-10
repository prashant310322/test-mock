<?php


namespace App\Tests\Functional;

use App\Tests\BestTestCase;
use App\Factory\DataSet\UserDataSet;

class UserResourceTest  extends  BestTestCase
{
   public  function  testCreateUsersShouldReturnTrue()
   {
       // Arrange
       $client = $this->createTestClient();
       $data = UserDataSet::all();

       // Act
       $client->request('POST', '/api/users', [
           'json' => $data,
       ]);

       // Assert
       self::assertResponseStatusCodeSame(201, 'Cannot create an address');
   }
}
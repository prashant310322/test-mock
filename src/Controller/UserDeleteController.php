<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDeleteController extends AbstractController
{
    public function __construct(private UserService $userService)
    {
    }

    public function __invoke($id)
    {
        return $this->userService->deleteUserByUserId($id);
    }
}

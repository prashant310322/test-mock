<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
Use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Dto\UserInputDto;
use App\Entity\User;

use App\Service\AddressService;


class UserInputDataTransformer implements DataTransformerInterface
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @param UserInputDto $userInputDto
     */
    public function transform($userInputDto, string $to, array $context = [])
    {
        $user = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] ?? null;


        $addresses = $this->addressService->populateAddresses($userInputDto->addresses);

       // dd($userInputDto);
       // dd($addresses);

        return $userInputDto->toEntity($user, $addresses);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {

        return User::class === $to && UserInputDto::class === ($context['input']['class'] ?? null);
    }
}


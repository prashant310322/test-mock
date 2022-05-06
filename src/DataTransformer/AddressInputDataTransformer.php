<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\AddressInputDto;
use App\Entity\Address;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class AddressInputDataTransformer implements DataTransformerInterface
{
    /**
     * @param AddressInputDto $addressInputDto
     * @param string $to
     * @param array $context
     * @return object
     */
    public function transform($addressInputDto, string $to, array $context = [])
    {
       $address = $context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? null;

       return $addressInputDto->toEntity($address);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Address::class === $to  && AddressInputDto::class === ($context['input']['class'] ?? null);
    }


}
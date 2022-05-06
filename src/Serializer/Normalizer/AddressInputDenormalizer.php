<?php


namespace App\Serializer\Normalizer;


use App\Dto\AddressInputDto;
use App\Entity\Address;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AddressInputDenormalizer implements DenormalizerInterface, CacheableSupportsMethodInterface
{
    private  $normalizer;

  public  function  __construct(ObjectNormalizer $normalizer)
  {
      $this->normalizer= $normalizer;
  }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
         $context[AbstractNormalizer::OBJECT_TO_POPULATE] = $this->generateDto($context);

         return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return AddressInputDto::class === $type;
    }

    public function hasCacheableSupportsMethod(): bool
    {
            return true;
    }

    private function generateDto(array $context): AddressInputDto
    {
         $entity = $context[AbstractNormalizer::OBJECT_TO_POPULATE] ?? null;

         if( $entity and !$entity instanceof Address)
         {
             throw new \Exception(sprintf('Unexpected resource class "%s"', get_class($entity)));
         }

         return  AddressInputDto::fromEntity($entity);
    }

}
<?php

namespace App\Serializer\Normalizer;

use App\Entity\MediaObject;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Vich\UploaderBundle\Storage\StorageInterface;

class MediaObjectNormalizer implements NormalizerInterface
{
    const bool ALREADY_CALLED = false;

    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private NormalizerInterface $normalizer,
        private readonly StorageInterface $storage
    ) {
    }

    public function normalize($object, ?string $format = null, array $context = []): array
    {
        $context[self::ALREADY_CALLED] = true;

        $object->contentUrl = $this->storage->resolveUri($object, 'file');

        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }

        return $data instanceof MediaObject;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [MediaObject::class => true];
    }
}

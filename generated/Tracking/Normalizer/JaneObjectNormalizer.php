<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    protected $normalizers = ['Ups\\Api\\Tracking\\Model\\Activity' => 'Ups\\Api\\Tracking\\Normalizer\\ActivityNormalizer', 'Ups\\Api\\Tracking\\Model\\Address' => 'Ups\\Api\\Tracking\\Normalizer\\AddressNormalizer', 'Ups\\Api\\Tracking\\Model\\Errors' => 'Ups\\Api\\Tracking\\Normalizer\\ErrorsNormalizer', 'Ups\\Api\\Tracking\\Model\\Response' => 'Ups\\Api\\Tracking\\Normalizer\\ResponseNormalizer', 'Ups\\Api\\Tracking\\Model\\Location' => 'Ups\\Api\\Tracking\\Normalizer\\LocationNormalizer', 'Ups\\Api\\Tracking\\Model\\Package' => 'Ups\\Api\\Tracking\\Normalizer\\PackageNormalizer', 'Ups\\Api\\Tracking\\Model\\Shipment' => 'Ups\\Api\\Tracking\\Normalizer\\ShipmentNormalizer', 'Ups\\Api\\Tracking\\Model\\TrackingResponse' => 'Ups\\Api\\Tracking\\Normalizer\\TrackingResponseNormalizer', '\\Jane\\JsonSchemaRuntime\\Reference' => '\\Jane\\JsonSchemaRuntime\\Normalizer\\ReferenceNormalizer'];
    protected $normalizersCache = [];

    public function supportsDenormalization($data, $type, $format = null)
    {
        return \array_key_exists($type, $this->normalizers);
    }

    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && \array_key_exists(\get_class($data), $this->normalizers);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $normalizerClass = $this->normalizers[\get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);

        return $normalizer->normalize($object, $format, $context);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);

        return $denormalizer->denormalize($data, $class, $format, $context);
    }

    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }

    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;

        return $normalizer;
    }
}

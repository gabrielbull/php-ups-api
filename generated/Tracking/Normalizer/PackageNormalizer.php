<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PackageNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Ups\\Api\\Tracking\\Model\\Package' === $type;
    }

    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && 'Ups\\Api\\Tracking\\Model\\Package' === \get_class($data);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Ups\Api\Tracking\Model\Package();
        if (\array_key_exists('trackingNumber', $data) && null !== $data['trackingNumber']) {
            $object->setTrackingNumber($data['trackingNumber']);
        } elseif (\array_key_exists('trackingNumber', $data) && null === $data['trackingNumber']) {
            $object->setTrackingNumber(null);
        }
        if (\array_key_exists('activity', $data) && null !== $data['activity']) {
            $values = [];
            foreach ($data['activity'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Ups\\Api\\Tracking\\Model\\Activity', 'json', $context);
            }
            $object->setActivity($values);
        } elseif (\array_key_exists('activity', $data) && null === $data['activity']) {
            $object->setActivity(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getTrackingNumber()) {
            $data['trackingNumber'] = $object->getTrackingNumber();
        }
        if (null !== $object->getActivity()) {
            $values = [];
            foreach ($object->getActivity() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['activity'] = $values;
        }

        return $data;
    }
}

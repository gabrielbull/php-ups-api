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

class TrackingResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'Ups\\Api\\Tracking\\Model\\TrackingResponse' === $type;
    }

    public function supportsNormalization($data, $format = null)
    {
        return \is_object($data) && 'Ups\\Api\\Tracking\\Model\\TrackingResponse' === \get_class($data);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Ups\Api\Tracking\Model\TrackingResponse();
        if (\array_key_exists('shipment', $data) && null !== $data['shipment']) {
            $values = [];
            foreach ($data['shipment'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Ups\\Api\\Tracking\\Model\\Shipment', 'json', $context);
            }
            $object->setShipment($values);
        } elseif (\array_key_exists('shipment', $data) && null === $data['shipment']) {
            $object->setShipment(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getShipment()) {
            $values = [];
            foreach ($object->getShipment() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['shipment'] = $values;
        }

        return $data;
    }
}

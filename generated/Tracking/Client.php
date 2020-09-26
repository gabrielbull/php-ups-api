<?php

declare(strict_types=1);

namespace Ups\Api\Tracking;

class Client extends \Jane\OpenApiRuntime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return \Ups\Api\Tracking\Model\TrackingResponse|\Psr\Http\Message\ResponseInterface|null
     */
    public function getDetailByInquiryNumber(string $inquiryNumber, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Ups\Api\Tracking\Endpoint\GetDetailByInquiryNumber($inquiryNumber), $fetch);
    }

    public static function create($httpClient = null, array $additionalPlugins = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://onlinetools.ups.com/track/v1');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (\count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $serializer = new \Symfony\Component\Serializer\Serializer([new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \Ups\Api\Tracking\Normalizer\JaneObjectNormalizer()], [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);

        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}

<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Endpoint;

class GetDetail extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Endpoint
{
    use \Jane\OpenApiRuntime\Client\EndpointTrait;
    protected $inquiryNumber;

    public function __construct(string $inquiryNumber)
    {
        $this->inquiryNumber = $inquiryNumber;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{inquiryNumber}'], [$this->inquiryNumber], '/details');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ups\Api\Tracking\Model\TrackingResponse|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && false !== mb_strpos($contentType, 'application/json')) {
            return $serializer->deserialize($body, 'Ups\\Api\\Tracking\\Model\\TrackingResponse', 'json');
        }

        return null;
    }
}

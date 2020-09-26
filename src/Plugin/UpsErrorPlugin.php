<?php

declare(strict_types=1);

namespace Ups\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Ups\Exception\UpsErrorException;

class UpsErrorPlugin implements Plugin
{
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $promise = $next($request);

        return $promise->then(function (ResponseInterface $response) use ($request) {
            if (200 === $response->getStatusCode()) {
                return $response;
            }

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            throw new UpsErrorException($data['response']['errors'][0]['code'], $data['response']['errors'][0]['message']);
        });
    }
}

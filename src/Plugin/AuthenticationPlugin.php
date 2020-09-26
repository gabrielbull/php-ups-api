<?php

declare(strict_types=1);

namespace Ups\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class AuthenticationPlugin implements Plugin
{
    /**
     * @var string
     */
    private $accessKey;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $password;

    public function __construct(string $accessKey, string $userId, string $password)
    {
        $this->accessKey = $accessKey;
        $this->userId = $userId;
        $this->password = $password;
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $request = $request->withAddedHeader('AccessLicenseNumber', $this->accessKey);
        $request = $request->withAddedHeader('Username', $this->userId);
        $request = $request->withAddedHeader('Password', $this->password);

        return $next($request);
    }
}

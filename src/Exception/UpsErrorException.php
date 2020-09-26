<?php

declare(strict_types=1);

namespace Ups\Exception;

class UpsErrorException extends \Exception
{
    /**
     * @var string
     */
    private $errorCode;

    public function __construct(string $errorCode, string $message, \Throwable $previous = null)
    {
        $this->errorCode = $errorCode;

        parent::__construct(
            sprintf('%s: %s', $errorCode, $message),
            0,
            $previous
        );
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}

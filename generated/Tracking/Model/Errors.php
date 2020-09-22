<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Errors
{
    /**
     * @var string|null
     */
    protected $code;
    /**
     * @var string|null
     */
    protected $message;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}

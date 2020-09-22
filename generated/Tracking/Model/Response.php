<?php

declare(strict_types=1);

namespace Ups\Api\Tracking\Model;

class Response
{
    /**
     * @var Errors[]|null
     */
    protected $errors;

    /**
     * @return Errors[]|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param Errors[]|null $errors
     */
    public function setErrors(?array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }
}

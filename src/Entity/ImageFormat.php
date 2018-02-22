<?php

namespace Ups\Entity;

class ImageFormat
{
    const IF_PDF = 'PDF';

    public $Code;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        if (null !== $response) {
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
    }
}

<?php

namespace Ups\Entity;

class LabelSpecification
{
    public $HTTPUserAgent;
    public $LabelImageFormat;

    /** @var LabelStockSize|null */
    public $LabelStockSize;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->LabelImageFormat = new LabelImageFormat();

        if (null !== $response) {
            if (isset($response->HTTPUserAgent)) {
                $this->HTTPUserAgent = $response->HTTPUserAgent;
            }
            if (isset($response->LabelImageFormat)) {
                $this->LabelImageFormat = new LabelImageFormat($response->LabelImageFormat);
            }
        }
    }
}

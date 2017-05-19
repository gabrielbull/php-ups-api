<?php

namespace Ups\Entity;

class LabelImage
{
    public $LabelImageFormat;
    public $GraphicImage;
    public $HTMLImage;
    public $PDF417;
    public $InternationalSignatureGraphicImage;
    public $URL;

    /**
     * @param \stdClass|null $response
     */
    public function __construct(\stdClass $response = null)
    {
        $this->LabelImageFormat = new LabelImageFormat();

        if (null !== $response) {
            if (isset($response->LabelImageFormat)) {
                $this->LabelImageFormat = new LabelImageFormat($response->LabelImageFormat);
            }
            if (isset($response->GraphicImage)) {
                $this->GraphicImage = $response->GraphicImage;
            }
            if (isset($response->HTMLImage)) {
                $this->HTMLImage = $response->HTMLImage;
            }
            if (isset($response->PDF417)) {
                $this->PDF417 = $response->PDF417;
            }
            if (isset($response->InternationalSignatureGraphicImage)) {
                $this->InternationalSignatureGraphicImage = $response->InternationalSignatureGraphicImage;
            }
            if (isset($response->URL)) {
                $this->URL = $response->URL;
            }
        }
    }
}

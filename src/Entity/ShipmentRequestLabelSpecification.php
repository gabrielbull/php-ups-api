<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a license agreement, see the LICENSE file.
 */


namespace Ups\Entity;

/**
 * Based on UPS Developer Guide, dated: 13 Jul 2015
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class ShipmentRequestLabelSpecification
{
    /**
     * Required.
     * Label print method code that the labels are to be generated. For EPL2 formatted labels use EPL, for SPL formatted
     * labels use SPL, for ZPL formatted labels use ZPL, for STAR printer formatted labels use STARPL and for image
     * formats use GIF.
     *
     * @var string
     */
    private $printMethodCode;

    /**
     * Optional.
     * Label Specification Code description
     *
     * @var string
     */
    private $printMethodDescription;

    /**
     * Optional.
     * Browser HTTPUserAgent String. This is the preferred way of identifying GIF image type to be generated
     *
     * @var string
     */
    private $httpUserAgent;

    /**
     * Required for EPL2, ZPL, STARPL and SPL labels.
     * Height of the label image. For IN, use whole inches. Only valid value is 4.
     * Label Image will only scale up to 4 X 6, even when requesting 4 X 8.
     *
     * @var string
     */
    private $stockSizeHeight;

    /**
     * Required for EPL2, ZPL, STARPL and SPL labels.
     * Height of the label image. For IN, use whole inches. Only valid values are 6 or 8.
     * Label Image will only scale up to 4 X 6, even when requesting 4 X 8.
     *
     * @var string
     */
    private $stockSizeWidth;

    /**
     * Required if $printMethodCode = GIF.
     * Code type that the label image is to be generated in.
     * Valid values are GIF or PNG. Only GIF is supported on the remote server.
     *
     * @var string
     */
    private $imageFormatCode;

    /**
     * Optional.
     * Description of the label image format code.
     *
     * @var string
     */
    private $imageFormatDescription;

    /**
     * Optional.
     * For Exchange Forward Shipment, Valid values are:
     * 01 - EXCHANGE-LIKE ITEM ONLY.
     * 02 - EXCHANGE-DRIVER INSTRUCTIONS INSIDE
     * By default label will have Exchange Routing instruction Text as EXCHANGE-LIKE ITEM ONLY
     *
     * @var string
     */
    private $instructionCode;

    /**
     * Optional.
     * Description of the label Instruction code.
     *
     * @var string
     */
    private $instructionDescription;
    
    /**
     * Optional.
     * Language character set expected on label. Valid values are:
     * dan = Danish (Latin-1)
     * nld = Dutch (Latin-1)
     * fin = Finnish (Latin-1)
     * fra = French (Latin-1)
     * deu = German (Latin-1)
     * itl = Italian (Latin-1)
     * nor = Norwegian (Latin-1)
     * pol = Polish (Latin-2)
     * por = Poruguese (Latin-1)
     * spa = Spanish (Latin-1)
     * swe = Swedish (Latin-1)
     * ces = Czech (Latin-2)
     * hun = Hungarian (Latin-2)
     * slk = Slovak (Latin-2)
     * rus = Russian (Cyrillic)
     * tur = Turkish (Latin-5)
     * ron = Romanian (Latin-2)
     * bul = Bulgarian (Latin-2)
     * est = Estonian (Latin-2)
     * ell = Greek (Latin-2)
     * lav = Latvian (Latin-2)
     *
     * @var string
     */
    private $characterSet;

    const PRINT_METHOD_CODE_EPL = 'EPL';
    const PRINT_METHOD_CODE_SPL = 'SPL';
    const PRINT_METHOD_CODE_ZPL = 'ZPL';
    const PRINT_METHOD_CODE_STARPL = 'STARPL';
    const PRINT_METHOD_CODE_GIF = 'GIF';

    const IMG_FORMAT_CODE_GIF = 'GIF';
    const IMG_FORMAT_CODE_PNG = 'PNG';

    const INSTRUCTION_CODE_EXCHANGE_LIKE_ITEM_ONLY = '01';
    const INSTRUCTION_CODE_EXCHANGE_DRIVER_INSTRUCTIONS_INSIDE = '02';
    
    const CHARACTER_SET_DANISH = 'dan';
    const CHARACTER_SET_DUTCH = 'nld';
    const CHARACTER_SET_FINNISH = 'fin';
    const CHARACTER_SET_FRENCH = 'fra';
    const CHARACTER_SET_GERMAN = 'deu';
    const CHARACTER_SET_ITALIAN = 'itl';
    const CHARACTER_SET_NORWEGIAN = 'nor';
    const CHARACTER_SET_POLISH = 'pol';
    const CHARACTER_SET_PORUGUESE = 'por';
    const CHARACTER_SET_SPANISH = 'spa';
    const CHARACTER_SET_SWEDISH = 'swe';
    const CHARACTER_SET_CZECH = 'ces';
    const CHARACTER_SET_HUNGARIAN = 'hun';
    const CHARACTER_SET_SLOVAK = 'slk';
    const CHARACTER_SET_RUSSIAN = 'rus';
    const CHARACTER_SET_TURKISH = 'tur';
    const CHARACTER_SET_ROMANIAN = 'ron';
    const CHARACTER_SET_BULGARIAN = 'bul';
    const CHARACTER_SET_ESTONIAN = 'est';
    const CHARACTER_SET_GREEK = 'ell';
    const RACTER_SET_LATVIAN = 'lav';

    /**
     * @param string $printMethodCode
     */
    public function __construct($printMethodCode)
    {
        $this->printMethodCode = $printMethodCode;
    }

    /**
     * @return string
     */
    public function getPrintMethodCode()
    {
        return $this->printMethodCode;
    }

    /**
     * @return string
     */
    public function getPrintMethodDescription()
    {
        return $this->printMethodDescription;
    }

    /**
     * @param string $printMethodDescription
     * @return ShipmentRequestLabelSpecification
     */
    public function setPrintMethodDescription($printMethodDescription)
    {
        $this->printMethodDescription = $printMethodDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpUserAgent()
    {
        return $this->httpUserAgent;
    }

    /**
     * @param string $httpUserAgent
     * @return ShipmentRequestLabelSpecification
     */
    public function setHttpUserAgent($httpUserAgent)
    {
        $this->httpUserAgent = $httpUserAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getStockSizeHeight()
    {
        return $this->stockSizeHeight;
    }

    /**
     * @param string $stockSizeHeight
     * @return ShipmentRequestLabelSpecification
     */
    public function setStockSizeHeight($stockSizeHeight)
    {
        $this->stockSizeHeight = $stockSizeHeight;

        return $this;
    }

    /**
     * @return string
     */
    public function getStockSizeWidth()
    {
        return $this->stockSizeWidth;
    }

    /**
     * @param string $stockSizeWidth
     * @return ShipmentRequestLabelSpecification
     */
    public function setStockSizeWidth($stockSizeWidth)
    {
        $this->stockSizeWidth = $stockSizeWidth;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageFormatCode()
    {
        return $this->imageFormatCode;
    }

    /**
     * @param string $imageFormatCode
     * @return ShipmentRequestLabelSpecification
     */
    public function setImageFormatCode($imageFormatCode)
    {
        $this->imageFormatCode = $imageFormatCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageFormatDescription()
    {
        return $this->imageFormatDescription;
    }

    /**
     * @param string $imageFormatDescription
     * @return ShipmentRequestLabelSpecification
     */
    public function setImageFormatDescription($imageFormatDescription)
    {
        $this->imageFormatDescription = $imageFormatDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionCode()
    {
        return $this->instructionCode;
    }

    /**
     * @param string $instructionCode
     * @return ShipmentRequestLabelSpecification
     */
    public function setInstructionCode($instructionCode)
    {
        $this->instructionCode = $instructionCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionDescription()
    {
        return $this->instructionDescription;
    }

    /**
     * @param string $instructionDescription
     * @return ShipmentRequestLabelSpecification
     */
    public function setInstructionDescription($instructionDescription)
    {
        $this->instructionDescription = $instructionDescription;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getCharacterSet()
    {
        return $this->characterSet;
    }

    /**
     * @param string $characterSet
     * @return ShipmentRequestLabelSpecification
     */
    public function setCharacterSet($characterSet)
    {
        $this->characterSet = $characterSet;
        return $this;
    }
}

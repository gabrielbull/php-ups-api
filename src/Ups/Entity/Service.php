<?php
namespace Ups\Entity;

class Service
{
    // Valid domestic values
    const S_AIR_1DAYEARLYAM = '14';
    const S_AIR_1DAY = '01';
    const S_AIR_1DAYSAVER = '13';
    const S_AIR_2DAYAM = '29';
    const S_AIR_2DAY = '02';
    const S_3DAYSELECT = '12';
    const S_GROUND = '03';

    // Valid international values
    const S_STANDARD = '11';
    const S_WW_EXPRESS = '07';
    const S_WW_EXPRESSPLUS = '54';
    const S_WW_EXPEDITED = '08';
    const S_SAVER = '65'; // Require for Rating, ignored for Shopping

    // Valid Poland to Poland same day values
    const S_UPSTODAY_STANDARD = '82';
    const S_UPSTODAY_DEDICATEDCOURIER = '83';
    const S_UPSTODAY_INTERCITY = '84';
    const S_UPSTODAY_EXPRESS = '85';
    const S_UPSTODAY_EXPRESSSAVER = '86';
    const S_UPSWW_EXPRESSFREIGHT = '96';

    /** @deprecated */
    public $Code = self::S_GROUND;
    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::S_GROUND;

    /**
     * @var string
     */
    private $description;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shipping.service.code' . $this->getCode();
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->Code = $code;
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->Description = $description;
        $this->description = $description;
        return $this;
    }
}
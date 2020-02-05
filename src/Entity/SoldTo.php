<?php

namespace Ups\Entity;

class SoldTo extends ShipTo
{
    /**
     * @var string
     */
    private $option;

    /**
     * @inheritdoc
     */
    public function __construct(\stdClass $attributes = null)
    {
        parent::__construct($attributes);

        if (null !== $attributes) {
            if (isset($attributes->Option)) {
                $this->setOption($attributes->Option);
            }
        }
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param string $option
     *
     * @return $this
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }
}

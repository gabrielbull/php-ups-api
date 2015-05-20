<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class AddressArtifactFormat implements NodeInterface
{

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $politicalDivision1;

    /**
     * @var string
     */
    private $politicalDivision2;

    /**
     * @var string
     */
    private $politicalDivision3;

    /**
     * @var string
     */
    private $postcodePrimaryLow;

    /**
     * @var string
     */
    private $postcodePrimaryHigh;


    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->CountryCode)) {
                $this->setCountryCode($attributes->CountryCode);
            }
            if (isset($attributes->Country)) {
                $this->setCountryCode($attributes->Country);
            }
            if (isset($attributes->PoliticalDivision1)) {
                $this->setPoliticalDivision1($attributes->PoliticalDivision1);
            }
            if (isset($attributes->PoliticalDivision2)) {
                $this->setPoliticalDivision2($attributes->PoliticalDivision2);
            }
            if (isset($attributes->PoliticalDivision3)) {
                $this->setPoliticalDivision3($attributes->PoliticalDivision3);
            }
            if (isset($attributes->PostcodePrimaryLow)) {
                $this->setPostcodePrimaryLow($attributes->PostcodePrimaryLow);
            }
            if (isset($attributes->PostcodePrimaryHigh)) {
                $this->setPostcodePrimaryHigh($attributes->PostcodePrimaryHigh);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('AddressArtifactFormat');

        for($i = 1; $i <= 3; $i++) {
            $line = $this->{'getPoliticalDivision'.$i}();
            if ($line) {
                $node->appendChild($document->createElement('PoliticalDivision' . $i, $line));
            }
        }

        if ($this->getCountryCode()) {
            $node->appendChild($document->createElement('CountryCode', $this->getCountryCode()));
        }
        if ($this->getCountry()) {
            $node->appendChild($document->createElement('Country', $this->getCountry()));
        }
        if ($this->getPostcodePrimaryHigh()) {
            $node->appendChild($document->createElement('PostcodePrimaryHigh', $this->getPostcodePrimaryHigh()));
        }
        if ($this->getPostcodePrimaryLow()) {
            $node->appendChild($document->createElement('PostcodePrimaryLow', $this->getPostcodePrimaryLow()));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getPoliticalDivision1()
    {
        return $this->politicalDivision1;
    }

    /**
     * @param string $politicalDivision1
     * @return $this
     */
    public function setPoliticalDivision1($politicalDivision1)
    {
        $this->politicalDivision1 = $politicalDivision1;
        return $this;
    }

    /**
     * @return string
     */
    public function getPoliticalDivision2()
    {
        return $this->politicalDivision2;
    }

    /**
     * @param string $politicalDivision2
     * @return $this
     */
    public function setPoliticalDivision2($politicalDivision2)
    {
        $this->politicalDivision2 = $politicalDivision2;
        return $this;
    }

    /**
     * @return string
     */
    public function getPoliticalDivision3()
    {
        return $this->politicalDivision3;
    }

    /**
     * @param string $politicalDivision3
     * @return $this
     */
    public function setPoliticalDivision3($politicalDivision3)
    {
        $this->politicalDivision3 = $politicalDivision3;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcodePrimaryHigh()
    {
        return $this->postcodePrimaryHigh;
    }

    /**
     * @param string $postcodePrimaryHigh
     * @return $this
     */
    public function setPostcodePrimaryHigh($postcodePrimaryHigh)
    {
        $this->postcodePrimaryHigh = $postcodePrimaryHigh;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcodePrimaryLow()
    {
        return $this->postcodePrimaryLow;
    }

    /**
     * @param string $postcodePrimaryLow
     * @return $this
     */
    public function setPostcodePrimaryLow($postcodePrimaryLow)
    {
        $this->postcodePrimaryLow = $postcodePrimaryLow;
        return $this;
    }

}
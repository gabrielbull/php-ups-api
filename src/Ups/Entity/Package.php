<?php
namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Package implements NodeInterface
{
    const PKG_OVERSIZE1 = '1';
    const PKG_OVERSIZE2 = '2';
    const PKG_LARGE = '4';

    /** @deprecated */
    public $PackagingType;
    /** @deprecated */
    public $PackageWeight;
    /** @deprecated */
    public $Description;
    /** @deprecated */
    public $PackageServiceOptions;
    /** @deprecated */
    public $UPSPremiumCareIndicator;
    /** @deprecated */
    public $ReferenceNumber;
    /** @deprecated */
    public $TrackingNumber;
    /** @deprecated */
    public $LargePackage;
    /** @deprecated */
    public $Dimensions;
    /** @deprecated */
    public $Activity;

    /**
     * @var PackagingType
     */
    private $packagingType;

    /**
     * @var PackageWeight
     */
    private $packageWeight;

    /**
     * @var string
     */
    private $description;

    /**
     * @var PackageServiceOptions
     */
    private $packageServiceOptions;

    /**
     * @var string
     */
    private $upsPremiumCareIndicator;

    /**
     * @var ReferenceNumber
     */
    private $referenceNumber;

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $largePackage;

    /**
     * @var Dimensions
     */
    private $dimensions;

    /**
     * @var Activity[]
     */
    private $activities = array();

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        $this->setPackagingType(new PackagingType);
        $this->setReferenceNumber(new ReferenceNumber);
        $this->setDimensions(new Dimensions);
        $this->setPackageWeight(new PackageWeight);
        $this->setPackageServiceOptions(new PackageServiceOptions);

        if (null !== $attributes) {
            if (isset($attributes->PackageWeight)) {
                $this->setPackageWeight(new PackageWeight($attributes->PackageWeight));
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
            if (isset($attributes->PackageServiceOptions)) {
                $this->setPackageServiceOptions(new PackageServiceOptions($attributes->PackageServiceOptions));
            }
            if (isset($attributes->UPSPremiumCareIndicator)) {
                $this->setUpsPremiumCareIndicator($attributes->UPSPremiumCareIndicator);
            }
            if (isset($attributes->ReferenceNumber)) {
                $this->setReferenceNumber(new ReferenceNumber($attributes->ReferenceNumber));
            }
            if (isset($attributes->TrackingNumber)) {
                $this->setTrackingNumber($attributes->TrackingNumber);
            }
            if (isset($attributes->LargePackage)) {
                $this->setLargePackage($attributes->LargePackage);
            }
            if (isset($attributes->Dimensions)) {
                $this->setDimensions(new Dimensions($attributes->Dimensions));
            }
            if (isset($attributes->Activity)) {
                $activities = $this->getActivities();
                if (is_array($attributes->Activity)) {
                    foreach ($attributes->Activity as $Activity) {
                        $activities[] = new Activity($Activity);
                    }
                } else {
                    $activities[] = new Activity($attributes->Activity);
                }
                $this->setActivities($activities);
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

        $node = $document->createElement('Package');

        $packagingType = $this->getPackagingType();
        if (isset($packagingType)) {
            $node->appendChild($packagingType->toNode($document));
        }

        $node->appendChild($this->getPackageWeight()->toNode($document));
        return $node;
    }

    /**
     * @return Activity[]
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param Activity[] $activities
     * @return $this
     */
    public function setActivities($activities)
    {
        $this->Activity = $activities;
        $this->activities = $activities;
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

    /**
     * @return Dimensions
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param Dimensions $dimensions
     * @return $this
     */
    public function setDimensions(Dimensions $dimensions)
    {
        $this->Dimensions = $dimensions;
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @return string
     */
    public function getLargePackage()
    {
        return $this->largePackage;
    }

    /**
     * @param string $largePackage
     * @return $this
     */
    public function setLargePackage($largePackage)
    {
        $this->LargePackage = $largePackage;
        $this->largePackage = $largePackage;
        return $this;
    }

    /**
     * @return PackageServiceOptions
     */
    public function getPackageServiceOptions()
    {
        return $this->packageServiceOptions;
    }

    /**
     * @param PackageServiceOptions $packageServiceOptions
     * @return $this
     */
    public function setPackageServiceOptions(PackageServiceOptions $packageServiceOptions)
    {
        $this->PackageServiceOptions = $packageServiceOptions;
        $this->packageServiceOptions = $packageServiceOptions;
        return $this;
    }

    /**
     * @return PackageWeight
     */
    public function getPackageWeight()
    {
        return $this->packageWeight;
    }

    /**
     * @param PackageWeight $packageWeight
     * @return $this
     */
    public function setPackageWeight(PackageWeight $packageWeight)
    {
        $this->PackageWeight = $packageWeight;
        $this->packageWeight = $packageWeight;
        return $this;
    }

    /**
     * @return PackagingType
     */
    public function getPackagingType()
    {
        return $this->packagingType;
    }

    /**
     * @param PackagingType $packagingType
     * @return $this
     */
    public function setPackagingType(PackagingType $packagingType)
    {
        $this->PackagingType = $packagingType;
        $this->packagingType = $packagingType;
        return $this;
    }

    /**
     * @return ReferenceNumber
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param ReferenceNumber $referenceNumber
     * @return $this
     */
    public function setReferenceNumber(ReferenceNumber $referenceNumber)
    {
        $this->ReferenceNumber = $referenceNumber;
        $this->referenceNumber = $referenceNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return $this
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->TrackingNumber = $trackingNumber;
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpsPremiumCareIndicator()
    {
        return $this->upsPremiumCareIndicator;
    }

    /**
     * @param string $upsPremiumCareIndicator
     * @return $this
     */
    public function setUpsPremiumCareIndicator($upsPremiumCareIndicator)
    {
        $this->UPSPremiumCareIndicator = $upsPremiumCareIndicator;
        $this->upsPremiumCareIndicator = $upsPremiumCareIndicator;
        return $this;
    }
}
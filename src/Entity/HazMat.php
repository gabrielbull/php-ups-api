<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

/**
 * Class Hazmat
 * @package Ups\Entity
 */
class HazMat implements NodeInterface
{

    /**
     * @var string
     */
    private $packagingTypeQuantity;

    /**
     * @var string
     */
    private $subRiskClass;

    /**
     * @var string
     */
    private $adrItemNumber;

    /**
     * @var string
     */
    private $adrPackingGroupLetter;

    /**
     * @var string
     */
    private $technicalName;

    /**
     * @var string
     */
    private $hazardLabelRequired;

    /**
     * @var string
     */
    private $classDivisionNumber;

    /**
     * @var string
     */
    private $referenceNumber;

    /**
     * @var string
     */
    private $quantity;

    /**
     * @var string
     */
    private $uom;

    /**
     * @var string
     */
    private $packagingType;

    /**
     * @var string
     */
    private $idNumber;

    /**
     * @var string
     */
    private $properShippingName;

    /**
     * @var string
     */
    private $additionalDescription;

    /**
     * @var string
     */
    private $packagingGroupType;

    /**
     * @var string
     */
    private $packagingInstructionCode;

    /**
     * @var string
     */
    private $emergencyPhone;

    /**
     * @var string
     */
    private $emergencyContact;

    /**
     * @var string
     */
    private $reportableQuantity;

    /**
     * @var string
     */
    private $regulationSet;

    /**
     * @var string
     */
    private $transportationMode;

    /**
     * @var string
     */
    private $commodityRegulatedLevelCode;

    /**
     * @var string
     */
    private $transportCategory;

    /**
     * @var string
     */
    private $tunnelRestrictionCode;

    /**
     * @var string
     */
    private $chemicalRecordIdentifier;

    /**
     * @param DOMDocument|null $document
     * @return \DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('HazMat');


        if ($this->getPackagingTypeQuantity()) {
            $node->appendChild($document->createElement('PackagingTypeQuantity', ($this->getPackagingTypeQuantity()) !== null ? htmlspecialchars($this->getPackagingTypeQuantity()) : null));
        }
        if ($this->getSubRiskClass()) {
            $node->appendChild($document->createElement('SubRiskClass', ($this->getSubRiskClass()) !== null ? htmlspecialchars($this->getSubRiskClass()) : null));
        }
        if ($this->getAdrItemNumber()) {
            $node->appendChild($document->createElement('aDRItemNumber', ($this->getAdrItemNumber()) !== null ? htmlspecialchars($this->getAdrItemNumber()) : null));
        }
        if ($this->getAdrPackingGroupLetter()) {
            $node->appendChild($document->createElement('aDRPackingGroupLetter', ($this->getAdrPackingGroupLetter()) !== null ? htmlspecialchars($this->getAdrPackingGroupLetter()) : null));
        }
        if ($this->getTechnicalName()) {
            $node->appendChild($document->createElement('TechnicalName', ($this->getTechnicalName()) !== null ? htmlspecialchars($this->getTechnicalName()) : null));
        }
        if ($this->getHazardLabelRequired()) {
            $node->appendChild($document->createElement('HazardLabelRequired', ($this->getHazardLabelRequired()) !== null ? htmlspecialchars($this->getHazardLabelRequired()) : null));
        }
        if ($this->getReferenceNumber()) {
            $node->appendChild($document->createElement('ReferenceNumber', ($this->getReferenceNumber()) !== null ? htmlspecialchars($this->getReferenceNumber()) : null));
        }
        if ($this->getQuantity()) {
            $node->appendChild($document->createElement('Quantity', ($this->getQuantity()) !== null ? htmlspecialchars($this->getQuantity()) : null));
        }
        if ($this->getClassDivisionNumber()) {
            $node->appendChild($document->createElement('ClassDivisionNumber', ($this->getClassDivisionNumber()) !== null ? htmlspecialchars($this->getClassDivisionNumber()) : null));
        }
        if ($this->getUom()) {
            $node->appendChild($document->createElement('UOM', ($this->getUom()) !== null ? htmlspecialchars($this->getUom()) : null));
        }
        if ($this->getPackagingType()) {
            $node->appendChild($document->createElement('PackagingType', ($this->getPackagingType()) !== null ? htmlspecialchars($this->getPackagingType()) : null));
        }
        if ($this->getIdNumber()) {
            $node->appendChild($document->createElement('IDNumber', ($this->getIdNumber()) !== null ? htmlspecialchars($this->getIdNumber()) : null));
        }
        if ($this->getProperShippingName()) {
            $node->appendChild($document->createElement('ProperShippingName', ($this->getProperShippingName()) !== null ? htmlspecialchars($this->getProperShippingName()) : null));
        }
        if ($this->getAdditionalDescription()) {
            $node->appendChild($document->createElement('AdditionalDescription', ($this->getAdditionalDescription()) !== null ? htmlspecialchars($this->getAdditionalDescription()) : null));
        }
        if ($this->getPackagingGroupType()) {
            $node->appendChild($document->createElement('PackagingGroupType', ($this->getPackagingGroupType()) !== null ? htmlspecialchars($this->getPackagingGroupType()) : null));
        }
        if ($this->getPackagingInstructionCode()) {
            $node->appendChild($document->createElement('PackagingInstructionCode', ($this->getPackagingInstructionCode()) !== null ? htmlspecialchars($this->getPackagingInstructionCode()) : null));
        }
        if ($this->getEmergencyPhone()) {
            $node->appendChild($document->createElement('EmergencyPhone', ($this->getEmergencyPhone()) !== null ? htmlspecialchars($this->getEmergencyPhone()) : null));
        }
        if ($this->getEmergencyContact()) {
            $node->appendChild($document->createElement('EmergencyContact', ($this->getEmergencyContact()) !== null ? htmlspecialchars($this->getEmergencyContact()) : null));
        }
        if ($this->getReportableQuantity()) {
            $node->appendChild($document->createElement('ReportableQuantity', ($this->getReportableQuantity()) !== null ? htmlspecialchars($this->getReportableQuantity()) : null));
        }
        if ($this->getRegulationSet()) {
            $node->appendChild($document->createElement('RegulationSet', ($this->getRegulationSet()) !== null ? htmlspecialchars($this->getRegulationSet()) : null));
        }
        if ($this->getTransportationMode()) {
            $node->appendChild($document->createElement('TransportationMode', ($this->getTransportationMode()) !== null ? htmlspecialchars($this->getTransportationMode()) : null));
        }
        if ($this->getCommodityRegulatedLevelCode()) {
            $node->appendChild($document->createElement('CommodityRegulatedLevelCode', ($this->getCommodityRegulatedLevelCode()) !== null ? htmlspecialchars($this->getCommodityRegulatedLevelCode()) : null));
        }
        if ($this->getTransportCategory()) {
            $node->appendChild($document->createElement('TransportCategory', ($this->getTransportCategory()) !== null ? htmlspecialchars($this->getTransportCategory()) : null));
        }
        if ($this->getTunnelRestrictionCode()) {
            $node->appendChild($document->createElement('TunnelRestrictionCode', ($this->getTunnelRestrictionCode()) !== null ? htmlspecialchars($this->getTunnelRestrictionCode()) : null));
        }
        if ($this->getChemicalRecordIdentifier()) {
            $node->appendChild($document->createElement('ChemicalRecordIdentifier', ($this->getChemicalRecordIdentifier()) !== null ? htmlspecialchars($this->getChemicalRecordIdentifier()) : null));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getPackagingTypeQuantity()
    {
        return $this->packagingTypeQuantity;
    }

    /**
     * @param string $packagingTypeQuantity
     */
    public function setPackagingTypeQuantity($packagingTypeQuantity)
    {
        $this->packagingTypeQuantity = $packagingTypeQuantity;
    }

    /**
     * @return string
     */
    public function getSubRiskClass()
    {
        return $this->subRiskClass;
    }

    /**
     * @param string $subRiskClass
     */
    public function setSubRiskClass($subRiskClass)
    {
        $this->subRiskClass = $subRiskClass;
    }

    /**
     * @return string
     */
    public function getAdrItemNumber()
    {
        return $this->adrItemNumber;
    }

    /**
     * @param string $adrItemNumber
     */
    public function setAdrItemNumber($adrItemNumber)
    {
        $this->adrItemNumber = $adrItemNumber;
    }

    /**
     * @return string
     */
    public function getAdrPackingGroupLetter()
    {
        return $this->adrPackingGroupLetter;
    }

    /**
     * @param string $adrPackingGroupLetter
     */
    public function setAdrPackingGroupLetter($adrPackingGroupLetter)
    {
        $this->adrPackingGroupLetter = $adrPackingGroupLetter;
    }

    /**
     * @return string
     */
    public function getTechnicalName()
    {
        return $this->technicalName;
    }

    /**
     * @param string $technicalName
     */
    public function setTechnicalName($technicalName)
    {
        $this->technicalName = $technicalName;
    }

    /**
     * @return string
     */
    public function getHazardLabelRequired()
    {
        return $this->hazardLabelRequired;
    }

    /**
     * @param string $hazardLabelRequired
     */
    public function setHazardLabelRequired($hazardLabelRequired)
    {
        $this->hazardLabelRequired = $hazardLabelRequired;
    }

    /**
     * @return string
     */
    public function getClassDivisionNumber()
    {
        return $this->classDivisionNumber;
    }

    /**
     * @param string $classDivisionNumber
     */
    public function setClassDivisionNumber($classDivisionNumber)
    {
        $this->classDivisionNumber = $classDivisionNumber;
    }

    /**
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param string $referenceNumber
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getUom()
    {
        return $this->uom;
    }

    /**
     * @param string $uom
     */
    public function setUom($uom)
    {
        $this->uom = $uom;
    }

    /**
     * @return string
     */
    public function getPackagingType()
    {
        return $this->packagingType;
    }

    /**
     * @param string $packagingType
     */
    public function setPackagingType($packagingType)
    {
        $this->packagingType = $packagingType;
    }

    /**
     * @return string
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @return string
     */
    public function getProperShippingName()
    {
        return $this->properShippingName;
    }

    /**
     * @param string $properShippingName
     */
    public function setProperShippingName($properShippingName)
    {
        $this->properShippingName = $properShippingName;
    }

    /**
     * @return string
     */
    public function getAdditionalDescription()
    {
        return $this->additionalDescription;
    }

    /**
     * @param string $additionalDescription
     */
    public function setAdditionalDescription($additionalDescription)
    {
        $this->additionalDescription = $additionalDescription;
    }

    /**
     * @return string
     */
    public function getPackagingGroupType()
    {
        return $this->packagingGroupType;
    }

    /**
     * @param string $packagingGroupType
     */
    public function setPackagingGroupType($packagingGroupType)
    {
        $this->packagingGroupType = $packagingGroupType;
    }

    /**
     * @return string
     */
    public function getPackagingInstructionCode()
    {
        return $this->packagingInstructionCode;
    }

    /**
     * @param string $packagingInstructionCode
     */
    public function setPackagingInstructionCode($packagingInstructionCode)
    {
        $this->packagingInstructionCode = $packagingInstructionCode;
    }

    /**
     * @return string
     */
    public function getEmergencyPhone()
    {
        return $this->emergencyPhone;
    }

    /**
     * @param string $emergencyPhone
     */
    public function setEmergencyPhone($emergencyPhone)
    {
        $this->emergencyPhone = $emergencyPhone;
    }

    /**
     * @return string
     */
    public function getEmergencyContact()
    {
        return $this->emergencyContact;
    }

    /**
     * @param string $emergencyContact
     */
    public function setEmergencyContact($emergencyContact)
    {
        $this->emergencyContact = $emergencyContact;
    }

    /**
     * @return string
     */
    public function getReportableQuantity()
    {
        return $this->reportableQuantity;
    }

    /**
     * @param string $reportableQuantity
     */
    public function setReportableQuantity($reportableQuantity)
    {
        $this->reportableQuantity = $reportableQuantity;
    }

    /**
     * @return string
     */
    public function getRegulationSet()
    {
        return $this->regulationSet;
    }

    /**
     * @param string $regulationSet
     */
    public function setRegulationSet($regulationSet)
    {
        $this->regulationSet = $regulationSet;
    }

    /**
     * @return string
     */
    public function getTransportationMode()
    {
        return $this->transportationMode;
    }

    /**
     * @param string $transportationMode
     */
    public function setTransportationMode($transportationMode)
    {
        $this->transportationMode = $transportationMode;
    }

    /**
     * @return string
     */
    public function getCommodityRegulatedLevelCode()
    {
        return $this->commodityRegulatedLevelCode;
    }

    /**
     * @param string $commodityRegulatedLevelCode
     */
    public function setCommodityRegulatedLevelCode($commodityRegulatedLevelCode)
    {
        $this->commodityRegulatedLevelCode = $commodityRegulatedLevelCode;
    }

    /**
     * @return string
     */
    public function getTransportCategory()
    {
        return $this->transportCategory;
    }

    /**
     * @param string $transportCategory
     */
    public function setTransportCategory($transportCategory)
    {
        $this->transportCategory = $transportCategory;
    }

    /**
     * @return string
     */
    public function getTunnelRestrictionCode()
    {
        return $this->tunnelRestrictionCode;
    }

    /**
     * @param string $tunnelRestrictionCode
     */
    public function setTunnelRestrictionCode($tunnelRestrictionCode)
    {
        $this->tunnelRestrictionCode = $tunnelRestrictionCode;
    }

    /**
     * @return string
     */
    public function getChemicalRecordIdentifier()
    {
        return $this->chemicalRecordIdentifier;
    }

    /**
     * @param string $chemicalRecordIdentifier
     */
    public function setChemicalRecordIdentifier($chemicalRecordIdentifier)
    {
        $this->chemicalRecordIdentifier = $chemicalRecordIdentifier;
    }
}

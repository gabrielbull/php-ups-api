<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;

use \Ups\Entity\PackageServiceOptions;

class UPSPackageServiceOptions extends PackageServiceOptions
{
  /**
   * @var COD
   */
  private $cod;

  /**
   * @var InsuredValue
   */
  private $insuredValue;

  /**
   * @var string
   */
  private $earliestDeliveryTime;

  /**
   * @var HazMat[]
   */
  private $hazMat = [];

  /**
   * @var HazMatPackageInformation
   */
  private $hazMatPackageInformation;

  /**
   * @var string
   */
  private $holdForPickup;

  /**
   * @var DeliveryConfirmation
   */
  private $deliveryConfirmation;

  private $upsPremiumCareIndicator;

  private $codCode;
  private $codFundsCode;
  private $codCurrencyCode;
  private $codMonetaryValue;

/**
* @param null $parameters
*/
public function __construct($parameters = null)
{
  if (null !== $parameters) {
    if (isset($parameters->COD)) {
      $this->setCOD(new COD($parameters->COD));
    }
    if (isset($parameters->InsuredValue)) {
      $this->setInsuredValue(new InsuredValue($parameters->InsuredValue));
    }
    if (isset($parameters->EarliestDeliveryTime)) {
      $this->setEarliestDeliveryTime($parameters->EarliestDeliveryTime);
    }
    if (isset($parameters->HoldForPickup)) {
      $this->setHoldForPickup($parameters->HoldForPickup);
    }
    if (isset($parameters->DeliveryConfirmation)) {
      $this->setDeliveryConfirmation($parameters->DeliveryConfirmation);
    }
  }
}

  /**
   * @param null|DOMDocument $document
   *
   * @TODO: this seem to be awfully incomplete
   *
   * @return DOMElement
   */
  public function toNode(DOMDocument $document = null)
  {
    if (null === $document) {
        $document = new DOMDocument();
    }

    $node = $document->createElement('PackageServiceOptions');

    if ($this->getInsuredValue()) {
      $node->appendChild($this->getInsuredValue()->toNode($document));
    }
    foreach ($this->getHazMat() as $hazmat) {
      $node->appendChild($hazmat->toNode($document));
    }
    if ($this->getHazMatPackageInformation() !== null) {
      $node->appendChild($this->getHazMatPackageInformation()->toNode($document));
    }
    if (isset($this->deliveryConfirmation)) {
      $node->appendChild($this->deliveryConfirmation->toNode($document));
    }

    if ($this->getUpsPremiumCareIndicator()) {
      $node->appendChild($document->createElement('UPSPremiumCareIndicator'));
    }

    if ($this->getCOD()) {

      $nodeCOD = $document->createElement('COD');

      $nodeCOD->appendChild($document->createElement('CODCode', $this->getCodCode()));
      $nodeCOD->appendChild($document->createElement('CODFundsCode', $this->getCodFundsCode()));

      $nodeCODAmount = $document->createElement('CODAmount');

      $nodeCODAmount->appendChild($document->createElement('CurrencyCode', $this->getCodCurrencyCode()));
      $nodeCODAmount->appendChild($document->createElement('MonetaryValue', $this->getCodMonetaryValue()));

      $nodeCOD->appendChild($nodeCODAmount);

      $node->appendChild($nodeCOD);
    }

    return $node;
  }

  /**
  * @return InsuredValue|null
  */
  public function getInsuredValue()
  {
    return $this->insuredValue;
  }

  /**
  * @param $var
  */
  public function setInsuredValue($var)
  {
    $this->insuredValue = $var;
  }

  /**
  * @return COD|null
  */
  public function getCOD()
  {
    return $this->cod;
  }

  /**
  * @param $var
  */
  public function setCOD($var)
  {
    $this->cod = $var;
  }

  /**
  * @return string|null
  */
  public function getEarliestDeliveryTime()
  {
    return $this->earliestDeliveryTime;
  }

  /**
  * @param $var
  */
  public function setEarliestDeliveryTime($var)
  {
    $this->earliestDeliveryTime = $var;
  }

  /**
  * @return HazMat[]
  */
  public function getHazMat()
  {
    return $this->hazMat;
  }

  /**
  * @param HazMat[] $hazMat
  */
  public function setHazMat(array $hazMat)
  {
    $this->hazMat = $hazMat;
  }

  /**
  * @param HazMat $hazmat
  */
  public function addHazMat(\Ups\Entity\HazMat $hazmat)
  {
    $this->hazMat[] = $hazmat;
  }

  /**
  * @return string|null
  */
  public function getHoldForPickup()
  {
    return $this->holdForPickup;
  }

  /**
  * @param $var
  */
  public function setHoldForPickup($var)
  {
    $this->holdForPickup = $var;
  }

  /**
  * @return HazMatPackageInformation
  */
  public function getHazMatPackageInformation()
  {
    return $this->hazMatPackageInformation;
  }

  /**
  * @param HazMatPackageInformation $hazMatPackageInformation
  */
  public function setHazMatPackageInformation($hazMatPackageInformation)
  {
    $this->hazMatPackageInformation = $hazMatPackageInformation;
  }

  /**
  * @param DeliveryConfirmation $deliveryConfirmation
  * @return ShipmentServiceOptions
  */
  public function setDeliveryConfirmation(\Ups\Entity\DeliveryConfirmation $deliveryConfirmation)
  {
    $this->deliveryConfirmation = $deliveryConfirmation;
    return $this;
  }

  /**
  * @return DeliveryConfirmation|null
  */
  public function getDeliveryConfirmation()
  {
    return $this->deliveryConfirmation;
  }

  public function setUpsPremiumCareIndicator($upsPremiumCareIndicator)
  {
    $this->upsPremiumCareIndicator = $upsPremiumCareIndicator;
    return $this;
  }

  public function getUpsPremiumCareIndicator()
  {
    return $this->upsPremiumCareIndicator;
  }

  public function setCodCode($codCode)
  {
    $this->codCode = $codCode;
    return $this;
  }

  public function getCodCode()
  {
    return $this->codCode;
  }

  public function setCodFundsCode($codFundsCode)
  {
    $this->codFundsCode = $codFundsCode;
    return $this;
  }

  public function getCodFundsCode()
  {
    return $this->codFundsCode;
  }

  public function setCodCurrencyCode($codCurrencyCode)
  {
    $this->codCurrencyCode = $codCurrencyCode;
    return $this;
  }

  public function getCodCurrencyCode()
  {
    return $this->codCurrencyCode;
  }

  public function setCodMonetaryValue($codMonetaryValue)
  {
    $this->codMonetaryValue = $codMonetaryValue;
    return $this;
  }

  public function getCodMonetaryValue()
  {
    return $this->codMonetaryValue;
  }
}
<?php namespace Ups\Tests;

use PHPUnit_Framework_TestCase;
use Ups\NodeInterface;

/**
 * Used to test some base functionality of entities
 *
 * Class EntityTest
 * @package Ups\Tests
 */
class EntityTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var array
     */
    protected $nodeListWithConstructAndNodeInterface = [
        'ShipmentRequestLabelSpecification',
        'ShipmentRequestReceiptSpecification',
        'AddressValidationResponse',
        'AddressValidation\AVAddress',
        'AddressValidation\AddressClassification',
        'LabelDelivery'
    ];

    /**
     * @var array
     */
    protected $nodeListNoNodeInterface = [
        'NegotiatedRates',
        'ServiceSummary',
        'NetSummaryCharges',
        'Activity',
        'ActivityLocation',
        'EstimatedArrival',
        'Origin',
        'Shipment',
        'Exception',
        'FailureNotification',
        'ShipmentReferenceNumber',
        'AddressExtendedInformation',
        'PackageReferenceNumber',
        'FreightCollect',
        'Generic',
        'AutoDutyCode',
        'Guaranteed',
        'PaymentInformation',
        'BillShipper',
        'Image',
        'PickupDateRange',
        'BillThirdParty',
        'ImageFormat',
        'StatusType',
        'BillToAccount',
        'Prepaid',
        'SubscriptionEvents',
        'QuantumViewEvents',
        'SubscriptionStatus',
        'QuantumViewResponse',
        'TimeInTransitRequest',
        'CallTagARS',
        'LabelImage',
        'TimeInTransitResponse',
        'Charges',
        'LabelImageFormat',
        'RateRequest',
        'TrackingCandidate',
        'CreditCard',
        'LabelRecoveryRequest',
        'RateResponse',
        'LabelRecoveryResponse',
        'RatedPackage',
        'CustomsValue',
        'LabelResults',
        'RatedShipment',
        'Tradeability\LandedCostRequest',
        'DateRange',
        'LabelSpecification',
        'Receipt',
        'Delivery',
        'Resolution',
        'UpdatedAddress',
        'Manifest',
        'LocatorRequest',
        'DimensionalWeight',
        'DeliveryLocation',
        'SubscriptionFile',
        'BillingWeight',
        'FailureNotificationCode',
    ];

    /**
     * @var array
     */
    protected $nodeListNoConstructAndNodeInterface = [
        'AccessPointCOD',
        'Discount',
        'AccessPointSearch',
        'EEIFilingOption',
        'ShipFrom',
        'EmailMessage',
        'Notification',
        'ShipTo',
        'Address',
        'OriginAddress',
        'ShipmentIndicationType',
        'AddressArtifactFormat',
        'POA',
        'Package',
        'AddressKeyFormat',
        'FreightCharges',
        'PackageServiceOptions',
        'ShipmentServiceOptions',
        'PackageWeight',
        'ShipmentWeight',
        'AlternateDeliveryAddress',
        'GeoCode',
        'PackagingType',
        'Shipper',
        'ShipperFiled',
        'SoldTo',
        'PickupType',
        'InsuredValue',
        'InternationalForms',
        'Product',
        'COD',
        'InvoiceLineTotal',
        'CODAmount',
        'RateInformation',
        'CustomerClassification',
        'Translate',
        'UPSFiled',
        'Unit',
        'Locale',
        'ReferenceNumber',
        'UnitOfMeasurement',
        'LocationSearchCriteria',
        'ReturnService',
        'Dimensions',
        'Service',
        'Tradeability\FreightCharges',
        'Tradeability\Product',
        'Tradeability\QueryRequest',
        'Tradeability\TariffInfo',
        'Tradeability\UnitPrice',
        'Tradeability\Quantity',
        'Tradeability\Shipment',
        'Tradeability\UnitOfMeasurement',
        'Tradeability\Weight',
    ];

    /**
     * @dataProvider getListOfNodesUsingInterfaceWithoutRequiredConstruct
     */
    public function testSimpleNodesUsingInterface($nodePath)
    {
        $ns = '\\Ups\Entity\\' . $nodePath;

        /** @var NodeInterface $obj */
        $obj = new $ns;
        $this->assertInstanceOf($ns, $obj);
        $this->assertInstanceOf('Ups\NodeInterface', $obj);

        $domDocument = new \DOMDocument();
        $result = $obj->toNode($domDocument);
        $this->assertInstanceOf('DOMElement', $result);
    }

    public function getListOfNodesUsingInterfaceWithoutRequiredConstruct()
    {
        return array_map(function ($item) {
            return [$item];
        }, $this->nodeListNoConstructAndNodeInterface);
    }

    /**
     * @dataProvider getListOfNodesWithoutNodeInterface
     */
    public function testEntitiesWithoutNodeInterface($nodePath)
    {
        $ns = '\\Ups\Entity\\' . $nodePath;

        $obj = new $ns;
        $this->assertInstanceOf($ns, $obj);
        $this->assertNotInstanceOf('Ups\NodeInterface', $obj);
    }

    public function getListOfNodesWithoutNodeInterface()
    {
        return array_map(function ($item) {
            return [$item];
        }, $this->nodeListNoNodeInterface);
    }
}

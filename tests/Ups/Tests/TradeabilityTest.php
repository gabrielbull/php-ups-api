<?php

namespace Ups\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ups;

class TradeabilityTest extends TestCase
{
    public function testCreateRequest()
    {
        $api = new Ups\Tradeability();
        $api->setRequest($request = new RequestMock());

        // Build request
        $landedCostRequest = new \Ups\Entity\Tradeability\LandedCostRequest;

        // Build shipment
        $shipment = new \Ups\Entity\Tradeability\Shipment;
        $shipment->setOriginCountryCode('NL');
        $shipment->setDestinationCountryCode('US');
        $shipment->setDestinationStateProvinceCode('NY');
        $shipment->setResultCurrencyCode('EUR');
        $shipment->setTariffCodeAlert(1);
        $shipment->setTransportationMode(\Ups\Entity\Tradeability\Shipment::TRANSPORT_MODE_AIR);

        // Set transport costs
        $freightCharges = new \Ups\Entity\Tradeability\FreightCharges;
        $freightCharges->setCurrencyCode('EUR');
        $freightCharges->setMonetaryValue(100);
        $shipment->setFreightCharges($freightCharges);

        // Build product
        $product = new \Ups\Entity\Tradeability\Product;
        $product->setProductName('Test');
        $product->setProductCountryCodeOfOrigin('BD');
        $product->setTariffCodeAlert(1);

        // Add tariff codes
        $tariffInfo = new \Ups\Entity\Tradeability\TariffInfo;
        $tariffInfo->setTariffCode('1000.00.00.00');
        $product->setTariffInfo($tariffInfo);

        // Set price, Its always outside EU, so we always charge 0% VAT on these orders
        $unitPrice = new \Ups\Entity\Tradeability\UnitPrice;
        $unitPrice->setMonetaryValue(50);
        $unitPrice->setCurrencyCode('EUR');
        $product->setUnitPrice($unitPrice);

        // Set weight
        $weight = new Ups\Entity\Tradeability\Weight;
        $weight->setValue(0.5);
        $unitOfMeasurement = new \Ups\Entity\Tradeability\UnitOfMeasurement;
        $unitOfMeasurement->setCode('kg');
        $weight->setUnitOfMeasurement($unitOfMeasurement);
        $product->setWeight($weight);

        // Set quantity
        $quantity = new \Ups\Entity\Tradeability\Quantity;
        $quantity->setValue(2);
        $unitOfMeasurement = new \Ups\Entity\Tradeability\UnitOfMeasurement;
        $unitOfMeasurement->setCode(\Ups\Entity\Tradeability\UnitOfMeasurement::PROD_PIECES);
        $quantity->setUnitOfMeasurement($unitOfMeasurement);
        $product->setQuantity($quantity);

        // Add product to shipment
        $shipment->addProduct($product);

        // Query request
        $queryRequest = new \Ups\Entity\Tradeability\QueryRequest;
        $queryRequest->setShipment($shipment);
        $queryRequest->setSuppressQuestionIndicator(true);

        // Build
        $landedCostRequest->setQueryRequest($queryRequest);

        // Do call and return additional costs for import to getQuote function
        try {
            // Get data
            $result = $api->getLandedCosts($landedCostRequest);
        } catch (Exception $e) {
        }

        $this->assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/Tradeability/Request1.xml')
        );
    }
}

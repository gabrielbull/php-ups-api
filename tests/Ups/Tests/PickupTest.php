<?php

namespace Ups\Tests;

use PHPUnit\Framework\TestCase;
use Ups\Entity\Phone;
use Ups\Entity\Pickup\CardAddress;
use Ups\Entity\Pickup\ChargeCard;
use Ups\Entity\Pickup\PickupAddress;
use Ups\Entity\Pickup\PickupCreationRequest;
use Ups\Entity\Pickup\PickupDateInfo;
use Ups\Entity\Pickup\PickupPiece;
use Ups\Entity\Pickup\Shipper;
use Ups\Entity\TotalWeight;
use Ups\Exception\RequestException;
use Ups\Pickup;
use Ups\ValueObject\CardType;
use Ups\ValueObject\ContainerCode;
use Ups\ValueObject\PaymentMethod;
use Ups\ValueObject\Quantity;
use Ups\ValueObject\UnitOfMeasurement;

/**
 * Pickup Class Tests.
 *
 * @group Pickup
 */
class PickupTest extends TestCase
{
    /**
     * @var Pickup
     */
    private $pickup;

    public function setUp(): void
    {
        $this->pickup = new Pickup(null, null, null, true);
    }

    public function testPickupCreateRequest(): void
    {
        $this->pickup->setRequest($request = new RequestMock());

        $pickupInfo = new PickupDateInfo('1400', '0500', '20160405');
        $pickupAddress = new PickupAddress(
            'X company',
            'Y Manager',
            '35 Thompson Drive',
            null,
            null,
            'Timonium',
            'MD',
            null,
            'US',
            '21093',
            true,
            null,
            new Phone('6785851399', '911')
        );

        $pickupPieces = [
          new PickupPiece(
              '001',
              Quantity::fromString('1'),
              'US',
              ContainerCode::package()
          ),
        ];

        $totalWeight = new TotalWeight(
            '5.5',
            UnitOfMeasurement::pounds()
        );

        $shipper = new Shipper(
            null,
            new ChargeCard(
                'Test user',
                CardType::visa(),
                '4023602222222125',
                '201808',
                '737',
                new CardAddress(
                    '2311 York Rd',
                    'Rome',
                    null,
                    '21093',
                    'IT'
                )
            )
        );

        $data = new PickupCreationRequest(
            'Y',
            $pickupInfo,
            $pickupAddress,
            true,
            $pickupPieces,
            $totalWeight,
            false,
            null,
            null,
            PaymentMethod::payByChargeCard(),
            null,
            null,
            null,
            null,
            null,
            null,
            $shipper,
            true
        );

        try {
            $this->pickup->create($data);
        } catch (\Exception $e) {
        }

        self::assertEquals(
            $request->getRequestXml(),
            $request->getExpectedRequestXml('/Pickup/PickupCreateRequest.xml')
        );
    }
}

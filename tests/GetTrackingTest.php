<?php

declare(strict_types=1);

namespace Ups\Tests;

use PHPUnit\Framework\TestCase;
use Ups\Api\Tracking\Model\TrackingResponse;
use Ups\Tracking\TrackingFactory;

class GetTrackingTest extends TestCase
{
    public function testItCanRequestTracking(): void
    {
        $client = TrackingFactory::create(
            $_SERVER['ACCESS_KEY'],
            $_SERVER['USER_ID'],
            $_SERVER['PASSWORD'],
            true
        );

        $response = $client->getDetailByInquiryNumber('1Z5338FF0107231059');
        self::assertInstanceOf(TrackingResponse::class, $response);
    }
}

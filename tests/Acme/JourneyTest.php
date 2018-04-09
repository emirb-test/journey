<?php
declare(strict_types=1);

namespace Acme\Tests;

use Acme\Journey;
use Acme\Model\BoardingPass\AirportBusBoardingPass;
use Acme\Model\BoardingPass\FlightBoardingPass;
use Acme\Model\Location;
use Acme\Model\BoardingPass\TrainBoardingPass;
use PHPUnit\Framework\TestCase;

/**
 * @author Emir Beganovic <emir@php.net>
 */
class JourneyTest extends TestCase
{
    public function testGetFormattedOutput(): void
    {
        $boardingPasses = [
            new TrainBoardingPass(new Location('Madrid'), new Location('Barcelona'), '78A', '45B'),
            new AirportBusBoardingPass(new Location('Barcelona'), new Location('Gerona Airport')),
            new FlightBoardingPass(new Location('Gerona Airport'), new Location('Stockholm'), 'SK455', '45B', '3A', '344'),
            new FlightBoardingPass(new Location('Stockholm'), new Location('New York JFK'), 'SK22', '22', '7B'),
        ];

        $expected = <<<'TAG'
1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
Baggage drop at ticket counter 344.
4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
Baggage will we automatically transferred from your last leg.
5. You have arrived at your final destination.
TAG;

        $journey = new Journey(...$boardingPasses);
        $this->assertEquals($expected, $journey->getFormattedOutput());
        $this->assertEquals($expected, (string) $journey);
    }
}

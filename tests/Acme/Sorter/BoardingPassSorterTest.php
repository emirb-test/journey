<?php
declare(strict_types=1);

namespace Acme\Tests\Sorter;

use Acme\Model\BoardingPass\AirportBusBoardingPass;
use Acme\Model\BoardingPass\FlightBoardingPass;
use Acme\Model\Location;
use Acme\Model\BoardingPass\TrainBoardingPass;
use Acme\Sorter\BoardingPassSorter;
use PHPUnit\Framework\TestCase;

/**
 * @author Emir Beganovic <emir@php.net>
 */
class BoardingPassSorterTest extends TestCase
{
    /**
     * @return array
     */
    public function shuffledPassesProvider(): array
    {
        return [
            [
                [
                    new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                    new AirportBusBoardingPass(new Location('Madrid'), new Location('Madrid Airport'), '45B'),
                    new FlightBoardingPass(new Location('Madrid Airport'), new Location('Barcelona'), 'OS760', '45B', '3B'),
                ],
                [
                    new AirportBusBoardingPass(new Location('Madrid'), new Location('Madrid Airport'), '45B'),
                    new FlightBoardingPass(new Location('Madrid Airport'), new Location('Barcelona'), 'OS760', '45B', '3B'),
                    new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function alreadySortedProvider(): array
    {
        return [
            [
                [
                    new TrainBoardingPass(new Location('Madrid'), new Location('Barcelona'), '78A', '45B'),
                    new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                ],
                [
                    new TrainBoardingPass(new Location('Madrid'), new Location('Barcelona'), '78A', '45B'),
                    new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function singleBoardingPassProvider(): array
    {
        return [
            [
                [
                    new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                ],
            ],
        ];
    }

    /**
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] $boardingPasses
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] $expected
     * @dataProvider shuffledPassesProvider
     */
    public function testSortShuffled($boardingPasses, $expected): void
    {
        $sorter = new BoardingPassSorter(...$boardingPasses);

        $this->assertEquals($expected, $sorter->sort());
    }

    /**
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] $boardingPasses
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] $expected
     * @dataProvider alreadySortedProvider
     */
    public function testSortAlreadySorted($boardingPasses, $expected): void
    {
        $sorter = new BoardingPassSorter(...$boardingPasses);

        $this->assertEquals($expected, $sorter->sort());
    }

    /**
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] $boardingPasses
     * @dataProvider singleBoardingPassProvider
     */
    public function testSingleBoardingPassSort($boardingPasses): void
    {
        $sorter = new BoardingPassSorter(...$boardingPasses);

        $this->assertEquals($boardingPasses, $sorter->sort());
    }

    /**
     * @expectedException \Acme\Acme\Sorter\Exception\RuntimeException
     * @expectedExceptionMessage Multiple first departures defined, check your boarding passes.
     */
    public function testMultipleFirstDepartures(): void
    {
        $sorter = new BoardingPassSorter(
            ...
            [
                new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                new TrainBoardingPass(new Location('Milan'), new Location('Verona'), '78A', '45B'),
            ]
        );

        $sorter->sort();
    }

    /**
     * @expectedException \Acme\Acme\Sorter\Exception\RuntimeException
     * @expectedExceptionMessage Unable to find first departure.
     */
    public function testMissingFirstDeparture(): void
    {
        $sorter = new BoardingPassSorter(
            ...
            [
                new TrainBoardingPass(new Location('Barcelona'), new Location('Vienna'), '78A', '45B'),
                new TrainBoardingPass(new Location('Vienna'), new Location('Barcelona'), '78A', '45B'),
            ]
        );

        $sorter->sort();
    }
}

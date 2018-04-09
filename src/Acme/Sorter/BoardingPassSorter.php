<?php
declare(strict_types=1);

namespace Acme\Sorter;

use Acme\Acme\Sorter\Exception\RuntimeException;
use Acme\Model\BoardingPass\BoardingPassInterface;

/**
 * @package Acme\Sorter
 * @author Emir Beganovic <emir@php.net>
 */
class BoardingPassSorter implements SorterInterface
{
    /**
     * @var \Acme\Model\BoardingPass\BoardingPassInterface[]
     */
    protected $boardingPasses;

    /**
     * {@inheritDoc}
     */
    public function __construct(BoardingPassInterface ...$boardingPasses)
    {
        $this->boardingPasses = $boardingPasses;
    }

    /**
     * {@inheritDoc}
     */
    public function sort(): array
    {
        // Return result set early if there is only one boarding pass.
        if (\count($this->boardingPasses) === 1) {
            return $this->boardingPasses;
        }

        $departuresMap = $arrivalsMap = [];

        foreach ($this->boardingPasses as $boardingPass) {
            $departuresMap[$boardingPass->getDeparture()->__toString()] = $boardingPass;
            $arrivalsMap[$boardingPass->getArrival()->__toString()] = $boardingPass;
        }

        $firstDepartures = array_diff_key($departuresMap, $arrivalsMap);
        $firstDeparturesCount = \count($firstDepartures);

        if ($firstDeparturesCount > 1) {
            throw new RuntimeException('Multiple first departures defined, check your boarding passes.');
        }

        if ($firstDeparturesCount === 0) {
            throw new RuntimeException('Unable to find first departure.');
        }

        /** @var \Acme\Model\BoardingPass\BoardingPassInterface $firstDeparture */
        $firstDeparture = current($firstDepartures);

        $sortedMap = [$firstDeparture];

        $currentLocation = $firstDeparture->getArrival();

        while ($boardingPass = $departuresMap[$currentLocation->__toString()] ?? null) {
            $sortedMap[] = $boardingPass;
            $currentLocation = $boardingPass->getArrival();
        }

        return $sortedMap;
    }
}

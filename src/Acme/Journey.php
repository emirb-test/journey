<?php
declare(strict_types=1);

namespace Acme;

use Acme\Model\BoardingPass\BoardingPassInterface;
use Acme\Sorter\BoardingPassSorter;

/**
 * @package Acme
 * @author Emir Beganovic <emir@php.net>
 */
class Journey implements JourneyInterface
{
    /**
     * Already sorted boarding passes.
     *
     * @var \Acme\Model\BoardingPass\BoardingPassInterface[]
     */
    private $boardingPasses;

    /**
     * @var string
     */
    private $delimiter = PHP_EOL;

    /**
     * {@inheritDoc}
     */
    public function __construct(BoardingPassInterface ...$boardingPasses)
    {
        $this->boardingPasses = (new BoardingPassSorter(...$boardingPasses))->sort();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->getFormattedOutput();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormattedOutput(): string
    {
        $index = 1;
        $messages = array_map(
            function (BoardingPassInterface $boardingPass) use (&$index) {
                return $index++ . '. ' . (string)$boardingPass;
            },
            $this->boardingPasses
        );

        // Message is meaningful only if there are multiple passes
        if (\count($this->boardingPasses) > 1) {
            $messages[] = $index. '. You have arrived at your final destination.';
        }

        return implode($this->delimiter, $messages);
    }
}

<?php
declare(strict_types=1);

namespace Acme;

use Acme\Model\BoardingPass\BoardingPassInterface;

/**
 * @package Acme
 * @author Emir Beganovic <emir@php.net>
 */
interface JourneyInterface
{
    /**
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] ...$boardingPasses
     */
    public function __construct(BoardingPassInterface ...$boardingPasses);

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @return string
     */
    public function getFormattedOutput(): string;
}

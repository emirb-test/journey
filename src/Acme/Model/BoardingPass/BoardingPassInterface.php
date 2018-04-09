<?php
declare(strict_types=1);

namespace Acme\Model\BoardingPass;

use Acme\Model\LocationInterface;

/**
 * @package Acme\Model\BoardingPass
 * @author Emir Beganovic <emir@php.net>
 */
interface BoardingPassInterface
{
    /**
     * @return \Acme\Model\LocationInterface
     */
    public function getDeparture(): LocationInterface;

    /**
     * @return \Acme\Model\LocationInterface
     */
    public function getArrival(): LocationInterface;

    /**
     * Prints boarding pass information as formatted output string.
     * @return string
     */
    public function __toString(): string;
}

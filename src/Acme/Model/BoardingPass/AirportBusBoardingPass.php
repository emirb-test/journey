<?php
declare(strict_types=1);

namespace Acme\Model\BoardingPass;

/**
 * @package Acme\Model\BoardingPass
 * @author Emir Beganovic <emir@php.net>
 */
class AirportBusBoardingPass extends AbstractBoardingPass implements BoardingPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf(
            'Take the airport bus from %s to %s. No seat assignment.',
            $this->departure,
            $this->arrival
        );
    }
}

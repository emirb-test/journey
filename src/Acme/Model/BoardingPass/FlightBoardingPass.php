<?php
declare(strict_types=1);

namespace Acme\Model\BoardingPass;

use Acme\Model\LocationInterface;

/**
 * @package Acme\Model\BoardingPass
 * @author Emir Beganovic <emir@php.net>
 */
class FlightBoardingPass extends AbstractBoardingPass implements BoardingPassInterface
{
    /**
     * @param \Acme\Model\LocationInterface $departure
     * @param \Acme\Model\LocationInterface $arrival
     * @param string $identifier
     * @param string $gate
     * @param null|string $seat
     * @param string $baggageDrop
     */
    public function __construct(
        LocationInterface $departure,
        LocationInterface $arrival,
        string $identifier,
        string $gate,
        string $seat,
        ?string $baggageDrop = null
    ) {
        parent::__construct($departure, $arrival);
        $this->identifier = $identifier;
        $this->gate = $gate;
        $this->seat = $seat;
        $this->baggageDrop = $baggageDrop;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf(
                'From %s, take flight %s to %s. Gate %s, seat %s.',
                $this->departure,
                $this->identifier,
                $this->arrival,
                $this->gate,
                $this->seat
            ) . ($this->baggageDrop ? sprintf(
                PHP_EOL . 'Baggage drop at ticket counter %s.',
                $this->baggageDrop
            ) : PHP_EOL . 'Baggage will we automatically transferred from your last leg.');
    }
}

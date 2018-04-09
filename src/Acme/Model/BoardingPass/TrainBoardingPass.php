<?php
declare(strict_types=1);

namespace Acme\Model\BoardingPass;

use Acme\Model\LocationInterface;

/**
 * @package Acme\Model\BoardingPass
 * @author Emir Beganovic <emir@php.net>
 */
class TrainBoardingPass extends AbstractBoardingPass implements BoardingPassInterface
{
    /**
     * @param \Acme\Model\LocationInterface $departure
     * @param \Acme\Model\LocationInterface $arrival
     * @param string $identifier
     * @param null|string $seat
     */
    public function __construct(LocationInterface $departure, LocationInterface $arrival, string $identifier, ?string $seat = null)
    {
        parent::__construct($departure, $arrival);
        $this->seat = $seat;
        $this->identifier = $identifier;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return sprintf(
            'Take train %s from %s to %s.',
            $this->identifier,
            $this->departure,
            $this->arrival
        ) . ($this->seat ? sprintf(' Sit in seat %s.', $this->seat) : '');
    }
}

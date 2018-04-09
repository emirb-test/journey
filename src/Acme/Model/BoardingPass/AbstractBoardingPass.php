<?php
declare(strict_types=1);

namespace Acme\Model\BoardingPass;

use Acme\Model\LocationInterface;

/**
 * @package Acme\Model\BoardingPass
 * @author Emir Beganovic <emir@php.net>
 */
abstract class AbstractBoardingPass implements BoardingPassInterface
{
    /**
     * @var \Acme\Model\LocationInterface
     */
    protected $departure;

    /**
     * @var \Acme\Model\LocationInterface
     */
    protected $arrival;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var null|string
     */
    protected $gate;

    /**
     * @var null|string
     */
    protected $seat;

    /**
     * @var null|string
     */
    protected $baggageDrop;

    /**
     * {@inheritDoc}
     */
    public function __construct(LocationInterface $departure, LocationInterface $arrival)
    {
        $this->departure = $departure;
        $this->arrival = $arrival;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeparture(): LocationInterface
    {
        return $this->departure;
    }

    /**
     * {@inheritdoc}
     */
    public function getArrival(): LocationInterface
    {
        return $this->arrival;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function __toString(): string;
}

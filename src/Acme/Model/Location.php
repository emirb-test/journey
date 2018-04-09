<?php
declare(strict_types=1);

namespace Acme\Model;

/**
 * @package Acme\Model
 * @author Emir Beganovic <emir@php.net>
 */
class Location implements \Acme\Model\LocationInterface
{
    /**
     * @var string
     */
    protected $location;

    /**
     * {@inheritDoc}
     */
    public function __construct(string $location)
    {
        $this->location = $location;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->location;
    }
}

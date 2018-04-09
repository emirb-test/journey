<?php
declare(strict_types=1);

namespace Acme\Model;

/**
 * @package Acme\Model
 * @author Emir Beganovic <emir@php.net>
 */
interface LocationInterface
{
    /**
     * @param string $location
     *
     */
    public function __construct(string $location);

    /**
     * @return string
     */
    public function __toString(): string;
}

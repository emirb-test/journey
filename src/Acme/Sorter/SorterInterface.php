<?php
declare(strict_types=1);

namespace Acme\Sorter;

use Acme\Model\BoardingPass\BoardingPassInterface;

/**
 * @package Acme\Sorter
 * @author Emir Beganovic <emir@php.net>
 */
interface SorterInterface
{
    /**
     * @param \Acme\Model\BoardingPass\BoardingPassInterface[] ...$boardingPasses
     */
    public function __construct(BoardingPassInterface ...$boardingPasses);

    /**
     * @return \Acme\Model\BoardingPass\BoardingPassInterface[]
     * @throws \Acme\Acme\Sorter\Exception\RuntimeException
     */
    public function sort(): array;
}

<?php

namespace PerpetualSpace\BinPacking;

/**
 * Class Item
 * @package PerpetualSpace\BinPacking
 *
 * Represents an item to be packed.
 */
class Item
{
    /**
     * @var int
     */
    protected $weight;

    /**
     * Item constructor.
     *
     * @param int $weight
     */
    public function __construct(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * Get the weight.
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}
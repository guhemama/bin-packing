<?php

namespace PerpetualSpace\BinPacking;

/**
 * Class Bin
 * @package PerpetualSpace\BinPacking
 *
 * Represents a bin.
 */
class Bin
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var int
     */
    protected $maximumBinWeight;

    /**
     * Bin constructor.
     *
     * @param int $maximumBinWeight
     */
    public function __construct(int $maximumBinWeight)
    {
        $this->maximumBinWeight = $maximumBinWeight;
    }

    /**
     * Get the packed items.
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Adds an item to the bin.
     *
     * @param Item $item
     * @return Bin
     */
    public function addItem(Item $item): Bin
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Get the total bin weight.
     *
     * @return int
     */
    public function getTotalWeight() : int
    {
        return array_reduce($this->items, function($acc, $item) {
            return $acc + $item->getWeight();
        }, 0);
    }

    /**
     * Checks if an item fits the bin.
     *
     * @param Item $item
     * @return bool
     */
    public function itemFits(Item $item): bool
    {
        return $item->getWeight() + $this->getTotalWeight() <= $this->maximumBinWeight;
    }
}
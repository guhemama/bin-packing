<?php

namespace PerpetualSpace\BinPacking;

/**
 * Class BinPacking
 * @package PerpetualSpace\BinPacking
 *
 * Implementation of the next-fit decreasing algorithm.
 */
class BinPacking
{
    /**
     * @var int
     */
    protected $maximumBinWeight;

    /**
     * BinPacking constructor.
     *
     * @param int $maximumBinWeight
     */
    public function __construct(int $maximumBinWeight)
    {
        $this->maximumBinWeight = $maximumBinWeight;
    }

    /**
     * Packs a list of item into bins.
     *
     * @param array $items
     * @return array
     */
    public function pack(array $items): array
    {
        // Sort in descending order by weight
        usort($items, function($item1, $item2) {
            return $item2->getWeight() - $item1->getWeight();
        });

        // We will use, at most, the same number of items in bins.
        // We will filter out the empty bins at the end
        $bins = [];

        for ($i = 0; $i < count($items); $i++) {
            $bins[$i] = new Bin($this->maximumBinWeight);
        }

        foreach ($items as $item) {
            foreach ($bins as $bin) {
                if ($bin->itemFits($item)) {

                    $bin->addItem($item);
                    break;
                }
            }
        }

        // Remove empty bins
        return array_filter($bins, function($bin) {
            return $bin->getTotalWeight() > 0;
        });
    }
}
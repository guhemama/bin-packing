<?php

use PerpetualSpace\BinPacking\{
    BinPacking, Item
};
use PHPUnit\Framework\TestCase;

class BinPackingTest extends TestCase
{
    /**
     * Tests the pack method with the zero-one-infinity rule.
     */
    public function testPack()
    {
        $binPacking = new BinPacking(100);

        // Zero items
        $this->assertEquals([], $binPacking->pack([]));

        // One item
        $this->assertEquals(1, count($binPacking->pack([new Item(5)])));

        // Many items
        $packedItems = $binPacking->pack([new Item(5), new Item(20), new Item(49)]);
        $this->assertEquals(1, count($packedItems));
    }
}

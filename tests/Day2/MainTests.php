<?php

namespace Liquorvicar\AdventOfCode\tests\Day2;

use Liquorvicar\AdventOfCode\Day2\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @dataProvider dataForRowDiffs
     */
    public function testCalculatesRowDiff($row, $expected) {
        $checksum = new Main();
        $this->assertEquals($expected, $checksum->rowDiff($row));
    }

    public function dataForRowDiffs() {
        return [
            [ [ 5, 1, 9, 5 ], 8],
            [ [ 7, 5, 3 ], 4],
            [ [ 2, 4, 6, 8 ], 6],
        ];
    }

    /**
     * @dataProvider dataForEvenDivides
     */
    public function testCalculatesEvenDivides($row, $expected) {
        $checksum = new Main();
        $this->assertEquals($expected, $checksum->evenDivides($row));
    }

    public function dataForEvenDivides() {
        return [
            [ [5, 9, 2, 8], 4],
            [ [9, 4, 7, 3], 3],
            [ [3, 8, 6, 5], 2],
        ];
        /** 5 9 2 8
        9 4 7 3
        3 8 6 5 */
    }
}

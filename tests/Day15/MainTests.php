<?php

namespace Liquorvicar\AdventOfCode\tests\Day15;

use Liquorvicar\AdventOfCode\Day15\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $multiplier
     * @param $startValue
     * @param $expected
     * @dataProvider dataForGeneratorA
     */
    public function testGeneratorA($multiplier, $startValue, $expected) {
        $generators = new Main();
        $this->assertEquals($expected, $generators->generatorA($startValue, $multiplier));
    }

    public function dataForGeneratorA() {
        return [
            [false, 65, 1092455],
            [false, 1092455, 1181022009],
            [false, 1181022009, 245556042],
            [false, 245556042, 1744312007],
            [false, 1744312007, 1352636452],
            [true, 65, 1352636452],
            [true, 1352636452, 1992081072],
            [true, 1992081072, 530830436],
            [true, 530830436, 1980017072],
            [true, 1980017072, 740335192],
        ];
    }

    /**
     * @param $multiplier
     * @param $startValue
     * @param $expected
     * @dataProvider dataForGeneratorB
     */
    public function testGeneratorB($multiplier, $startValue, $expected) {
        $generators = new Main();
        $this->assertEquals($expected, $generators->generatorB($startValue, $multiplier));
    }

    public function dataForGeneratorB() {
        return [
            [false, 8921, 430625591],
            [false, 430625591, 1233683848],
            [false, 1233683848, 1431495498],
            [false, 1431495498, 137874439],
            [false, 137874439, 285222916],
            [true, 8921, 1233683848],
            [true, 1233683848, 862516352],
            [true, 862516352, 1159784568],
            [true, 1159784568, 1616057672],
            [true, 1616057672, 412269392],
        ];
    }

    /**
     * @param $aValue
     * @param $bValue
     * @param $match
     * @dataProvider dataForBinaryMatch
     */
    public function testBinaryMatch($aValue, $bValue, $match) {
        $generators = new Main();
        $this->assertEquals($match, $generators->compare($aValue, $bValue));
    }

    public function dataForBinaryMatch() {
        return [
            [1092455, 430625591, false],
            [1181022009, 1233683848, false],
            [245556042, 1431495498, true],
            [1744312007, 137874439, false],
            [1352636452, 285222916, false],
            [1947333267, 1487958675, false],
        ];
    }

    public function testCountMatches() {
        $generators = new Main();
        $this->assertEquals(1, $generators->countMatches(5, 65, 8921, false));
        $this->assertEquals(1, $generators->countMatches(1056, 65, 8921, true));
    }
}

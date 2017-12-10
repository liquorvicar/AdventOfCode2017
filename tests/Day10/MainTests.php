<?php

namespace Liquorvicar\AdventOfCode\tests\Day10;

use Liquorvicar\AdventOfCode\Day10\Main;
use Liquorvicar\AdventOfCode\Day10\StringCircle;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $startCircle
     * @param $length
     * @param $knottedList
     * @dataProvider dataForTieKnot
     */
    function testTieKnot(StringCircle $startCircle, $length, StringCircle $knottedList) {
        $this->assertEquals($knottedList, $startCircle->tieKnot($length));
    }

    function dataForTieKnot() {
        return [
            [
                new StringCircle([0, 1, 2, 3, 4], 0, 0),
                3,
                new StringCircle([2, 1, 0, 3, 4], 3, 1),
            ],
            [
                new StringCircle([2, 1, 0, 3, 4], 3, 1),
                4,
                new StringCircle([4, 3, 0, 1, 2], 3, 2),
            ],
            [
                new StringCircle([4, 3, 0, 1, 2], 3, 2),
                1,
                new StringCircle([4, 3, 0, 1, 2], 1, 3),
            ],
            [
                new StringCircle([4, 3, 0, 1, 2], 1, 3),
                5,
                new StringCircle([3, 4, 2, 1, 0], 4, 4),
            ],
        ];
    }

    public function testPartOne() {
        $string = new Main(5);
        $this->assertEquals(12, $string->runPartOne(['3, 4, 1, 5']));
    }

    public function testDenseElement() {
        $string = new StringCircle([], 0, 0);
        $input = [65, 27, 9, 1, 4, 3, 40, 50, 91, 7, 6, 0, 2, 5, 68, 22];
        $this->assertEquals(64, $string->denseElement($input));
    }

    public function testPartTwo() {
        $string = new Main();
        $this->assertEquals('a2582a3a0e66e6e86e3812dcb672a272', $string->runPartTwo(['']));
    }

    public function testCalcHash() {
        $string = new StringCircle([], 0, 0);
        $this->assertEquals('4007ff', $string->calcHash([64, 7, 255]));
    }
}

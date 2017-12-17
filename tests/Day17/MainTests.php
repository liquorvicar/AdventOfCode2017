<?php

namespace Liquorvicar\AdventOfCode\tests\Day17;

use Liquorvicar\AdventOfCode\Day17\Buffer;
use Liquorvicar\AdventOfCode\Day17\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $startBuffer
     * @param $newBuffer
     * @dataProvider dataForSpinBuffer
     */
    public function testSpinBuffer($startBuffer, $newBuffer ) {
        $this->assertEquals($newBuffer, $startBuffer->spin(3));
    }

    public function dataForSpinBuffer() {
        return [
            [new Buffer([0], 0, 1), new Buffer([0, 1], 1, 2)],
            [new Buffer([0, 1], 1, 2), new Buffer([0, 2, 1], 1, 3)],
            [new Buffer([0, 2, 1], 1, 3), new Buffer([0, 2, 3, 1], 2, 4)],
        ];
    }

    public function testValueAfterLastInsert() {
        $buffer = new Main();
        $this->assertEquals(638, $buffer->runPartOne(['3']));
    }

    /**
     * @param $iterations
     * @param $expected
     * @dataProvider dataForSecondValue
     */
    public function testGetSecondValue($iterations, $expected) {
        $buffer = new Main();
        $this->assertEquals($expected, $buffer->getSecondValue(3, $iterations));
    }

    public function dataForSecondValue() {
        return [
            [1, 1],
            [2, 2],
            [3, 2],
            [5, 5],
            [9, 9],
        ];
    }
}

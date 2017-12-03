<?php

namespace Liquorvicar\AdventOfCode\tests\Day3;

use Liquorvicar\AdventOfCode\Day3\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @dataProvider dataForPartOne
     * @param $input
     * @param $expected
     */
    public function testPartOne($input, $expected) {
        $day3 = new Main();
        $this->assertEquals($expected, $day3->runPartOne([$input]));
    }

    public function dataForPartOne() {
        return [
            [ 1, 0 ],
            [ 12, 3 ],
            [ 23, 2 ],
            [ 1024, 31 ]
        ];
    }

    /**
     * @dataProvider dataForPartTwo
     * @param $input
     * @param $expected
     */
    public function testPartTwo($input, $expected)
    {
        $day3 = new Main();
        $this->assertEquals($expected, $day3->runPartTwo([$input]));
    }

    public function dataForPartTwo() {
        return [
            [ 0, 1 ],
            [ 1, 2 ],
            [ 8, 10 ],
            [ 27, 54 ],
            [ 65, 122 ],
            [ 329, 330 ],
            [ 748, 806 ],
        ];
    }
}
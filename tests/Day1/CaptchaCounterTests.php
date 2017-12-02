<?php

namespace Liquorvicar\AdventOfCode\tests;

use Liquorvicar\AdventOfCode\Day1\Main;
use PHPUnit\Framework\TestCase;

class CaptchaCounterTests extends TestCase {

    public function testSampleInputsPartOne() {
        $counter = new Main();
        $sum = $counter->runPartOne(['1122']);
        $this->assertEquals(3, $sum);
    }

    /**
     * @dataProvider dataForPartTwo
     * @param $inputData
     * @param $expectedResult
     */
    public function testPartTwo($inputData, $expectedResult) {
        $counter = new Main();
        $sum = $counter->runPartTwo($inputData);
        $this->assertEquals($expectedResult, $sum);

    }

    public function dataForPartTwo() {
        return [
            [ ['1212'], 6 ],
            [ ['1221'], 0 ],
            [ ['123425'], 4 ],
            [ ['123123'], 12 ],
            [ ['12131415'], 4 ],
        ];
    }
}
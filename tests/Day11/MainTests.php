<?php

namespace Liquorvicar\AdventOfCode\tests\Day11;

use Liquorvicar\AdventOfCode\Day11\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $steps
     * @param $distance
     * @dataProvider dataForPartOne
     */
    public function testPartOne($steps, $distance) {
        $main = new Main();
        $this->assertEquals($distance, $main->runPartOne($steps));
    }

    public function dataForPartOne() {
        return [
            [['ne,ne,ne'], 3],
            [['ne,ne,sw,sw'], 0],
            [['ne,ne,s,s'], 2],
            [['se,sw,se,sw,sw'], 3],
        ];
    }
}
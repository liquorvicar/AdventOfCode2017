<?php

namespace Liquorvicar\AdventOfCode\tests\Day6;

use Liquorvicar\AdventOfCode\Day6\Main;
use Liquorvicar\AdventOfCode\Day6\State;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $startingState
     * @param $endState
     * @dataProvider dataForRedistributionTests
     */
    public function testRedistribution($startingState, $endState) {
        $this->assertEquals($endState, $startingState->reallocate());
    }

    public function dataForRedistributionTests() {
        return [
            [new State([0, 2, 7, 0]), new State([2, 4, 1, 2])],
            [new State([2, 4, 1, 2]), new State([3, 1, 2, 3])],
            [new State([3, 1, 2, 3]), new State([0, 2, 3, 4])],
        ];
    }

    public function testReallocationsBeforeLoop() {
        $main = new Main();
        $result = $main->runPartOne(['0  2  7  0']);
        $this->assertEquals(5, $result);
    }

    public function testSizeOfLoop() {
        $main = new Main();
        $result = $main->runPartTwo(['0  2  7  0']);
        $this->assertEquals(4, $result);
    }
}

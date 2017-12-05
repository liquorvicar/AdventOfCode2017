<?php

namespace Liquorvicar\AdventOfCode\tests\Day5;

use Liquorvicar\AdventOfCode\Day5\Main;
use Liquorvicar\AdventOfCode\Day5\State;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $startingState
     * @param $expectedState
     * @dataProvider dataForSingleSteps
     */
    public function testSingleStep($startingState, $expectedState, $hasFinished) {
        $cpu = new Main();
        $actualState = $cpu->execute($startingState, function ($current) {
            return ++$current;
        });
        $this->assertEquals($expectedState, $actualState);
        $this->assertEquals($hasFinished, $actualState->hasTerminated());
    }

    public function dataForSingleSteps() {
        return [
            'step with no offset' => [new State([0], 0), new State([1], 0), false],
            'step with positive offset that terminates program' => [new State([1], 0), new State([2], 1), true],
            'program with multiple steps' => [new State([2, 3, 0,  1,  -3], 1), new State([2, 4, 0,  1,  -3], 4), false],
            'negative offset' => [new State([2, 4, 0,  1,  -3], 4), new State([2, 4, 0,  1,  -2], 1), false],
        ];
    }

    public function testCountNumberOfStepsPartOne() {
        $cpu = new Main();
        $steps = $cpu->runPartOne(['0', '3', '0',  '1',  '-3']);
        $this->assertEquals(5, $steps);
    }

    public function testCountNumberOfStepsPartTwo() {
        $cpu = new Main();
        $steps = $cpu->runPartTwo(['0', '3', '0',  '1',  '-3']);
        $this->assertEquals(10, $steps);
    }
}

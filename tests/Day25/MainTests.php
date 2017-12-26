<?php

namespace Liquorvicar\AdventOfCode\tests\Day25;

use Liquorvicar\AdventOfCode\Day25\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $numSteps
     * @param $expectedTape
     * @dataProvider dataForTape
     */
    public function testTapeAfterXSteps($numSteps, $expectedTape) {
        $tape = [0];
        $states = [
            'A' => [
                [
                    'value' => 1,
                    'move' => 1,
                    'state' => 'B',
                ],
                [
                    'value' => 0,
                    'move' => -1,
                    'state' => 'B',
                ],
            ],
            'B' => [
                [
                    'value' => 1,
                    'move' => -1,
                    'state' => 'A',
                ],
                [
                    'value' => 1,
                    'move' => 1,
                    'state' => 'A',
                ],
            ]
        ];
        $turing = new Main();
        $newTape = $turing->run($tape, $numSteps, $states);
        $this->assertEquals($expectedTape, $newTape);
    }

    public function dataForTape() {
        return [
            [0, [0]],
            [1, [1, 0]],
            [6, [-2 => 1, -1 => 1, 0 => 0, 1 => 1]],
        ];
    }
}

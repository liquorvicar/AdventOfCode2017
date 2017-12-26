<?php

namespace Liquorvicar\AdventOfCode\Day25;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    public function runPartOne(array $input)
    {
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
                    'state' => 'C',
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
                    'state' => 'D',
                ],
            ],
            'C' => [
                [
                    'value' => 0,
                    'move' => -1,
                    'state' => 'B',
                ],
                [
                    'value' => 0,
                    'move' => -1,
                    'state' => 'E',
                ],
            ],
            'D' => [
                [
                    'value' => 1,
                    'move' => 1,
                    'state' => 'A',
                ],
                [
                    'value' => 0,
                    'move' => 1,
                    'state' => 'B',
                ],
            ],
            'E' => [
                [
                    'value' => 1,
                    'move' => -1,
                    'state' => 'F',
                ],
                [
                    'value' => 1,
                    'move' => -1,
                    'state' => 'C',
                ],
            ],
            'F' => [
                [
                    'value' => 1,
                    'move' => 1,
                    'state' => 'D',
                ],
                [
                    'value' => 1,
                    'move' => 1,
                    'state' => 'A',
                ],
            ],
        ];
        $tape = [0];
        $tape = $this->run($tape, 12667664, $states);
        return array_sum($tape);
    }

    public function runPartTwo(array $input)
    {
        // TODO: Implement runPartTwo() method.
    }

    public function run($tape, $numSteps, $states)
    {
        $position = 0;
        $state = 'A';
        for ($i = 0; $i < $numSteps; $i++) {
            $thisState = $states[$state];
            $actions = $thisState[$tape[$position]];
            $tape[$position] = $actions['value'];
            $position += $actions['move'];
            if (!isset($tape[$position])) {
                $tape[$position] = 0;
            }
            $state = $actions['state'];
        }
        ksort($tape);
        return $tape;
    }
}


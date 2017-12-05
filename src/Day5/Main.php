<?php

namespace Liquorvicar\AdventOfCode\Day5;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        return $this->run($input, function ($current) {
            return ++$current;
        });
    }

    public function runPartTwo(array $input)
    {
        return $this->run($input, function ($current) {
            return $current >= 3 ? $current - 1 : $current + 1;
        });
    }

    public function execute(State $state, callable $offsetCalculator)
    {
        $program = $state->program();
        $currentPosition = $state->currentPosition();
        $offset = $program[$currentPosition];
        $program[$currentPosition] = $offsetCalculator($program[$currentPosition]);
        $newPosition = $currentPosition + $offset;
        return new State($program, $newPosition);
    }

    /**
     * @param array $input
     * @return int
     */
    private function run(array $input, callable $offsetCalculator): int
    {
        $program = array_map(function ($value) {
            return (int)$value;
        }, $input);
        $state = new State($program, 0);
        $steps = 0;
        while (!$state->hasTerminated()) {
            $steps++;
            $state = $this->execute($state, $offsetCalculator);
        }
        return $steps;
    }
}

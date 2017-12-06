<?php

namespace Liquorvicar\AdventOfCode\Day6;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $states = $this->calculateStatesUntilRepeatedState($input);
        return count($states) - 1;
    }

    public function runPartTwo(array $input)
    {
        $states = $this->calculateStatesUntilRepeatedState($input);
        $repeatedState = array_pop($states);
        $firstOccurrence = array_search($repeatedState, $states);
        return count($states) - $firstOccurrence;
    }

    /**
     * @param array $input
     * @return array
     */
    protected function calculateStatesUntilRepeatedState(array $input): array
    {
        $startingBanksString = trim($input[0]);
        $banks = explode(' ', $startingBanksString);
        $banks = array_filter($banks, function ($value) {
            return !empty($value) || $value === '0';
        });
        $banks = array_map(function ($value) {
            return (int)$value;
        }, $banks);
        $states = [];
        $state = new State(array_values($banks));
        while (!in_array((string)$state, $states)) {
            $states[] = (string)$state;
            $newState = $state->reallocate();
            $state = $newState;
        }
        $states[] = (string)$state;
        return $states;
    }

}
<?php

namespace Liquorvicar\AdventOfCode\Day15;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        return $this->countMatches(40000000, 289, 629, false);
    }

    public function runPartTwo(array $input)
    {
        return $this->countMatches(5000000, 289, 629, true
        );
    }

    public function generatorA($startValue, $multiplier)
    {
        return $this->generate($startValue, 16807, $multiplier ? 4 : 1);
    }

    public function generatorB($startValue, $multiplier)
    {
        return $this->generate($startValue, 48271, $multiplier ? 8 : 1);
    }

    /**
     * @param $startValue
     * @param $factor
     * @return int
     */
    protected function generate($startValue, $factor, $multiplier): int
    {
        $newValue = $startValue;
        do {
            $newValue = $newValue * $factor;
            $newValue = $newValue % 2147483647;
        } while (($newValue % $multiplier) !== 0);
        return $newValue;
    }

    public function compare($aValue, $bValue)
    {
        $lowestBits = 2 ** 16;
        $aValue = $aValue % $lowestBits;
        $bValue = $bValue % $lowestBits;
        return $aValue === $bValue;
    }

    public function countMatches($iterations, $aValue, $bValue, $multiplier)
    {
        $matches = 0;
        for ($i = 1; $i <= $iterations; $i++) {
            $aValue = $this->generatorA($aValue, $multiplier);
            $bValue = $this->generatorB($bValue, $multiplier);
            if ($this->compare($aValue, $bValue)) {
                $matches++;
            }
        }
        return $matches;
    }

    private function convertToBinaryString($value)
    {
        $start = 1073741824;
        $string = '';
        while ($start >= 1) {
            if ($value > $start) {
                $value -= $start;
                $string = $string . '1';
            } else {
                $string = $string . '0';
            }
            $start = $start / 2;
        }
        return $string;
    }
}
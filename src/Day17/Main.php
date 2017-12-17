<?php

namespace Liquorvicar\AdventOfCode\Day17;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $stepLength = (int)$input[0];
        $buffer = new Buffer([0], 0, 1);
        for ($i = 1; $i <= 2017; $i++) {
            $buffer = $buffer->spin($stepLength);
        }
        return $buffer->getNextValue();
    }

    public function runPartTwo(array $input)
    {
        $stepLength = (int)$input[0];
        return $this->getSecondValue($stepLength, 50000000);
    }

    /**
     * @param $stepLength
     * @param $iterations
     * @return int
     */
    public function getSecondValue($stepLength, $iterations): int
    {
        $number = 0;
        $pos = 1;
        for ($i = 1; $i <= $iterations; $i++) {
            $pos = (($pos + $stepLength) % $i) + 1;
            if ($pos === 1) {
                $number = $i;
            }
        }
        return $number;
    }

}
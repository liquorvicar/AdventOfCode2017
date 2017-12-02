<?php

namespace Liquorvicar\AdventOfCode\Day1;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    /**
     * @param $input
     * @return int
     */
    public function runPartOne(array $input)
    {
        return $this->calcSum($input[0], 1);
    }

    public function runPartTwo(array $input)
    {
        $string = $input[0];
        $inputLength = strlen($string);
        $offset = $inputLength / 2;
        return $this->calcSum($string, $offset);
    }

    /**
     * @param $string
     * @param $offset
     * @return int
     */
    protected function calcSum($string, $offset): int
    {
        $chars = str_split($string);
        $sum = 0;
        $inputLength = count($chars);
        foreach ($chars as $key => $value) {
            $nextKey = $key + $offset;
            if ($nextKey >= $inputLength) {
                $nextKey -= $inputLength;
            }
            if ($chars[$key] === $chars[$nextKey]) {
                $sum += (int)$chars[$key];
            }
        }
        return $sum;
    }
}
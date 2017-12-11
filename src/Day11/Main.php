<?php

namespace Liquorvicar\AdventOfCode\Day11;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $instructions = $input[0];
        $steps = explode(',', $instructions);
        $x = 0;
        $y = 0;
        foreach ($steps as $step) {
            switch ($step) {
                case 'ne':
                    $x += 0.5;
                    $y += 0.5;
                    break;
                case 'nw':
                    $x -= 0.5;
                    $y += 0.5;
                    break;
                case 'sw':
                    $x -= 0.5;
                    $y -= 0.5;
                    break;
                case 'se':
                    $x += 0.5;
                    $y -= 0.5;
                    break;
                case 's':
                    $y -= 1;
                    break;
                case 'n':
                    $y += 1;
                    break;
            }
        }
        return abs($x) + abs($y);
    }

    public function runPartTwo(array $input)
    {
        $instructions = $input[0];
        $steps = explode(',', $instructions);
        $x = 0;
        $y = 0;
        $max = 0;
        foreach ($steps as $step) {
            switch ($step) {
                case 'ne':
                    $x += 0.5;
                    $y += 0.5;
                    break;
                case 'nw':
                    $x -= 0.5;
                    $y += 0.5;
                    break;
                case 'sw':
                    $x -= 0.5;
                    $y -= 0.5;
                    break;
                case 'se':
                    $x += 0.5;
                    $y -= 0.5;
                    break;
                case 's':
                    $y -= 1;
                    break;
                case 'n':
                    $y += 1;
                    break;
            }
            if ((abs($x) + abs($y)) > $max) {
                $max = abs($x) + abs($y);
            }
        }
        return $max;
    }

}

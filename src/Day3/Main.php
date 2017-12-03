<?php

namespace Liquorvicar\AdventOfCode\Day3;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain {

    public function runPartOne(array $input)
    {
        $cell = (int)$input[0];
        $width = 1;
        $current = 1;
        while (($current * $current) < $cell) {
            $width = $current;
            $current += 2;
        }
        $ringRemainder = $cell - ($width * $width);
        $sideRemainder = $ringRemainder;
        while ($ringRemainder > 0) {
            $sideRemainder = $ringRemainder;
            $ringRemainder -= ($width + 1) ;
        }
        return $sideRemainder;
    }

    public function runPartTwo(array $input)
    {
        $target = (int)$input[0];
        $grid = [];
        $x = 0;
        $y = 0;
        $value = 0;
        $width = 0;
        $direction = 'right';
        while ($value <= $target) {
            $value = $this->calcValue($x, $y, $grid);
            $grid[$x][$y] = $value;
            switch ($direction) {
                case 'up':
                    $y++;
                    break;
                case 'down':
                    $y--;
                    break;
                case 'left':
                    $x--;
                    break;
                case 'right':
                    $x++;
                    break;
            }
            if ($x > $width) {
                $width++;
                $direction = 'up';
            } elseif ($y === $width && $x === $width) {
                $direction = 'left';
            } elseif ($y === $width && $x === ($width * -1)) {
                $direction = 'down';
            } elseif ($x === ($width * -1) && $y === ($width * -1)) {
                $direction = 'right';
            }
        }
        return $value;
    }

    private function calcValue($x, $y, $grid)
    {
        $value = 0;
        $value += $this->getValue($x + 1, $y, $grid);
        $value += $this->getValue($x + 1, $y + 1, $grid);
        $value += $this->getValue($x, $y + 1, $grid);
        $value += $this->getValue($x - 1, $y + 1, $grid);
        $value += $this->getValue($x - 1, $y, $grid);
        $value += $this->getValue($x - 1, $y - 1, $grid);
        $value += $this->getValue($x, $y - 1, $grid);
        $value += $this->getValue($x + 1, $y - 1, $grid);
        return $value > 0 ? $value : 1;
    }

    private function getValue($x, $y, $grid)
    {
        if (isset($grid[$x]) && isset($grid[$x][$y])) {
            return $grid[$x][$y];
        }
        return 0;
    }

}
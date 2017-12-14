<?php

namespace Liquorvicar\AdventOfCode\Day14;

use Liquorvicar\AdventOfCode\Day10\StringCircle;
use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $key = $input[0];
        $usedSquares = 0;
        for ($i = 0; $i < 128; $i++) {
            $hash = $this->generateHash($key . '-' . $i);
            $usedSquares += array_reduce($hash, function ($sum, $element) {
                return $sum + $element;
            }, 0);
        }
        return $usedSquares;
    }

    public function runPartTwo(array $input)
    {
        $key = $input[0];
        $grid = [];
        for ($i = 0; $i < 128; $i++) {
            $grid[] = $this->generateHash($key . '-' . $i);
        }
        return $this->countRegions($grid, 0);
    }

    public function countRegions($grid, $count) {
        $count = 0;
        $x = 0;
        while ($x !== false) {
            list($x, $y) = $this->findFirstUsedSquare($grid);
            if ($x === false || $y === false) {
                return $count;
            }
            $count++;
            $grid[$y][$x] = 0;
            $grid = $this->wipeAdjacentSquares($grid, $x, $y);
        }
        return $count;
    }

    public function generateHash($input)
    {
        if ($input !== '') {
            $chars = str_split($input);
        } else {
            $chars = [];
        }
        $lengths = array_map(function ($element) {
            return ord($element);
        }, $chars);
        $lengths = array_merge($lengths, [17, 31, 73, 47, 23]);
        $startingList = range(0, 255);;
        $string = new StringCircle($startingList, 0, 0);
        for ($i = 1; $i <= 64; $i++) {
            foreach ($lengths as $length) {
                $string = $string->tieKnot((int)$length);
            }
        }
        $hash = $string->denseHash();
        $hashParts = [];
        foreach (str_split($hash) as $hexChar) {
            $section = hexdec($hexChar);
            $b = 8;
            while ($b >= 1) {
                if ($section >= $b) {
                    $hashParts[] = 1;
                    $section -= $b;
                } else {
                    $hashParts[] = 0;
                }
                $b = ($b / 2);
            }
        }
        return $hashParts;
    }

    public function findFirstUsedSquare($grid)
    {
        foreach ($grid as $y => $row) {
            foreach ($row as $x => $square) {
                if ($square === 1) {
                    return [$x, $y];
                }
            }
        }
        return [false, false];
    }

    public function wipeAdjacentSquares($grid, $x, $y)
    {
        $grid = $this->wipeAdjacentSquare($grid, $x + 1, $y);
        $grid = $this->wipeAdjacentSquare($grid, $x - 1, $y);
        $grid = $this->wipeAdjacentSquare($grid, $x, $y + 1);
        $grid = $this->wipeAdjacentSquare($grid, $x, $y - 1);
        return $grid;
    }

    public function wipeAdjacentSquare($grid, $x, $y)
    {
        if (isset($grid[$y]) && isset($grid[$y][$x]) && $grid[$y][$x] === 1) {
            $grid[$y][$x] = 0;
            $grid = $this->wipeAdjacentSquares($grid, $x, $y);
        }
        return $grid;
    }
}


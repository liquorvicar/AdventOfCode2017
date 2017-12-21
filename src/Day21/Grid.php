<?php

namespace Liquorvicar\AdventOfCode\Day21;

class Grid
{
    private $rows;
    private $numPixels;

    /**
     * @param $rows
     */
    public function __construct($rows)
    {
        $this->rows = $rows;
        $this->numPixels = $this->countPixels($rows);
    }


    public function matches($rows)
    {
        if (count($rows[0]) !== count($this->rows[0])) {
            return false;
        }
        if ($this->numPixels !== $this->countPixels($rows)) {
            return false;
        }
        if ($rows === $this->rows) {
            return true;
        }
        $rotated = $this->rows;
        for ($i= 0; $i <= 2; $i++) {
            $rotated = $this->rotate($rotated);
            if ($rows === $rotated) {
                return true;
            }
        }
        $flipped = $this->flip($this->rows);
        if ($rows === $flipped) {
            return true;
        }
        $rotated = $flipped;
        for ($i= 0; $i <= 2; $i++) {
            $rotated = $this->rotate($rotated);
            if ($rows === $rotated) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $rows
     * @return mixed
     */
    protected function countPixels($rows)
    {
        return array_reduce($rows, function ($sum, $element) {
            return $sum + substr_count($element, '#');
        }, 0);
    }

    /**
     * @param $rows
     * @return array
     */
    protected function flip($rows): array
    {
        $flipped = array_map(function ($row) {
            return strrev($row);
        }, $rows);
        return $flipped;
    }

    private function rotate($rows)
    {
        $newRows = [];
        foreach ($rows as $x => $row) {
            $chars = str_split($row);
            $y = count($rows) - 1;
            foreach ($chars as $char) {
                $newRows[$y][$x] = $char;
                $y -= 1;
            }
        }
        ksort($newRows);
        return array_map(function ($row) {
            return implode($row);
        }, $newRows);
    }

    public function pixels()
    {
        return $this->numPixels;
    }
}
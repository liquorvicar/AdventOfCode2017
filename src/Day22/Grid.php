<?php

namespace Liquorvicar\AdventOfCode\Day22;

class Grid
{
    private $grid;
    private $infectedSquares;

    /**
     * @param $grid
     */
    public function __construct($grid, $infectedSquares = 0)
    {
        $this->grid = $grid;
        $this->infectedSquares = $infectedSquares;
    }

    public function isInfected($x, $y)
    {
        if (!isset($this->grid[$y])) {
            $this->grid[$y] = [];
        }
        if (!isset($this->grid[$y][$x])) {
            $this->grid[$y][$x] = '.';
        }
        return $this->grid[$y][$x] === '#';
    }

    public function clean($x, $y)
    {
        $this->grid[$y][$x] = '.';
    }

    public function infect($x, $y)
    {
        if (!$this->isInfected($x, $y)) {
            $this->infectedSquares++;
        }
        $this->grid[$y][$x] = '#';
    }

    public function findCentre()
    {
        $y = floor(count($this->grid) / 2);
        $x = floor(count($this->grid[0]) / 2);
        return ['x' => $x, 'y' => $y];
    }

    public function countInfected()
    {
        return $this->infectedSquares;
    }

}
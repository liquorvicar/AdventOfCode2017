<?php

namespace Liquorvicar\AdventOfCode\Day22;

class Grid
{
    const CLEAN = '.';
    const FLAGGED = 'F';
    const INFECTED = '#';
    const WEAKENED = 'W';
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
        $this->grid[$y][$x] = self::CLEAN;
    }

    public function infect($x, $y)
    {
        if (!$this->isInfected($x, $y)) {
            $this->infectedSquares++;
        }
        $this->grid[$y][$x] = self::INFECTED;
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

    public function currentState($x, $y)
    {
        if (!isset($this->grid[$y])) {
            $this->grid[$y] = [];
        }
        if (!isset($this->grid[$y][$x])) {
            $this->grid[$y][$x] = self::CLEAN;
        }
        return $this->grid[$y][$x];
    }

    public function flag($x, $y)
    {
        $this->grid[$y][$x] = self::FLAGGED;
    }

    public function weaken($x, $y)
    {
        $this->grid[$y][$x] = self::WEAKENED;
    }

    public function act($x, $y) {
        switch ($this->grid[$y][$x]) {
            case self::WEAKENED:
                $this->infect($x, $y);
                break;
            case self::FLAGGED:
                $this->clean($x, $y);
                break;
            case self::CLEAN:
                $this->weaken($x, $y);
                break;
            case self::INFECTED:
                $this->flag($x, $y);
                break;
        }
    }

}
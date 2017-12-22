<?php

namespace Liquorvicar\AdventOfCode\Day22;

class Carrier
{
    private $x;
    private $y;
    private $direction;

    const UP = 0;
    const RIGHT = 1;
    const DOWN = 2;
    const LEFT = 3;

    /**
     * @param $x
     * @param $y
     * @param $direction
     */
    public function __construct($x, $y, $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
    }


    public function burst(Grid $grid): Carrier
    {
        $state = $grid->currentState($this->x, $this->y);
        $direction = $this->direction;
        if ($state === Grid::INFECTED) {
            $direction = ($this->direction + 1) % 4;
        } elseif ($state === Grid::CLEAN) {
            $direction = $this->direction > 0 ? $this->direction - 1 : 3;
        } elseif ($state === Grid::FLAGGED) {
            $direction = ($this->direction + 2) % 4;
        }
        $grid->act($this->x, $this->y);
        $x = $this->x;
        $y = $this->y;
        switch ($direction) {
            case self::UP:
                $y--;
                break;
            case self::DOWN:
                $y++;
                break;
            case self::LEFT:
                $x--;
                break;
            case self::RIGHT:
                $x++;
                break;
            default:
                throw new \Exception('Invalid direction');
        }
        return new Carrier($x, $y, $direction);
    }
}
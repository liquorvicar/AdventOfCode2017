<?php

namespace Liquorvicar\AdventOfCode\Day20;

class Vector
{
    /** @var int */
    private $x;
    /** @var int */
    private $y;
    /** @var int */
    private $z;

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     */
    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function add(Vector $vector)
    {
        return new Vector($this->x + $vector->x,$this->y + $vector->y,$this->z + $vector->z);
    }

    public function direction()
    {
        $sum = $this->x + $this->y + $this->z;
        if ($sum === 0) {
            return $sum;
        }
        return ($sum / abs($sum));
    }

    public function net()
    {
        return abs($this->x) + abs($this->y) + abs($this->z);
    }

    public function equals(Vector $position)
    {
        return $this->x === $position->x && $this->y === $position->y && $this->z === $position->z;
    }

}


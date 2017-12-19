<?php

namespace Liquorvicar\AdventOfCode\Day19;

class Position
{
    private $x;
    private $y;
    private $direction;
    private $path;
    private $hasReachedEnd;

    /**
     * @param int $x
     * @param int $y
     * @param string $direction
     * @param $path
     * @param bool $hasReachedEnd
     */
    public function __construct($x, $y, $direction, $path, $hasReachedEnd = false)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
        $this->path = $path;
        $this->hasReachedEnd = $hasReachedEnd;
    }

    public function x() {
        return $this->x;
    }

    public function y() {
        return $this->y;
    }

    public function direction() {
        return $this->direction;
    }

    public function path() {
        return $this->path;
    }

    public function hasReachedEnd() {
        return $this->hasReachedEnd;
    }
}


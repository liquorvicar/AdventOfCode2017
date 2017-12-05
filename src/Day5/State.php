<?php

namespace Liquorvicar\AdventOfCode\Day5;

class State {
    /** @var int[] */
    private $program;

    /** @var int */
    private $currentPosition;

    /**
     * @param int[] $program
     * @param int $currentPosition
     */
    public function __construct(array $program, $currentPosition)
    {
        $this->program = $program;
        $this->currentPosition = $currentPosition;
    }

    /**
     * @return int[]
     */
    public function program()
    {
        return $this->program;
    }

    /**
     * @return int
     */
    public function currentPosition()
    {
        return $this->currentPosition;
    }

    public function hasTerminated()
    {
        return $this->currentPosition >= count($this->program);
    }

}

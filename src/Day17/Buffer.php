<?php

namespace Liquorvicar\AdventOfCode\Day17;

class Buffer
{
    private $buffer;
    private $position;
    private $nextInsert;

    /**
     * @param $buffer
     * @param $position
     * @param $nextInsert
     */
    public function __construct($buffer, $position, $nextInsert)
    {
        $this->buffer = $buffer;
        $this->position = $position;
        $this->nextInsert = $nextInsert;
    }

    public function spin($int)
    {
        $newPos = (($this->position + $int) % count($this->buffer)) + 1;
        $buffer = array_slice($this->buffer, 0, $newPos);
        $buffer[] = $this->nextInsert;
        $buffer = array_merge($buffer, array_slice($this->buffer, $newPos));
        return new Buffer($buffer, $newPos, $this->nextInsert + 1);
    }

    public function getNextValue()
    {
        return $this->buffer[$this->position + 1];
    }

    public function getSecondValue() {
        return $this->buffer[1];
    }
}
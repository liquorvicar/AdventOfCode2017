<?php

namespace Liquorvicar\AdventOfCode\Day8;

class Register
{
    /** @var int  */
    private $value;

    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}


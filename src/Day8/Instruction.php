<?php

namespace Liquorvicar\AdventOfCode\Day8;

class Instruction
{
    /** @var int */
    private $conditionalValue;

    /** @var int */
    private $incrementValue;

    /** @var callable */
    private $compare;

    /**
     * @param int $conditionalValue
     * @param int $incrementValue
     * @param callable $compare
     */
    public function __construct($conditionalValue, $incrementValue, callable $compare)
    {
        $this->conditionalValue = $conditionalValue;
        $this->incrementValue = $incrementValue;
        $this->compare = $compare;
    }

    public function run(Register $target, Register $condition): Register {
        $value = $target->value();
        if (call_user_func($this->compare, $condition->value(), $this->conditionalValue)) {
            $value += $this->incrementValue;
        }
        return new Register($value);
    }
}


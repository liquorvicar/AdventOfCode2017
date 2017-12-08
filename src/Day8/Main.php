<?php

namespace Liquorvicar\AdventOfCode\Day8;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $registers = [];
        foreach ($input as $rawInstruction) {
            $registers = $this->runInstruction($rawInstruction, $registers);
        }
        return array_reduce($registers, function ($max, Register $register) {
            return $max >= $register->value() ? $max : $register->value();
        }, 0);
    }

    public function runPartTwo(array $input)
    {
        $registers = [];
        $max = 0;
        foreach ($input as $rawInstruction) {
            $registers = $this->runInstruction($rawInstruction, $registers);
            $currentMax = array_reduce($registers, function ($max, Register $register) {
                return $max >= $register->value() ? $max : $register->value();
            }, 0);
            $max = $max >= $currentMax ? $max : $currentMax;
        }
        return $max;
    }

    /**
     * @param $rawInstruction
     * @return array
     */
    public function parse($rawInstruction)
    {
        $tokens = explode( ' ', $rawInstruction);
        $increment = $tokens[2];
        if ($tokens[1] === 'dec') {
            $increment = $increment * -1;
        }
        $conditionalValue = $tokens[6];
        switch ($tokens[5]) {
            case '>':
                $compare = function ($a, $b) {
                    return $a > $b;
                };
                break;
            case '<':
                $compare = function ($a, $b) {
                    return $a < $b;
                };
                break;
            case '>=':
                $compare = function ($a, $b) {
                    return $a >= $b;
                };
                break;
            case '<=':
                $compare = function ($a, $b) {
                    return $a <= $b;
                };
                break;
            case '==':
                $compare = function ($a, $b) {
                    return $a == $b;
                };
                break;
            case '!=':
                $compare = function ($a, $b) {
                    return $a != $b;
                };
                break;
            default:
                throw new \RuntimeException('Invalid comparison token found');
        }
        return [
            'instruction' => new Instruction($conditionalValue, $increment, $compare),
            'target' => $tokens[0],
            'condition' => $tokens[4],
        ];
    }

    /**
     * @param $rawInstruction
     * @param $registers
     * @return mixed
     */
    protected function runInstruction($rawInstruction, $registers)
    {
        $parseResult = $this->parse($rawInstruction);
        $target = isset($registers[$parseResult['target']]) ? $registers[$parseResult['target']] : new Register(0);
        $registers[$parseResult['target']] = $target;
        $conditional = isset($registers[$parseResult['condition']]) ? $registers[$parseResult['condition']] : new Register(0);
        /** @var Instruction $instruction */
        $instruction = $parseResult['instruction'];
        $target = $instruction->run($target, $conditional);
        $registers[$parseResult['target']] = $target;
        return $registers;
    }
}


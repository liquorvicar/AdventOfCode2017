<?php

namespace Liquorvicar\AdventOfCode\Day23;

class Program
{
    private $registers;
    private $nextInstruction = 0;
    private $mulCount = 0;

    /**
     * @param $registers
     * @param $nextInstruction
     */
    public function __construct($registers, $nextInstruction)
    {
        $this->registers = $registers;
        $this->nextInstruction = $nextInstruction;
    }


    public function run($command)
    {
        $registers = $this->registers;
        $parseCommand = explode(' ', $command);
        $register = $parseCommand[1];
        $firstRegisterValue =$this->getValue($parseCommand, 1, $registers);
        $secondRegisterValue =$this->getValue($parseCommand, 2, $registers);
        $nextInstruction = $this->nextInstruction;
        if (!is_numeric($register) && !isset($registers[$register])) {
            $registers[$register] = 0;
        }
        switch ($parseCommand[0]) {
            case 'set':
                $registers[$register] = $secondRegisterValue;
                $nextInstruction++;
                break;
            case 'sub':
                $registers[$register] -= $secondRegisterValue;
                $nextInstruction++;
                break;
            case 'mul':
                $registers[$register] = $firstRegisterValue * $secondRegisterValue;
                $nextInstruction++;
                $this->mulCount++;
                break;
            case 'jnz':
                if ($firstRegisterValue <> 0) {
                    $nextInstruction = $this->nextInstruction + $secondRegisterValue;
                } else {
                    $nextInstruction++;
                }
                break;
        }
        $this->registers = $registers;
        $this->nextInstruction = $nextInstruction;
    }

    private function getValue($parseCommand, $int, $registers)
    {
        if (!isset($parseCommand[$int])) {
            return 0;
        }
        if (isset($registers[$parseCommand[$int]])) {
            return (int)$registers[$parseCommand[$int]];
        }
        return (int)$parseCommand[$int];
    }

    public function mulCount() {
        return $this->mulCount;
    }

    public function nextInstruction() {
        return $this->nextInstruction;
    }

    public function register($register) {
        return isset($this->registers[$register]) ? $this->registers[$register] : 0;
    }
}


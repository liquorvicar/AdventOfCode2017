<?php

namespace Liquorvicar\AdventOfCode\Day18;

class State
{
    private $registers;
    private $nextInstruction = 0;
    private $lastSound = 0;
    private $isRecovered = false;

    /**
     * @param $registers
     * @param int $nextInstruction
     * @param int $lastSound
     * @param bool $isRecovered
     */
    public function __construct($registers, int $nextInstruction, int $lastSound, $isRecovered = false)
    {
        $this->registers = $registers;
        $this->nextInstruction = $nextInstruction;
        $this->lastSound = $lastSound;
        $this->isRecovered = $isRecovered;
    }

    public function run($command) {
        $registers = $this->registers;
        $parseCommand = explode(' ', $command);
        $register = $parseCommand[1];
        $firstRegisterValue =$this->getValue($parseCommand, 1, $registers);
        $secondRegisterValue =$this->getValue($parseCommand, 2, $registers);
        $lastSound = $this->lastSound;
        $isRecovered = false;
        $nextInstruction = $this->nextInstruction + 1;
        if (!isset($registers[$register])) {
            $registers[$register] = 0;
        }
        switch ($parseCommand[0]) {
            case 'set':
                $registers[$register] = $secondRegisterValue;
                break;
            case 'add':
                $registers[$register] += $secondRegisterValue;
                break;
            case 'mul':
                $registers[$register] = $firstRegisterValue * $secondRegisterValue;
                break;
            case 'mod':
                $registers[$register] = $firstRegisterValue % $secondRegisterValue;
                break;
            case 'snd':
                $lastSound = $firstRegisterValue;
                break;
            case 'rcv':
                $isRecovered = $firstRegisterValue > 0;
                break;
            case 'jgz':
                if ($firstRegisterValue > 0) {
                    $nextInstruction = $this->nextInstruction + $secondRegisterValue;
                }
                break;
        }
        return new State($registers, $nextInstruction, $lastSound, $isRecovered);
    }

    public function isRecovered() {
        return $this->isRecovered;
    }

    public function lastSound() {
        return $this->lastSound;
    }

    public function nextInstruction() {
        return $this->nextInstruction;
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
}


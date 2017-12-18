<?php

namespace Liquorvicar\AdventOfCode\Day18;

class Program
{
    /**
     * @var Program
     */
    private $receiver;
    private $isPaused;
    private $nextInstruction;
    private $sendCount;
    private $registers;
    private $receives;

    /**
     * @param $registers
     * @param $nextInstruction
     */
    public function __construct($registers, $nextInstruction)
    {
        $this->nextInstruction = $nextInstruction;
        $this->registers = $registers;
        $this->receives = [];
        $this->sendCount = 0;
        $this->isPaused = false;
    }

    public function run($command) {
        $registers = $this->registers;
        $parseCommand = explode(' ', $command);
        $register = $parseCommand[1];
        $firstRegisterValue =$this->getValue($parseCommand, 1, $registers);
        $secondRegisterValue =$this->getValue($parseCommand, 2, $registers);
        $isPaused = false;
        $nextInstruction = $this->nextInstruction;
        if (!is_numeric($register) && !isset($registers[$register])) {
            $registers[$register] = 0;
        }
        switch ($parseCommand[0]) {
            case 'set':
                $registers[$register] = $secondRegisterValue;
                $nextInstruction++;
                break;
            case 'add':
                $registers[$register] += $secondRegisterValue;
                $nextInstruction++;
                break;
            case 'mul':
                $registers[$register] = $firstRegisterValue * $secondRegisterValue;
                $nextInstruction++;
                break;
            case 'mod':
                $registers[$register] = $firstRegisterValue % $secondRegisterValue;
                $nextInstruction++;
                break;
            case 'snd':
                $this->receiver->receive($firstRegisterValue);
                $nextInstruction++;
                $this->sendCount++;
                break;
            case 'rcv':
                if (count($this->receives) === 0) {
                    $isPaused = true;
                } else {
                    $registers[$register] = array_shift($this->receives);
                    $nextInstruction++;
                }
                break;
            case 'jgz':
                if ($firstRegisterValue > 0) {
                    $nextInstruction = $this->nextInstruction + $secondRegisterValue;
                } else {
                    $nextInstruction++;
                }
                break;
        }
        $this->registers = $registers;
        $this->nextInstruction = $nextInstruction;
        $this->isPaused = $isPaused;
    }

    public function receive($value) {
        $this->receives[] = $value;
    }

    public function setReceiver(Program $program)
    {
        $this->receiver = $program;
    }

    public function isPaused()
    {
        return $this->isPaused;
    }

    public function nextInstruction() {
        return $this->nextInstruction;
    }

    public function sendCount()
    {
        return $this->sendCount;
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

    public function registers()
    {
        return $this->registers;
    }
}
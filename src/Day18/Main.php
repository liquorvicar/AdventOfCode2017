<?php

namespace Liquorvicar\AdventOfCode\Day18;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    public function runPartOne(array $input)
    {
        $state = new State([], 0, 0);
        while (!$state->isRecovered()) {
            if (!isset($input[$state->nextInstruction()])) {
                break;
            }
            $state = $state->run($input[$state->nextInstruction()]);
        }
        return $state->lastSound();
    }

    public function runPartTwo(array $input)
    {
        $p0 = new Program(['p' => 0], 0);
        $p1 = new Program(['p' => 1], 0);
        $p0->setReceiver($p1);
        $p1->setReceiver($p0);
        while (!($p0->isPaused() && $p1->isPaused())) {
            if (!isset($input[$p0->nextInstruction()])) {
                break;
            }
            $p0->run($input[$p0->nextInstruction()]);
            if (!isset($input[$p1->nextInstruction()])) {
                break;
            }
            $p1->run($input[$p1->nextInstruction()]);
        }
        return $p1->sendCount();
    }

}


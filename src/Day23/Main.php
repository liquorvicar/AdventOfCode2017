<?php

namespace Liquorvicar\AdventOfCode\Day23;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain {

    public function runPartOne(array $input)
    {
        $program = new Program([], 0);
        $iterations = 0;
        while (isset($input[$program->nextInstruction()])) {
            echo $iterations . ':' . $program->nextInstruction() . PHP_EOL;
            $program->run($input[$program->nextInstruction()]);
            $iterations++;
        }
        return $program->mulCount();
    }

    public function runPartTwo(array $input)
    {
        $h = 0;
        for ($i = 106700; $i <= 123700; $i = $i + 17) {
            for ($j = 2; $j < $i; $j++) {
                if (($i % $j) === 0) {
                    $h++;
                    break;
                }
            }
        }
        return $h;
    }


}
<?php

namespace Liquorvicar\AdventOfCode\tests\Day23;

use Liquorvicar\AdventOfCode\Day23\Program;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param Program $program
     * @param $command
     * @param Program $expectedProgram
     * @dataProvider dataForCommand
     */
    public function testCommand(Program $program, $command, Program $expectedProgram) {
        $program->run($command);
        $this->assertEquals($expectedProgram, $program);
    }

    public function dataForCommand() {
        return [
            [new Program(['a' => 1, 'b' => 2], 0), 'set a b', new Program(['a' => 2, 'b' => 2], 1)],
            [new Program(['a' => 1], 0), 'set a 5', new Program(['a' => 5], 1)],
            [new Program(['a' => 3, 'b' => 1], 0), 'sub a b', new Program(['a' => 2, 'b' => 1], 1)],
            [new Program(['a' => 3, 'b' => 2], 0), 'mul a b', new Program(['a' => 6, 'b' => 2], 1)],
            [new Program(['a' => 3, 'b' => 2], 0), 'jnz a b', new Program(['a' => 3, 'b' => 2], 2)],
            [new Program(['a' => 3], 0), 'jnz a 2', new Program(['a' => 3], 2)],
            [new Program(['a' => 3], 0), 'jnz a -2', new Program(['a' => 3], -2)],
            [new Program(['a' => 3], 0), 'jnz 1 2', new Program(['a' => 3], 2)],
            [new Program(['a' => 3], 0), 'jnz -1 2', new Program(['a' => 3], 2)],
        ];
    }
}

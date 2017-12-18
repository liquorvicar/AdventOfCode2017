<?php

namespace Liquorvicar\AdventOfCode\tests\Day18;

use Liquorvicar\AdventOfCode\Day18\Main;
use Liquorvicar\AdventOfCode\Day18\Program;
use Liquorvicar\AdventOfCode\Day18\State;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $startState
     * @param $command
     * @param $endState
     * @dataProvider dataForOperations
     */
    public function testOperation($startState, $command, $endState) {
        $this->assertEquals($endState, $startState->run($command));
    }

    public function dataForOperations() {
        return [
            [new State(['a' => 0], 0, 0), 'set a 1', new State(['a' => 1], 1, 0)],
            [new State([], 0, 0), 'add a 1', new State(['a' => 1], 1, 0)],
            [new State(['a' => 3], 0, 0), 'add a 2', new State(['a' => 5], 1, 0)],
            [new State(['a' => 3], 0, 0), 'mul a a', new State(['a' => 9], 1, 0)],
            [new State(['b' => 7], 0, 0), 'mod b 5', new State(['b' => 2], 1, 0)],
            [new State(['a' => 4], 0, 0), 'snd a', new State(['a' => 4], 1, 4)],
            [new State(['a' => 0], 0, 0), 'rcv a', new State(['a' => 0], 1, 0)],
            [new State(['a' => 2], 0, 4), 'rcv a', new State(['a' => 2], 1, 4, true)],
            [new State(['a' => 0], 0, 0), 'jgz a -1', new State(['a' => 0], 1, 0)],
            [new State(['a' => 2], 0, 0), 'jgz a -1', new State(['a' => 2], -1, 0)],
        ];
    }

    public function testLastSoundAfterRecover() {
        $duet = new Main();
        $instructions = [
            'set a 1',
            'add a 2',
            'mul a a',
            'mod a 5',
            'snd a',
            'set a 0',
            'rcv a',
            'jgz a -1',
            'set a 1',
            'jgz a -2'
        ];
        $this->assertEquals(4, $duet->runPartOne($instructions));
    }

    public function testPartTwo() {
        $duet = new Main();
        $instructions = [
            'snd 1',
            'snd 2',
            'snd p',
            'rcv a',
            'rcv b',
            'rcv c',
            'rcv d'
        ];
        $this->assertEquals(3, $duet->runPartTwo($instructions));
    }

    /**
     * @param Program $program
     * @param $command
     * @param $expectedRegisters
     * @param $expectedNextInstruction
     * @param $isPaused
     * @dataProvider dataForProgramOperations
     */
    public function testProgramOperations(Program $program, $command, $expectedRegisters, $expectedNextInstruction, $isPaused) {
        $receiver = new Program(['p' => 1], 0);
        $program->setReceiver($receiver);
        $program->run($command);
        $this->assertEquals($expectedRegisters, $program->registers());
        $this->assertEquals($expectedNextInstruction, $program->nextInstruction());
        $this->assertEquals($isPaused, $program->isPaused());
    }

    public function dataForProgramOperations() {
        return [
            [new Program(['a' => 0], 0), 'set a 1', ['a' => 1], 1, false],
            [new Program([], 0), 'add a 1', ['a' => 1], 1, false],
            [new Program(['a' => 3], 0), 'add a 2', ['a' => 5], 1, false],
            [new Program(['a' => 3], 0), 'mul a a', ['a' => 9], 1, false],
            [new Program(['b' => 7], 0), 'mod b 5', ['b' => 2], 1, false],
            [new Program(['a' => 4], 0), 'snd a', ['a' => 4], 1, false],
            [new Program(['a' => 0], 0), 'rcv a', ['a' => 0], 0, true],
            [new Program(['a' => 2], 0), 'rcv a', ['a' => 2], 0, true],
            [new Program(['a' => 0], 0), 'jgz a -1', ['a' => 0], 1, false],
            [new Program(['a' => 2], 0), 'jgz a -1', ['a' => 2], -1, false],
            [new Program(['a' => 2], 0), 'jgz 1 3', ['a' => 2], 3, false],
        ];
    }

    public function testSend() {
        $program = new Program(['a' => 4], 0);
        $receiver = new Program(['p' => 1], 0);
        $program->setReceiver($receiver);
        $program->run('snd a');
        $receiver->run('rcv p');
        $this->assertEquals(['p' => 4], $receiver->registers());
    }
}

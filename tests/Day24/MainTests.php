<?php

namespace Liquorvicar\AdventOfCode\tests\Day24;

use Liquorvicar\AdventOfCode\Day24\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    public function testParsePipes() {
        $pipes = [
            '0/2',
            '2/2',
            '2/3',
            '3/4',
            '3/5',
            '0/1',
            '10/1',
            '9/10',
        ];
        $expected = [
            [0, 2],
            [2, 2],
            [2, 3],
            [3, 4],
            [3, 5],
            [0, 1],
            [1, 10],
            [9, 10],
        ];
        $cpu = new Main();
        $this->assertEquals($expected, $cpu->parsePipes($pipes));
    }

    public function testFindZeros() {
        $pipes = [
            [0, 2],
            [2, 2],
            [2, 3],
            [3, 4],
            [3, 5],
            [0, 1],
            [1, 10],
            [9, 10],
        ];
        $zeros = [
            0 => [0, 2],
            5 => [0, 1],
        ];
        $cpu = new Main();
        $this->assertEquals($zeros, $cpu->findZeros($pipes));
    }

    public function testFindMatchingPipes() {
        $pipes = [
            [2, 2],
            [2, 3],
            [3, 4],
            [3, 5],
            [0, 1],
            [1, 10],
            [9, 10],
        ];
        $matchingPipes = [
            1 => [2, 3],
            2 => [3, 4],
            3 => [3, 5],
        ];
        $cpu = new Main();
        $this->assertEquals($matchingPipes, $cpu->matchingPipes($pipes, 3));
    }

    public function testFindValidBridges() {
        $bridges = [
            [[0,1],],
            [[0,1],[1,10],],
            [[0,1],[1,10],[9,10],],
            [[0,2],],
            [[0,2],[2,3],],
            [[0,2],[2,3],[3,4],],
            [[0,2],[2,3],[3,5],],
            [[0,2],[2,2],],
            [[0,2],[2,2],[2,3],],
            [[0,2],[2,2],[2,3],[3,4],],
            [[0,2],[2,2],[2,3],[3,5],],
        ];
        $pipes = [
            [0, 1],
            [0, 2],
            [1, 10],
            [9, 10],
            [2, 3],
            [2, 2],
            [3, 4],
            [3, 5],
        ];
        $cpu = new Main();
        $this->assertEquals($bridges, $cpu->findBridges($pipes));
    }

    public function testFindStrongestBridge() {

        $bridges = [
            [[0,1],],
            [[0,1],[1,10],],
            [[0,1],[1,10],[9,10],],
            [[0,2],],
            [[0,2],[2,3],],
            [[0,2],[2,3],[3,4],],
            [[0,2],[2,3],[3,5],],
            [[0,2],[2,2],],
            [[0,2],[2,2],[2,3],],
            [[0,2],[2,2],[2,3],[3,4],],
            [[0,2],[2,2],[2,3],[3,5],],
        ];
        $cpu = new Main();
        $this->assertEquals(31, $cpu->findStrongestBridge($bridges));
    }
}

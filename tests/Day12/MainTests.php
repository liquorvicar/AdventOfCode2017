<?php

namespace Liquorvicar\AdventOfCode\tests\Day12;

use Liquorvicar\AdventOfCode\Day12\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    public function testFindAllConnections() {
        $input = [
            '0 <-> 2',
            '1 <-> 1',
            '2 <-> 0, 3, 4',
            '3 <-> 2, 4',
            '4 <-> 2, 3, 6',
            '5 <-> 6',
            '6 <-> 4, 5',
        ];
        $connections = [
            0 => [2],
            1 => [1],
            2 => [0, 3, 4],
            3 => [2, 4],
            4 => [2, 3, 6],
            5 => [6],
            6 => [4, 5],
        ];
        $pipes = new Main();
        $this->assertEquals($connections, $pipes->findAllConnections($input));
    }

    public function testFindLinkedPipes() {
        $connections = [
            0 => [2],
            1 => [1],
            2 => [0, 3, 4],
            3 => [2, 4],
            4 => [2, 3, 6],
            5 => [6],
            6 => [4, 5],
        ];
        $pipes = new Main();
        $this->assertEquals(6, count($pipes->findLinkedPipes($connections, 0)));
    }

    public function testCountGroups() {
        $input = [
            '0 <-> 2',
            '1 <-> 1',
            '2 <-> 0, 3, 4',
            '3 <-> 2, 4',
            '4 <-> 2, 3, 6',
            '5 <-> 6',
            '6 <-> 4, 5',
        ];
        $pipes = new Main();
        $this->assertEquals(2, $pipes->runPartTwo($input));
    }
}

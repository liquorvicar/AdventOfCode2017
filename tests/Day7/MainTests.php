<?php

namespace Liquorvicar\AdventOfCode\tests\Day7;

use Liquorvicar\AdventOfCode\Day7\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase
{

    public function testFindBottomDisc() {
        $tower = new Main();
        $input = [
            'pbga (66)',
            'xhth (57)',
            'ebii (61)',
            'havc (66)',
            'ktlj (57)',
            'fwft (72) -> ktlj, cntj, xhth',
            'qoyq (66)',
            'padx (45) -> pbga, havc, qoyq',
            'tknk (41) -> ugml, padx, fwft',
            'jptl (61)',
            'ugml (68) -> gyxo, ebii, jptl',
            'gyxo (61)',
            'cntj (57)',
        ];
        $this->assertEquals('tknk', $tower->runPartOne($input));
    }

    public function testFindBalancedWeight() {
        $tower = new Main();
        $input = [
            'pbga (66)',
            'xhth (57)',
            'ebii (61)',
            'havc (66)',
            'ktlj (57)',
            'fwft (72) -> ktlj, cntj, xhth',
            'qoyq (66)',
            'padx (45) -> pbga, havc, qoyq',
            'tknk (41) -> ugml, padx, fwft',
            'jptl (61)',
            'ugml (68) -> gyxo, ebii, jptl',
            'gyxo (61)',
            'cntj (57)',
        ];
        $this->assertEquals(60, $tower->runPartTwo($input));
    }
}

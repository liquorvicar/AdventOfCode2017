<?php

namespace Liquorvicar\AdventOfCode\tests\Day16;

use Liquorvicar\AdventOfCode\Day16\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    public function testSpinCommand() {
        $dancers = new Main(5);
        $this->assertEquals('cdeab', $dancers->runPartOne(['s3']));
    }

    public function testExchangeCommand() {
        $dancers = new Main(5);
        $this->assertEquals('abced', $dancers->runPartOne(['x3/4']));
    }

    public function testPartnerCommand() {
        $dancers = new Main(5);
        $this->assertEquals('aecdb', $dancers->runPartOne(['pe/b']));
    }

    public function testMultipleCommands() {
        $dancers = new Main(5);
        $this->assertEquals('baedc', $dancers->runPartOne(['s1,x3/4,pe/b']));
    }

    public function testMultipleDances() {
        $dancers = new Main(5);
        $this->assertEquals('ceadb', $dancers->runPartTwo(['s1,x3/4,pe/b']));
    }
}

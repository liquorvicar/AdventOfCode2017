<?php

namespace Liquorvicar\AdventOfCode\tests\Day13;

use Liquorvicar\AdventOfCode\Day13\Firewall;
use Liquorvicar\AdventOfCode\Day13\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $picoSeconds
     * @param $endPositions
     * @dataProvider dataForScannerPositions
     */
    public function testScannerPositions($picoSeconds, $endPositions) {
        $firewall = new Firewall([
            0 => 3,
            1 => 2,
            4 => 4,
            6 => 4
        ]);
        $this->assertEquals($endPositions, $firewall->scan($picoSeconds));
    }

    public function dataForScannerPositions() {
        return [
            [0, [0 => 0, 1 => 0, 4 => 0, 6 => 0]],
            [1, [0 => 1, 1 => 1, 4 => 1, 6 => 1]],
            [2, [0 => 2, 1 => 0, 4 => 2, 6 => 2]],
            [3, [0 => 1, 1 => 1, 4 => 3, 6 => 3]],
        ];
    }

    /**
     * @param $picoSeconds
     * @param $isCaught
     * @dataProvider dataForCaught
     */
    public function testCaught($picoSeconds, $isCaught) {
        $firewall = new Firewall([
            0 => 3,
            1 => 2,
            4 => 4,
            6 => 4
        ]);
        $this->assertEquals($isCaught, $firewall->isCaught($picoSeconds));
    }

    public function dataForCaught() {
        return [
            [0, true],
            [1, false],
            [2, false],
            [3, false],
            [4, false],
            [5, false],
            [6, true],
        ];
    }

    public function testCalculateSeverity() {
        $firewall = new Firewall([
            0 => 3,
            1 => 2,
            4 => 4,
            6 => 4
        ]);
        $this->assertEquals(24, $firewall->severity());
    }

    public function testPassThroughUncaught() {
        $firewall = new Firewall([
            0 => 3,
            1 => 2,
            4 => 4,
            6 => 4
        ]);
        $firewall->scan(10);
        $this->assertEquals(0, $firewall->severity());
    }

    public function testFindClearRun() {
        $firewall = new Main();
        $input = [
            '0: 3',
            '1: 2',
            '4: 4',
            '6: 4',
        ];
        $this->assertEquals(10, $firewall->findClearRun($input));
    }
}

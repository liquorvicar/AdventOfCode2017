<?php

namespace Liquorvicar\AdventOfCode\tests\Day14;

use Liquorvicar\AdventOfCode\Day14\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $input
     * @param $first8Chars
     * @dataProvider dataForCalculateHashes
     */
    public function testCalculateHashes($input, $first8Chars) {
        $defragger = new Main();
        $hash = $defragger->generateHash($input);
        $this->assertEquals($first8Chars, array_slice($hash, 0, 8));
    }

    public function dataForCalculateHashes() {
        return [
            ['flqrgnkx-0', [1, 1, 0, 1, 0, 1, 0, 0]],
            ['flqrgnkx-1', [0, 1, 0, 1, 0, 1, 0, 1]],
        ];
    }

    public function testGetUsedSquares() {
        $defragger = new Main();
        $this->assertEquals(8108, $defragger->runPartOne(['flqrgnkx']));
    }

    public function testCalculateRegions() {
        $defragger = new Main();
        $this->assertEquals(1242, $defragger->runPartTwo(['flqrgnkx']));
    }

    /**
     * @param $grid
     * @param $coords
     * @dataProvider dataForFindFirstUsedSquare
     */
    public function testFindFirstUsedSquare($grid, $coords) {
        $defragger = new Main();
        $this->assertEquals($coords, $defragger->findFirstUsedSquare($grid));
    }

    public function dataForFindFirstUsedSquare() {
        return [
            [[], [false, false]],
            [[[0, 0, 0, 0]], [false, false]],
            [[[0, 1, 0, 0]], [1, 0]],
            [[[0, 0, 0, 0], [0, 1, 0, 0]], [1, 1]],
        ];
    }

    /**
     * @param $inputGrid
     * @param $x
     * @param $y
     * @param $resultGrid
     * @dataProvider dataForWipeAdjacentSquares
     */
    public function testWipeAdjacentSquares($inputGrid, $x, $y, $resultGrid) {
        $defragger = new Main();
        $this->assertEquals($resultGrid, $defragger->wipeAdjacentSquares($inputGrid, $x, $y));
    }

    public function dataForWipeAdjacentSquares() {
        return [
            [[[1, 1], [1, 1]], 0, 0, [[0, 0], [0, 0]]],
            [[[0, 1, 1], [1, 1, 0], [1, 0, 0]], 1, 1, [[0, 0, 0], [0, 0, 0], [0, 0, 0]]],
            [[[0, 1, 1], [1, 1, 0], [0, 0, 1]], 1, 1, [[0, 0, 0], [0, 0, 0], [0, 0, 1]]],
        ];
    }

    public function testCountRegions() {
        $input = [[0, 1, 1], [1, 1, 0], [0, 0, 1]];
        $defragger = new Main();
        $this->assertEquals(2, $defragger->countRegions($input, 0));
    }
}

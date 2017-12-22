<?php

namespace Liquorvicar\AdventOfCode\tests\Day22;

use Liquorvicar\AdventOfCode\Day22\Carrier;
use Liquorvicar\AdventOfCode\Day22\Grid;
use Liquorvicar\AdventOfCode\Day22\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    public function testVirusCarrierOnCleanNode() {
        $grid = new Grid([['.']]);
        $carrier = new Carrier(0, 0, Carrier::LEFT);
        $expectedGrid = new Grid([['#']], 1);
        $expectedCarrier = new Carrier(0, 1, Carrier::DOWN);
        $this->assertEquals($expectedCarrier, $carrier->burst($grid));
        $this->assertEquals($expectedGrid, $grid);
    }

    public function testVirusCarrierOnInfectedNode() {
        $grid = new Grid([['#']]);
        $carrier = new Carrier(0, 0, Carrier::LEFT);
        $expectedGrid = new Grid([['.']]);
        $expectedCarrier = new Carrier(0, -1, Carrier::UP);
        $this->assertEquals($expectedCarrier, $carrier->burst($grid));
        $this->assertEquals($expectedGrid, $grid);
    }

    public function testDetectInfectedSquare() {
        $grid = new Grid([['#']]);
        $this->assertEquals(true, $grid->isInfected(0, 0));
    }

    public function testDetectCleanSquare() {
        $grid = new Grid([['.']]);
        $this->assertEquals(false, $grid->isInfected(0, 0));
    }

    public function testDetectNewSquareIsClean() {
        $grid = new Grid([['.']]);
        $this->assertEquals(false, $grid->isInfected(1, 0));
    }

    public function testDetectNewSquareIsCreated() {
        $grid = new Grid([['.']]);
        $expected = new Grid([['.', '.']]);
        $grid->isInfected(1, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testCleanSquare() {
        $grid = new Grid([['#']]);
        $expected = new Grid([['.']]);
        $grid->clean(0, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testInfectSquare() {
        $grid = new Grid([['.']], 0);
        $expected = new Grid([['#']], 1);
        $grid->infect(0, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testInfectSquareDoesNotCountInfectedSquare() {
        $grid = new Grid([['#']], 0);
        $expected = new Grid([['#']], 0);
        $grid->infect(0, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testFindCentre() {
        $grid = new Grid([
            ['.', '.', '#'],
            ['#', '.', '.'],
            ['.', '.', '.'],
        ]);
        $this->assertEquals(['x' => 1, 'y' => 1], $grid->findCentre());
    }

    public function testCountInfectedNodes() {
        $main = new Main();
        $grid = [
            ['.', '.', '#'],
            ['#', '.', '.'],
            ['.', '.', '.'],
        ];
        $this->assertEquals(41, $main->countInfectedNodes($grid, 70));
    }

    public function testCountInfectedNodesWithMoreIterations() {
        $main = new Main();
        $grid = [
            ['.', '.', '#'],
            ['#', '.', '.'],
            ['.', '.', '.'],
        ];
        $this->assertEquals(5587, $main->countInfectedNodes($grid, 10000));
    }
}

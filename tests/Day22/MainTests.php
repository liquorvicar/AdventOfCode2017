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
        $expectedGrid = new Grid([['W']]);
        $expectedCarrier = new Carrier(0, 1, Carrier::DOWN);
        $this->assertEquals($expectedCarrier, $carrier->burst($grid));
        $this->assertEquals($expectedGrid, $grid);
    }

    public function testVirusCarrierOnInfectedNode() {
        $grid = new Grid([['#']]);
        $carrier = new Carrier(0, 0, Carrier::LEFT);
        $expectedGrid = new Grid([['F']]);
        $expectedCarrier = new Carrier(0, -1, Carrier::UP);
        $this->assertEquals($expectedCarrier, $carrier->burst($grid));
        $this->assertEquals($expectedGrid, $grid);
    }

    public function testDetectInfectedSquare() {
        $grid = new Grid([['#']]);
        $this->assertEquals(Grid::INFECTED, $grid->currentState(0, 0));
    }

    public function testDetectCleanSquare() {
        $grid = new Grid([['.']]);
        $this->assertEquals(Grid::CLEAN, $grid->currentState(0, 0));
    }

    public function testDetectWeakenedSquare() {
        $grid = new Grid([['W']]);
        $this->assertEquals(Grid::WEAKENED, $grid->currentState(0, 0));
    }

    public function testDetectFlaggedSquare() {
        $grid = new Grid([['F']]);
        $this->assertEquals(Grid::FLAGGED, $grid->currentState(0, 0));
    }

    public function testDetectNewSquareIsClean() {
        $grid = new Grid([['.']]);
        $this->assertEquals(Grid::CLEAN, $grid->currentState(1, 0));
    }

    public function testDetectNewSquareIsCreated() {
        $grid = new Grid([['.']]);
        $expected = new Grid([['.', '.']]);
        $grid->currentState(1, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testCleanSquare() {
        $grid = new Grid([['F']]);
        $expected = new Grid([['.']]);
        $grid->clean(0, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testInfectSquare() {
        $grid = new Grid([['W']], 0);
        $expected = new Grid([['#']], 1);
        $grid->infect(0, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testWeakenSquare() {
        $grid = new Grid([['.']], 0);
        $expected = new Grid([['W']], 0);
        $grid->weaken(0, 0);
        $this->assertEquals($expected, $grid);
    }

    public function testFlagSquare() {
        $grid = new Grid([['#']], 0);
        $expected = new Grid([['F']], 0);
        $grid->flag(0, 0);
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
        $this->assertEquals(26, $main->countInfectedNodes($grid, 100));
    }

    public function testCountInfectedNodesWithMoreIterations() {
        $main = new Main();
        $grid = [
            ['.', '.', '#'],
            ['#', '.', '.'],
            ['.', '.', '.'],
        ];
        $this->assertEquals(2511944, $main->countInfectedNodes($grid, 10000000));
    }
}

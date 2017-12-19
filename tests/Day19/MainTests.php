<?php

namespace Liquorvicar\AdventOfCode\tests\Day19;

use Liquorvicar\AdventOfCode\Day19\Main;
use Liquorvicar\AdventOfCode\Day19\Position;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    public function testFindStartingPoint() {
        $grid = $this->getExampleGrid();
        $position = new Position(5, 0, 'D', '');
        $gridNavigator = new Main();
        $this->assertEquals($position, $gridNavigator->findStartingPoint($grid));
    }

    public function testFollowsStraightLineDown() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(5, 0, 'D', '');
        $newPosition = new Position(5, 1, 'D', '');
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testCollectsLetterInPath() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(5, 1, 'D', '');
        $newPosition = new Position(5, 2, 'D', 'A');
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testFollowsStraightLineRight() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(6, 5, 'R', '');
        $newPosition = new Position(7, 5, 'R', '');
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testFollowsStraightLineUp() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(8, 5, 'U', '');
        $newPosition = new Position(8, 4, 'U', '');
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testFollowsStraightLineLeft() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(8, 3, 'L', '');
        $newPosition = new Position(7, 3, 'L', '');
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testChangeDirection() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(14, 4, 'U', '');
        $newPosition = new Position(14, 3, 'L', '');
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testHasReachedEnd() {
        $grid = $this->getExampleGrid();
        $currentPosition = new Position(1, 3, 'L', '');
        $newPosition = new Position(1, 3, 'L', '', true);
        $gridNavigator = new Main();
        $this->assertEquals($newPosition, $gridNavigator->move($grid, $currentPosition));
    }

    public function testGetFullPath() {
        $grid = $this->getExampleGrid();
        $gridNavigator = new Main();
        $this->assertEquals('ABCDEF', $gridNavigator->runPartOne($grid));
    }

    public function testNumberSteps() {
        $grid = $this->getExampleGrid();
        $gridNavigator = new Main();
        $this->assertEquals(38, $gridNavigator->runPartTwo($grid));
    }

    /**
     * @return array
     */
    private function getExampleGrid(): array
    {
        $grid = [
            '     |',
            '     |  +--+',
            '     A  |  C',
            ' F---|----E|--+',
            '     |  |  |  D',
            '     +B-+  +--+',
        ];
        return $grid;
    }
}

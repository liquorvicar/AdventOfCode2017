<?php

namespace Liquorvicar\AdventOfCode\tests\Day21;

use Liquorvicar\AdventOfCode\Day21\Grid;
use Liquorvicar\AdventOfCode\Day21\Main;
use Liquorvicar\AdventOfCode\Day21\Rule;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $grid
     * @param $matches
     * @dataProvider dataForRuleMatches
     */
    public function testRuleMatches($grid, $matches) {
        $rule = new Rule('.#./..#/### => #..#/..../..../#..#');
        $this->assertEquals($matches, $rule->matches($grid));
    }

    public function dataForRuleMatches() {
        return [
            'exact match' => [new Grid(['.#.', '..#', '###']), true],
            'wrong pixel count' => [new Grid(['...', '..#', '###']), false],
            'wrong size' => [new Grid(['.#', '..']), false],
            'flipped left/right' => [new Grid(['.#.', '#..', '###']), true],
            'rotated 90 cw' => [new Grid(['#..', '#.#', '##.']), true],
            'rotated 90 anti cw' => [new Grid(['.##', '#.#', '..#']), true],
            'inverted up/down' => [new Grid(['###', '..#', '.#.']), true],
            'no match' => [new Grid(['#.#', '#.#', '.#.']), false],
            'rotated 180' => [new Grid(['###', '#..', '.#.']), true],
        ];
    }

    public function testProcessRules() {
        $rules = [
            new Rule('../.# => ##./#../...'),
            new Rule('.#./..#/### => #..#/..../..../#..#'),
        ];
        $program = [[new Grid(['.#.', '..#', '###'])]];
        $main = new Main();
        $expected = ['#..#', '....', '....', '#..#'];
        $this->assertEquals($expected, $main->process($program, $rules));
    }

    public function testProcessLargerGrid() {
        $rules = [
            new Rule('../.# => ##./#../...'),
            new Rule('.#./..#/### => #..#/..../..../#..#'),
        ];
        $program = [
            [new Grid(['#.', '..']), new Grid(['.#', '..'])],
            [new Grid(['..', '#.']), new Grid(['..', '.#'])],
        ];
        $main = new Main();
        $expected = ['##.##.', '#..#..', '......', '##.##.', '#..#..', '......'];
        $this->assertEquals($expected, $main->process($program, $rules));
    }

    public function testReGridSimpleGrid() {
        $processedGrid = ['#..#', '....', '....', '#..#'];
        $reGridded = [
            [new Grid(['#.', '..']), new Grid(['.#', '..'])],
            [new Grid(['..', '#.']), new Grid(['..', '.#'])],
        ];
        $main = new Main();
        $this->assertEquals($reGridded, $main->regrid($processedGrid));
    }

    public function testReGridGridSizedSix() {
        $processedGrid = ['.#..#.', '..#..#', '######', '.#..#.', '..#..#', '######'];
        $expectedGrid = [
            [new Grid(['.#', '..']), new Grid(['..', '#.']), new Grid(['#.', '.#'])],
            [new Grid(['##', '.#']), new Grid(['##', '..']), new Grid(['##', '#.'])],
            [new Grid(['..', '##']), new Grid(['#.', '##']), new Grid(['.#', '##'])],
        ];
        $main = new Main();
        $this->assertEquals($expectedGrid, $main->regrid($processedGrid));
    }

    public function testReGridGridSizedNine() {
        $processedGrid = ['.#..#.#..', '..#..#.#.', '#########', '.#..#...#', '..#..##..', '#########', '.#..#...#', '..#..##..', '#########'];
        $reGridded = [
            [new Grid(['.#.', '..#', '###']), new Grid(['.#.', '..#', '###']),new Grid(['#..', '.#.', '###']),],
            [new Grid(['.#.', '..#', '###']), new Grid(['.#.', '..#', '###']),new Grid(['..#', '#..', '###']),],
            [new Grid(['.#.', '..#', '###']), new Grid(['.#.', '..#', '###']),new Grid(['..#', '#..', '###']),],
        ];
        $main = new Main();
        $this->assertEquals($reGridded, $main->regrid($processedGrid));
    }

    public function testCountPixels() {
        $rules = [
            new Rule('../.# => ##./#../...'),
            new Rule('.#./..#/### => #..#/..../..../#..#'),
        ];
        $program = [[new Grid(['.#.', '..#', '###'])]];
        $main = new Main();
        $this->assertEquals(12, $main->countPixels($rules, $program, 2));
    }
}

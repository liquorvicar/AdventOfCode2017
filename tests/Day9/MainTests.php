<?php

namespace Liquorvicar\AdventOfCode\tests\Day9;

use Liquorvicar\AdventOfCode\Day9\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $input
     * @dataProvider dataForRemovesGarbage
     */
    public function testRemovesGarbage($input) {
        $stream = new Main();
        $this->assertEquals('abcd', $stream->removeGarbage($input)['clean']);
    }

    public function dataForRemovesGarbage() {
        return [
            ['ab<>cd'],
            ['ab<random characters>cd'],
            ['ab<<<<>cd'],
            ['ab<{!>}>cd'],
            ['ab<!!>cd'],
            ['ab<!!!>>cd'],
            ['ab<{o"i!a,<{i<a>cd'],
        ];
    }

    /**
     * @param $input
     * @param $numberOfGroups
     * @dataProvider dataForFindGroups
     */
    public function testFindGroups($input, $numberOfGroups) {
        $stream = new Main();
        $this->assertEquals($numberOfGroups, count($stream->parseGroups($input)));
    }

    public function dataForFindGroups() {
        return [
            ['{}', 1],
            ['{{{}}}', 3],
            ['{{},{}}', 3],
            ['{{{},{},{{}}}}', 6],
            ['{<{},{},{{}}>}', 1],
            ['{<a>,<a>,<a>,<a>}', 1],
            ['{{<a>},{<a>},{<a>},{<a>}}', 5],
            ['{{<!>},{<!>},{<!>},{<a>}}', 2],
        ];
    }

    /**
     * @param $input
     * @param $score
     * @dataProvider dataForGroupScore
     */
    public function testCountGroupScore($input, $score) {
        $stream = new Main();
        $this->assertEquals($score, $stream->runPartOne($input));
    }

    public function dataForGroupScore() {
        return [
            [['{}'], 1],
            [['{{{}}}'], 6],
            [['{{},{}}'], 5],
            [['{{{},{},{{}}}}'], 16],
            [['{<a>,<a>,<a>,<a>}'], 1],
            [['{{<ab>},{<ab>},{<ab>},{<ab>}}'], 9],
            [['{{<!!>},{<!!>},{<!!>},{<!!>}}'], 9],
            [['{{<a!>},{<a!>},{<a!>},{<ab>}}'], 3],
        ];
    }

    /**
     * @param $input
     * @param $count
     * @dataProvider dataForCountGarbage
     */
    public function testCountGarbage($input, $count) {
        $stream = new Main();
        $this->assertEquals($count, $stream->runPartTwo($input));
    }

    public function dataForCountGarbage() {
        return [
            [['<>'], 0],
            [['<random characters>'], 17],
            [['<<<<>'], 3],
            [['<{!>}>'], 2],
            [['<!!>'], 0],
            [['<!!!>>'], 0],
            [['<{o"i!a,<{i<a>'], 10],
        ];
    }
}

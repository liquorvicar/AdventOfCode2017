<?php

namespace Liquorvicar\AdventOfCode\tests\Day8;

use Liquorvicar\AdventOfCode\Day8\Main;
use Liquorvicar\AdventOfCode\Day8\Register;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase
{
    /**
     * @param $rawInstruction
     * @param $conditionValue
     * @param $expectedResult
     * @dataProvider dataForParsingInstructions
     */
    public function testParseInstructions($rawInstruction, $conditionValue, $expectedResult, $expectedTarget, $expectedConditional) {
        $parser = new Main();
        $parseResults = $parser->parse($rawInstruction);
        $instruction = $parseResults['instruction'];
        $target = new Register(0);
        $condition = new Register($conditionValue);
        $result = $instruction->run($target, $condition);
        $this->assertEquals($expectedResult, $result->value());
        $this->assertEquals($expectedTarget, $parseResults['target']);
        $this->assertEquals($expectedConditional, $parseResults['condition']);
    }

    public function dataForParsingInstructions() {
        return [
            [ 'b inc 5 if a > 1', 2, 5, 'b', 'a' ],
            [ 'a inc 1 if b < 5', 4, 1, 'a', 'b' ],
            [ 'c dec -10 if a >= 1', 1, 10, 'c', 'a' ],
            [ 'c inc -20 if c == 10', 10, -20, 'c', 'c' ],
            [ 'c dec 5 if a <= 2', 2, -5, 'c', 'a' ],
            [ 'c dec 6 if a != 2', 3, -6, 'c', 'a' ],
        ];
    }

    public function testPartOneSampleInput() {
        $parser = new Main();
        $input = [
            'b inc 5 if a > 1',
            'a inc 1 if b < 5',
            'c dec -10 if a >= 1',
            'c inc -20 if c == 10',
        ];
        $this->assertEquals(1, $parser->runPartOne($input));
    }

    public function testPartTwoSampleInput() {
        $parser = new Main();
        $input = [
            'b inc 5 if a > 1',
            'a inc 1 if b < 5',
            'c dec -10 if a >= 1',
            'c inc -20 if c == 10',
        ];
        $this->assertEquals(10, $parser->runPartTwo($input));
    }
}

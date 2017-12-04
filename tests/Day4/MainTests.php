<?php

namespace Liquorvicar\AdventOfCode\tests\Day4;

use Liquorvicar\AdventOfCode\Day4\Main;
use PHPUnit\Framework\TestCase;

class MainTests extends TestCase {

    /**
     * @param $passphrase
     * @param $numValidPhrases
     * @dataProvider dataForPassphrases
     */
    public function testPartOne($passphrase, $numValidPhrases) {
        $validator = new Main();
        $this->assertSame($numValidPhrases, $validator->runPartOne([$passphrase]));
    }

    public function dataForPassphrases() {
        return [
            ['aa bb cc dd ee', 1],
            ['aa bb cc dd aa', 0],
            ['aa bb cc dd aaa', 1],
        ];
    }

    /**
     * @param $passphrase
     * @param $numValidPhrases
     * @dataProvider dataForPartTwo
     */
    public function testPartTwo($passphrase, $numValidPhrases) {
        $validator = new Main();
        $this->assertSame($numValidPhrases, $validator->runPartTwo([$passphrase]));
    }

    public function dataForPartTwo() {
        return [
            ['abcde fghij', 1],
            ['abcde xyz ecdab', 0],
            ['a ab abc abd abf abj', 1],
            ['iiii oiii ooii oooi oooo', 1],
            ['oiii ioii iioi iiio', 0],
        ];
    }
}

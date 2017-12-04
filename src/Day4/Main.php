<?php

namespace Liquorvicar\AdventOfCode\Day4;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain {

    public function runPartOne(array $input)
    {
        $numValid = 0;
        foreach ($input as $index => $passphrase) {
            if ($this->validate(trim($passphrase))) {
                $numValid++;
            }
        }
        return $numValid;
    }

    public function runPartTwo(array $input)
    {
        $numValid = 0;
        foreach ($input as $index => $passphrase) {
            $passphrase = trim($passphrase);
            $passphrase = $this->sortWords($passphrase);
            if ($this->validate($passphrase)) {
                $numValid++;
            }
        }
        return $numValid;
    }

    /**
     * @param $passphrase
     * @return bool
     */
    private function validate($passphrase): bool
    {
        $words = explode(' ', $passphrase);
        sort($words);
        $uniqueWords = array_unique($words);
        return count($words) === count($uniqueWords);
    }

    private function sortWords($passphrase)
    {
        $words = explode(' ', $passphrase);
        $sortedWords = [];
        foreach ($words as $word) {
            $letters = str_split($word);
            sort($letters);
            $sortedWords[] = implode($letters);
        }
        return implode(' ', $sortedWords);
    }

}
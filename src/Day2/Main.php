<?php

namespace Liquorvicar\AdventOfCode\Day2;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function rowDiff(array $row) {
        sort($row);
        $max = array_pop($row);
        return $max - $row[0];
    }

    public function runPartOne(array $input)
    {
        $checksum = 0;
        foreach ($input as $rowString) {
            $row = $this->cleanUpRow($rowString);
            $checksum += $this->rowDiff($row);
        }
        return $checksum;
    }

    public function runPartTwo(array $input)
    {
        $checksum = 0;
        foreach ($input as $rowString) {
            $row = $this->cleanUpRow($rowString);
            $checksum += $this->evenDivides($row);
        }
        return $checksum;
    }

    public function evenDivides($row)
    {
        $length = count($row);
        sort($row);
        foreach ($row as $key => $number) {
            if ($key >= ($length - 1)) {
                break;
            }
            for ($target = ($key + 1); $target < $length; $target++) {
                if ($row[$target] % $row[$key] === 0) {
                    return $row[$target] / $row[$key];
                }
            }
        }
        return 0;
    }

    /**
     * @param $rowString
     * @return array
     */
    protected function cleanUpRow($rowString): array
    {
        $rowString = str_replace("\t", ' ', $rowString);
        $row = explode(' ', $rowString);
        $row = array_map(function ($number) {
            return (int)trim($number);
        }, $row);
        return $row;
    }
}
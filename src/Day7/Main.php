<?php

namespace Liquorvicar\AdventOfCode\Day7;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function findBottomDisc($programs)
    {
        $isBalancing = array_filter($programs, function (Program $program) {
            return !empty($program->isBalancing());
        });
        $isBalanced = array_reduce($programs, function ($isBalanced, Program $program) {
            return array_merge($isBalanced, $program->isBalancing());
        }, []);
        $bottomProgram = array_diff($isBalancing, $isBalanced);
        return array_shift($bottomProgram);
    }

    public function runPartOne(array $input)
    {
        $programs = $this->parsePrograms($input);
        return $this->findBottomDisc($programs);
    }

    public function runPartTwo(array $input)
    {
        $programs = $this->parsePrograms($input);
        $bottomDisc = $this->findBottomDisc($programs);
        return $this->balancedWeight($bottomDisc, $programs, 0);
    }

    /**
     * @param $input
     * @return array
     */
    protected function parsePrograms($input): array
    {
        $programs = [];
        foreach ($input as $reportedRow) {
            $programsRaw = explode('->', $reportedRow);
            $balancingParts = explode('(', $programsRaw[0]);
            $name = trim($balancingParts[0]);
            $weight = trim(str_replace(')', '', $balancingParts[1]));
            $balancedParts = [];
            if (isset($programsRaw[1])) {
                $balancedParts = explode(',', $programsRaw[1]);
                $balancedParts = array_map('trim', $balancedParts);
            }
            $programs[$name] = new Program($name, $weight, $balancedParts);
        }
        return $programs;
    }

    /**
     * @param Program $disc
     * @param Program[] $programs
     * @param $weightDiff
     * @return int
     */
    private function balancedWeight(Program $disc, $programs, $weightDiff)
    {
        if (empty($disc->isBalancing())) {
            return 0;
        }
        $balancedDiscs = $disc->isBalancing();
        $balancedDiscsWeight = array_map(function ($programName) use ($programs) {
            return $programs[$programName]->weight($programs);
        }, $balancedDiscs);
        if (count(array_unique($balancedDiscsWeight)) === 1) {
            return $disc->ownWeight() + $weightDiff;
        }
        sort($balancedDiscsWeight);
        if ($balancedDiscsWeight[0] !== $balancedDiscsWeight[1]) {
            $unbalanced = $balancedDiscsWeight[0];
        } else {
            $unbalanced = array_pop($balancedDiscsWeight);
        }
        $weightDiff = $balancedDiscsWeight[1] - $unbalanced;
        $unbalancedDisc = array_filter($balancedDiscs, function ($programName) use ($programs, $unbalanced) {
            return $programs[$programName]->weight($programs) === $unbalanced;
        });
        return $this->balancedWeight($programs[array_pop($unbalancedDisc)], $programs, $weightDiff);
    }

}
<?php

namespace Liquorvicar\AdventOfCode\Day13;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{
    public function runPartOne(array $input)
    {
        $config = $this->configureInput($input);
        $firewall = new Firewall($config);
        return $firewall->severity();
    }

    public function runPartTwo(array $input)
    {
        return $this->findClearRun($input);
    }

    /**
     * @param array $input
     * @return array
     */
    protected function configureInput(array $input)
    {
        $config = [];
        foreach ($input as $inputString) {
            $layerData = explode(':', $inputString);
            $config[(int)trim($layerData[0])] = (int)trim($layerData[1]);
        }
        return $config;
    }

    public function findClearRun($input) {
        $config = $this->configureInput($input);
        $delay = 0;
        $caught = true;
        while ($caught) {
            $caught = false;
            foreach ($config as $layer => $depth) {
                if ((($delay + $layer) % (($depth -1) * 2)) === 0) {
                    $caught = true;
                    break;
                }
            }
            if ($caught) {
                $delay++;
            }
        }
        return $delay;
    }
}


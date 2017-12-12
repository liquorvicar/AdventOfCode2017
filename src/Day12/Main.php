<?php

namespace Liquorvicar\AdventOfCode\Day12;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $connections = $this->findAllConnections($input);
        return count($this->findLinkedPipes($connections, 0));
    }

    public function runPartTwo(array $input)
    {
        $groups = 0;
        $connections = $this->findAllConnections($input);
        while (count($connections) > 0) {
            $pipe = key($connections);
            $group = $this->findLinkedPipes($connections, $pipe);
            $groups++;
            foreach ($group as $member) {
                unset($connections[$member]);
            }
        }
        return $groups;
    }

    public function findAllConnections($input)
    {
        $connections = [];
        foreach ($input as $connectionString) {
            $connectionParts = explode('<->', $connectionString);
            $lhs = (int)trim($connectionParts[0]);
            $rhs = array_map(function ($element) {
                return (int)trim($element);
            }, explode(',', $connectionParts[1]));
            if (!isset($connections[$lhs])) {
                $connections[$lhs] = [];
            }
            $connections[$lhs] = array_merge($connections[$lhs], $rhs);
            foreach ($rhs as $pipe) {
                if (!isset($connections[$pipe])) {
                    $connections[$pipe] = [];
                }
                $connections[$pipe][] = $lhs;
            }
        }
        return array_map(function ($element) {
            return array_values(array_unique($element));
        }, $connections);
    }

    public function findLinkedPipes($connections, $int)
    {
        $linked = [];
        $allFound = false;
        while (!$allFound) {
            $allFound = true;
            foreach ($connections as $pipe => $connectedPipes) {
                if ($pipe === $int || in_array($pipe, $linked)) {
                    $new = array_diff($connectedPipes, $linked);
                    if (count($new) > 0) {
                        $allFound = false;
                    }
                    $linked = array_merge($linked, $new);
                }
            }
            $linked = array_unique($linked);
        }
        return $linked;
    }
}
<?php

namespace Liquorvicar\AdventOfCode\Day24;

use Liquorvicar\AdventOfCode\IMain;

class Main implements IMain
{

    public function runPartOne(array $input)
    {
        $pipes = $this->parsePipes($input);
        $bridges = $this->findPossibleBridges(0, [], $pipes, []);
        return $this->findStrongestBridge($bridges);
    }

    public function runPartTwo(array $input)
    {
        // TODO: Implement runPartTwo() method.
    }

    public function findZeros($pipes)
    {
        return $this->matchingPipes($pipes, 0);
    }

    public function parsePipes($rawPipes)
    {
        $pipes = array_map(function ($string) {
            $ports = explode('/', $string);
            $ports = array_map(function ($element) {
                return (int)$element;
            }, $ports);
            sort($ports);
            return $ports;
        }, $rawPipes);
        return $pipes;
    }

    public function matchingPipes($pipes, $numPorts)
    {
        return array_filter($pipes, function ($pipe) use ($numPorts) {
            return array_search($numPorts, $pipe) !== false;
        });
    }

    public function findBridges($pipes)
    {
        $strength = 0;
        $zeros = $this->findZeros($pipes);
        $nonZeros = $pipes;
        foreach ($zeros as $id => $zero) {
            unset($nonZeros[$id]);
        }
        foreach ($zeros as $pipe) {
            echo 'Starting with ' . implode('/', $pipe) . PHP_EOL;
            $thisBridge = [$pipe];
            $openPort = $this->findOpenPort($pipe, 0);
            $strength = $this->findPossibleBridges($openPort, $thisBridge, $nonZeros, $strength);
        }
        return $strength;
    }

    private function findPossibleBridges($port, $currentBridge, $pipes, $bridges)
    {
        $matchingPipes = $this->matchingPipes($pipes, $port);
        if (empty($matchingPipes)) {
            if (empty($bridges) || count($currentBridge) > count($bridges[0])) {
                echo 'Found ' . implode('--', array_map(function ($bridge) {
                        return implode('/', $bridge);
                    }, $currentBridge)) . PHP_EOL;
                $bridges = [$currentBridge];
            } elseif (count($currentBridge) === count($bridges[0])) {
                $bridges[] = $currentBridge;
            }
            return $bridges;
        }
        foreach ($matchingPipes as $id => $matchingPipe) {
            $thisBridge = $currentBridge;
            $thisBridge[] = $matchingPipe;
            $remainingPipes = $pipes;
            unset($remainingPipes[$id]);
            $openPort = $this->findOpenPort($matchingPipe, $port);
            $bridges = $this->findPossibleBridges($openPort, $thisBridge, $remainingPipes, $bridges);
        }
        return $bridges;
    }

    /**
     * @param $pipe
     * @return int
     */
    private function findOpenPort($pipe, $closedPort): int
    {
        $openPort = array_filter($pipe, function ($port) use ($closedPort) {
            return $port <> $closedPort;
        });
        return !empty($openPort) ? reset($openPort) : $closedPort;
    }

    public function findStrongestBridge($bridges)
    {
        return array_reduce($bridges, function ($strongest, $bridge) {

            $strength = $this->findBridgeStrength($bridge);
            return $strength > $strongest ? $strength : $strongest;
        }, 0);
    }
    /**
     * @param $bridge
     * @return mixed
     */
    public function findBridgeStrength($bridge): int
    {
        $strength = array_reduce($bridge, function ($sum, $pipe) {
            foreach ($pipe as $port) {
                $sum += $port;
            }
            return $sum;
        }, 0);
        return $strength;
    }
}


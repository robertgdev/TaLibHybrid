<?php

declare(strict_types=1);

function generateClose(int $count = 100, int $seed = 42): array
{
    srand($seed);
    $close = [];
    $v = 44.0;
    for ($i = 0; $i < $count; $i++) {
        $v += (sin($i * 0.3) * 0.15 + (rand(0, 100) - 50) / 200.0);
        $close[] = round($v, 2);
    }

    return $close;
}

function generateOHLCV(int $count = 100, int $seed = 42): array
{
    srand($seed);
    $close = [];
    $v = 44.0;
    for ($i = 0; $i < $count; $i++) {
        $v += (sin($i * 0.3) * 0.15 + (rand(0, 100) - 50) / 200.0);
        $close[] = round($v, 2);
    }
    $high = array_map(fn ($c) => round($c + abs(sin($count * 0.1)) * 0.1 + 0.02, 2), $close);
    $low = array_map(fn ($c) => round($c - abs(cos($count * 0.1)) * 0.1 - 0.02, 2), $close);
    $open = array_map(fn ($c) => round($c + (rand(0, 100) - 50) / 500.0, 2), $close);
    $volume = array_map(fn () => rand(100, 10000), $close);

    return [$open, $high, $low, $close, $volume];
}

function countNonNull(array $arr): int
{
    return count(array_filter($arr, fn ($v) => $v !== null));
}

function arraysMatch(array $a, array $b, float $tolerance = 0.01): bool
{
    if (count($a) !== count($b)) {
        return false;
    }
    foreach ($a as $i => $v) {
        if ($v === null && $b[$i] === null) {
            continue;
        }
        if ($v === null || $b[$i] === null) {
            return false;
        }
        if (abs($v - $b[$i]) > $tolerance) {
            return false;
        }
    }

    return true;
}

function multiOutputArraysMatch(array $a, array $b, float $tolerance = 0.01): bool
{
    if (array_keys($a) !== array_keys($b)) {
        return false;
    }
    foreach (array_keys($a) as $key) {
        if (! arraysMatch($a[$key], $b[$key], $tolerance)) {
            return false;
        }
    }

    return true;
}

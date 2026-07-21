<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Fallback\Core;

use RobertGDev\TaLibHybrid\Enum\ReturnCode;

class PriceTransform extends Core
{
    /**
     * @param array<int, float|int|null> $inOpen
     * @param array<int, float|int|null> $inHigh
     * @param array<int, float|int|null> $inLow
     * @param array<int, float|int|null> $inClose
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function avgPrice(int $startIdx, int $endIdx, array $inOpen, array $inHigh, array $inLow, array $inClose, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outIdx = 0;
        for ($i = $startIdx; $i <= $endIdx; $i++) {
            $outReal[$outIdx++] = ($inHigh[$i] + $inLow[$i] + $inClose[$i] + $inOpen[$i]) / 4;
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inHigh
     * @param array<int, float|int|null> $inLow
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function medPrice(int $startIdx, int $endIdx, array $inHigh, array $inLow, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outIdx = 0;
        for ($i = $startIdx; $i <= $endIdx; $i++) {
            $outReal[$outIdx++] = ($inHigh[$i] + $inLow[$i]) / 2.0;
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inHigh
     * @param array<int, float|int|null> $inLow
     * @param array<int, float|int|null> $inClose
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function typPrice(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outIdx = 0;
        for ($i = $startIdx; $i <= $endIdx; $i++) {
            $outReal[$outIdx++] = ($inHigh[$i] +
                                   $inLow[$i] +
                                   $inClose[$i]) / 3.0;
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inHigh
     * @param array<int, float|int|null> $inLow
     * @param array<int, float|int|null> $inClose
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function wclPrice(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outIdx = 0;
        for ($i = $startIdx; $i <= $endIdx; $i++) {
            $outReal[$outIdx++] = ($inHigh[$i] +
                                   $inLow[$i] +
                                   ($inClose[$i] * 2.0)) / 4.0;
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }
}

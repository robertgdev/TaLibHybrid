<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Fallback\Core;

use RobertGDev\TaLibHybrid\Enum\ReturnCode;

class MathOperators extends Core
{
    /**
     * @param array<int, float|int|null> $inReal0
     * @param array<int, float|int|null> $inReal1
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function add(int $startIdx, int $endIdx, array $inReal0, array $inReal1, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        for ($i = $startIdx, $outIdx = 0; $i <= $endIdx; $i++, $outIdx++) {
            $outReal[$outIdx] = $inReal0[$i] + $inReal1[$i];
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal0
     * @param array<int, float|int|null> $inReal1
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function div(int $startIdx, int $endIdx, array $inReal0, array $inReal1, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        for ($i = $startIdx, $outIdx = 0; $i <= $endIdx; $i++, $outIdx++) {
            $outReal[$outIdx] = $inReal0[$i] / $inReal1[$i];
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function max(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $nbInitialElementNeeded = ($optInTimePeriod - 1);
        if ($startIdx < $nbInitialElementNeeded) {
            $startIdx = $nbInitialElementNeeded;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        $trailingIdx = $startIdx - $nbInitialElementNeeded;
        $highestIdx = -1;
        $highest = 0.0;
        while ($today <= $endIdx) {
            $tmp = $inReal[$today];
            if ($highestIdx < $trailingIdx) {
                $highestIdx = $trailingIdx;
                $highest = $inReal[$highestIdx];
                $i = $highestIdx;
                while (++$i <= $today) {
                    $tmp = $inReal[$i];
                    if ($tmp > $highest) {
                        $highestIdx = $i;
                        $highest = $tmp;
                    }
                }
            } elseif ($tmp >= $highest) {
                $highestIdx = $today;
                $highest = $tmp;
            }
            $outReal[$outIdx++] = $highest;
            $trailingIdx++;
            $today++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outInteger
     * @return int
     */
    public static function maxIndex(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outInteger): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $nbInitialElementNeeded = ($optInTimePeriod - 1);
        if ($startIdx < $nbInitialElementNeeded) {
            $startIdx = $nbInitialElementNeeded;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        $trailingIdx = $startIdx - $nbInitialElementNeeded;
        $highestIdx = -1;
        $highest = 0.0;
        while ($today <= $endIdx) {
            $tmp = $inReal[$today];
            if ($highestIdx < $trailingIdx) {
                $highestIdx = $trailingIdx;
                $highest = $inReal[$highestIdx];
                $i = $highestIdx;
                while (++$i <= $today) {
                    $tmp = $inReal[$i];
                    if ($tmp > $highest) {
                        $highestIdx = $i;
                        $highest = $tmp;
                    }
                }
            } elseif ($tmp >= $highest) {
                $highestIdx = $today;
                $highest = $tmp;
            }
            $outInteger[$outIdx++] = $highestIdx;
            $trailingIdx++;
            $today++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function min(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $nbInitialElementNeeded = ($optInTimePeriod - 1);
        if ($startIdx < $nbInitialElementNeeded) {
            $startIdx = $nbInitialElementNeeded;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        $trailingIdx = $startIdx - $nbInitialElementNeeded;
        $lowestIdx = -1;
        $lowest = 0.0;
        while ($today <= $endIdx) {
            $tmp = $inReal[$today];
            if ($lowestIdx < $trailingIdx) {
                $lowestIdx = $trailingIdx;
                $lowest = $inReal[$lowestIdx];
                $i = $lowestIdx;
                while (++$i <= $today) {
                    $tmp = $inReal[$i];
                    if ($tmp < $lowest) {
                        $lowestIdx = $i;
                        $lowest = $tmp;
                    }
                }
            } elseif ($tmp <= $lowest) {
                $lowestIdx = $today;
                $lowest = $tmp;
            }
            $outReal[$outIdx++] = $lowest;
            $trailingIdx++;
            $today++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outInteger
     * @return int
     */
    public static function minIndex(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outInteger): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $nbInitialElementNeeded = ($optInTimePeriod - 1);
        if ($startIdx < $nbInitialElementNeeded) {
            $startIdx = $nbInitialElementNeeded;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        $trailingIdx = $startIdx - $nbInitialElementNeeded;
        $lowestIdx = -1;
        $lowest = 0.0;
        while ($today <= $endIdx) {
            $tmp = $inReal[$today];
            if ($lowestIdx < $trailingIdx) {
                $lowestIdx = $trailingIdx;
                $lowest = $inReal[$lowestIdx];
                $i = $lowestIdx;
                while (++$i <= $today) {
                    $tmp = $inReal[$i];
                    if ($tmp < $lowest) {
                        $lowestIdx = $i;
                        $lowest = $tmp;
                    }
                }
            } elseif ($tmp <= $lowest) {
                $lowestIdx = $today;
                $lowest = $tmp;
            }
            $outInteger[$outIdx++] = $lowestIdx;
            $trailingIdx++;
            $today++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outMin
     * @param  array<int, float|int|null> $outMax
     * @return int
     */
    public static function minMax(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outMin, array &$outMax): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $nbInitialElementNeeded = ($optInTimePeriod - 1);
        if ($startIdx < $nbInitialElementNeeded) {
            $startIdx = $nbInitialElementNeeded;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        $trailingIdx = $startIdx - $nbInitialElementNeeded;
        $highestIdx = -1;
        $highest = 0.0;
        $lowestIdx = -1;
        $lowest = 0.0;
        while ($today <= $endIdx) {
            $tmpLow = $tmpHigh = $inReal[$today];
            if ($highestIdx < $trailingIdx) {
                $highestIdx = $trailingIdx;
                $highest = $inReal[$highestIdx];
                $i = $highestIdx;
                while (++$i <= $today) {
                    $tmpHigh = $inReal[$i];
                    if ($tmpHigh > $highest) {
                        $highestIdx = $i;
                        $highest = $tmpHigh;
                    }
                }
            } elseif ($tmpHigh >= $highest) {
                $highestIdx = $today;
                $highest = $tmpHigh;
            }
            if ($lowestIdx < $trailingIdx) {
                $lowestIdx = $trailingIdx;
                $lowest = $inReal[$lowestIdx];
                $i = $lowestIdx;
                while (++$i <= $today) {
                    $tmpLow = $inReal[$i];
                    if ($tmpLow < $lowest) {
                        $lowestIdx = $i;
                        $lowest = $tmpLow;
                    }
                }
            } elseif ($tmpLow <= $lowest) {
                $lowestIdx = $today;
                $lowest = $tmpLow;
            }
            $outMax[$outIdx] = $highest;
            $outMin[$outIdx] = $lowest;
            $outIdx++;
            $trailingIdx++;
            $today++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outMinIdx
     * @param  array<int, float|int|null> $outMaxIdx
     * @return int
     */
    public static function minMaxIndex(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outMinIdx, array &$outMaxIdx): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $nbInitialElementNeeded = ($optInTimePeriod - 1);
        if ($startIdx < $nbInitialElementNeeded) {
            $startIdx = $nbInitialElementNeeded;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        $trailingIdx = $startIdx - $nbInitialElementNeeded;
        $highestIdx = -1;
        $highest = 0.0;
        $lowestIdx = -1;
        $lowest = 0.0;
        while ($today <= $endIdx) {
            $tmpLow = $tmpHigh = $inReal[$today];
            if ($highestIdx < $trailingIdx) {
                $highestIdx = $trailingIdx;
                $highest = $inReal[$highestIdx];
                $i = $highestIdx;
                while (++$i <= $today) {
                    $tmpHigh = $inReal[$i];
                    if ($tmpHigh > $highest) {
                        $highestIdx = $i;
                        $highest = $tmpHigh;
                    }
                }
            } elseif ($tmpHigh >= $highest) {
                $highestIdx = $today;
                $highest = $tmpHigh;
            }
            if ($lowestIdx < $trailingIdx) {
                $lowestIdx = $trailingIdx;
                $lowest = $inReal[$lowestIdx];
                $i = $lowestIdx;
                while (++$i <= $today) {
                    $tmpLow = $inReal[$i];
                    if ($tmpLow < $lowest) {
                        $lowestIdx = $i;
                        $lowest = $tmpLow;
                    }
                }
            } elseif ($tmpLow <= $lowest) {
                $lowestIdx = $today;
                $lowest = $tmpLow;
            }
            $outMaxIdx[$outIdx] = $highestIdx;
            $outMinIdx[$outIdx] = $lowestIdx;
            $outIdx++;
            $trailingIdx++;
            $today++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal0
     * @param array<int, float|int|null> $inReal1
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function mult(int $startIdx, int $endIdx, array $inReal0, array $inReal1, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        for ($i = $startIdx, $outIdx = 0; $i <= $endIdx; $i++, $outIdx++) {
            $outReal[$outIdx] = $inReal0[$i] * $inReal1[$i];
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal0
     * @param array<int, float|int|null> $inReal1
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function sub(int $startIdx, int $endIdx, array $inReal0, array $inReal1, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        for ($i = $startIdx, $outIdx = 0; $i <= $endIdx; $i++, $outIdx++) {
            $outReal[$outIdx] = $inReal0[$i] - $inReal1[$i];
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }

    /**
     * @param array<int, float|int|null> $inReal
     * @param  array<int, float|int|null> $outReal
     * @return int
     */
    public static function sum(int $startIdx, int $endIdx, array $inReal, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 30;
        } elseif (($optInTimePeriod < 2) || ($optInTimePeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        $lookbackTotal = ($optInTimePeriod - 1);
        if ($startIdx < $lookbackTotal) {
            $startIdx = $lookbackTotal;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $periodTotal = 0;
        $trailingIdx = $startIdx - $lookbackTotal;
        $i = $trailingIdx;
        while ($i < $startIdx) {
            $periodTotal += $inReal[$i++];
        }
        $outIdx = 0;
        do {
            $periodTotal += $inReal[$i++];
            $tempReal = $periodTotal;
            $periodTotal -= $inReal[$trailingIdx++];
            $outReal[$outIdx++] = $tempReal;
        } while ($i <= $endIdx);
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }
}

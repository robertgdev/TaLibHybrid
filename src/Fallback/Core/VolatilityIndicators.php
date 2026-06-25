<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Fallback\Core;

use RobertGDev\TaLibHybrid\Enum\FuncUnstId;
use RobertGDev\TaLibHybrid\Enum\ReturnCode;

class VolatilityIndicators extends Core
{
    public static function atr(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outBegIdx1 = 0;
        $outNbElement1 = 0;
        $prevATRTemp = static::double(1);
        if ($optInTimePeriod === PHP_INT_MIN) {
            $optInTimePeriod = 14;
        } elseif ($optInTimePeriod < 1 || $optInTimePeriod > 100000) {
            return ReturnCode::BadParam->value;
        }
        $outBegIdx = 0;
        $outNBElement = 0;
        $lookbackTotal = Lookback::atrLookback($optInTimePeriod);
        if ($startIdx < $lookbackTotal) {
            $startIdx = $lookbackTotal;
        }
        if ($startIdx > $endIdx) {
            return ReturnCode::Success->value;
        }
        if ($optInTimePeriod <= 1) {
            return self::trueRange(
                $startIdx,
                $endIdx,
                $inHigh,
                $inLow,
                $inClose,
                $outBegIdx,
                $outNBElement,
                $outReal
            );
        }
        $tempBuffer = static::double($lookbackTotal + ($endIdx - $startIdx) + 1);
        $retCode = self::trueRange(
            $startIdx - $lookbackTotal + 1,
            $endIdx,
            $inHigh,
            $inLow,
            $inClose,
            $outBegIdx1,
            $outNbElement1,
            $tempBuffer
        );
        if ($retCode !== ReturnCode::Success->value) {
            return $retCode;
        }
        $retCode = static::TA_INT_SMA(
            $optInTimePeriod - 1,
            $optInTimePeriod - 1,
            $tempBuffer,
            $optInTimePeriod,
            $outBegIdx1,
            $outNbElement1,
            $prevATRTemp
        );
        if ($retCode !== ReturnCode::Success->value) {
            return $retCode;
        }
        $prevATR = $prevATRTemp[0];
        $today = $optInTimePeriod;
        $outIdx = static::$unstablePeriod[FuncUnstId::ATR->value];
        while ($outIdx > 0) {
            $prevATR *= $optInTimePeriod - 1;
            $prevATR += $tempBuffer[$today++];
            $prevATR /= $optInTimePeriod;
            $outIdx--;
        }
        $outIdx = 0;
        $outReal[$outIdx++] = $prevATR;
        $nbATR = $endIdx - $startIdx + 1;
        while (--$nbATR > 0) {
            $prevATR *= $optInTimePeriod - 1;
            $prevATR += $tempBuffer[$today++];
            $prevATR /= $optInTimePeriod;
            $outReal[$outIdx++] = $prevATR;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    public static function natr(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outBegIdx1 = 0;
        $outNbElement1 = 0;
        $prevATRTemp = static::double(1);
        if ($optInTimePeriod === PHP_INT_MIN) {
            $optInTimePeriod = 14;
        } elseif ($optInTimePeriod < 1 || $optInTimePeriod > 100000) {
            return ReturnCode::BadParam->value;
        }
        $outBegIdx = 0;
        $outNBElement = 0;
        $lookbackTotal = Lookback::natrLookback($optInTimePeriod);
        if ($startIdx < $lookbackTotal) {
            $startIdx = $lookbackTotal;
        }
        if ($startIdx > $endIdx) {
            return ReturnCode::Success->value;
        }
        if ($optInTimePeriod <= 1) {
            return self::trueRange(
                $startIdx,
                $endIdx,
                $inHigh,
                $inLow,
                $inClose,
                $outBegIdx,
                $outNBElement,
                $outReal
            );
        }
        $tempBuffer = static::double($lookbackTotal + ($endIdx - $startIdx) + 1);
        $retCode = self::trueRange(
            $startIdx - $lookbackTotal + 1,
            $endIdx,
            $inHigh,
            $inLow,
            $inClose,
            $outBegIdx1,
            $outNbElement1,
            $tempBuffer
        );
        if ($retCode !== ReturnCode::Success->value) {
            return $retCode;
        }
        $retCode = static::TA_INT_SMA(
            $optInTimePeriod - 1,
            $optInTimePeriod - 1,
            $tempBuffer,
            $optInTimePeriod,
            $outBegIdx1,
            $outNbElement1,
            $prevATRTemp
        );
        if ($retCode !== ReturnCode::Success->value) {
            return $retCode;
        }
        $prevATR = $prevATRTemp[0];
        $today = $optInTimePeriod;
        $outIdx = static::$unstablePeriod[FuncUnstId::NATR->value];
        while ($outIdx > 0) {
            $prevATR *= $optInTimePeriod - 1;
            $prevATR += $tempBuffer[$today++];
            $prevATR /= $optInTimePeriod;
            $outIdx--;
        }
        $outIdx = 1;
        $tempValue = $inClose[$today];
        if (! ($tempValue > -0.00000001 && $tempValue < 0.00000001)) {
            $outReal[0] = $prevATR / $tempValue * 100.0;
        } else {
            $outReal[0] = 0.0;
        }
        $nbATR = $endIdx - $startIdx + 1;
        while (--$nbATR > 0) {
            $prevATR *= $optInTimePeriod - 1;
            $prevATR += $tempBuffer[$today++];
            $prevATR /= $optInTimePeriod;
            $tempValue = $inClose[$today];
            if (! ($tempValue > -0.00000001 && $tempValue < 0.00000001)) {
                $outReal[$outIdx] = $prevATR / $tempValue * 100.0;
            } else {
                $outReal[$outIdx] = 0.0;
            }
            $outIdx++;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return $retCode;
    }

    public static function trueRange(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($startIdx < 1) {
            $startIdx = 1;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outIdx = 0;
        $today = $startIdx;
        while ($today <= $endIdx) {
            $tempLT = $inLow[$today];
            $tempHT = $inHigh[$today];
            $tempCY = $inClose[$today - 1];
            $greatest = $tempHT - $tempLT;
            $val2 = abs($tempCY - $tempHT);
            if ($val2 > $greatest) {
                $greatest = $val2;
            }
            $val3 = abs($tempCY - $tempLT);
            if ($val3 > $greatest) {
                $greatest = $val3;
            }
            $outReal[$outIdx++] = $greatest;
            $today++;
        }
        $outNBElement = $outIdx;
        $outBegIdx = $startIdx;

        return ReturnCode::Success->value;
    }
}

<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Fallback\Core;

use RobertGDev\TaLibHybrid\Enum\FuncUnstId;
use RobertGDev\TaLibHybrid\Enum\ReturnCode;

class VolumeIndicators extends Core
{
    public static function ad(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, array $inVolume, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $nbBar = $endIdx - $startIdx + 1;
        $outNBElement = $nbBar;
        $outBegIdx = $startIdx;
        $currentBar = $startIdx;
        $outIdx = 0;
        $ad = 0.0;
        while ($nbBar !== 0) {
            $high = $inHigh[$currentBar];
            $low = $inLow[$currentBar];
            $tmp = $high - $low;
            $close = $inClose[$currentBar];
            if ($tmp > 0.0) {
                $ad += ((($close - $low) - ($high - $close)) / $tmp) * ((float) $inVolume[$currentBar]);
            }
            $outReal[$outIdx++] = $ad;
            $currentBar++;
            $nbBar--;
        }

        return ReturnCode::Success->value;
    }

    public static function adOsc(
        int $startIdx,
        int $endIdx,
        array $inHigh,
        array $inLow,
        array $inClose,
        array $inVolume,
        int $optInFastPeriod,
        int $optInSlowPeriod,
        int &$outBegIdx,
        int &$outNBElement,
        array &$outReal
    ): int {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        if ($optInFastPeriod === (PHP_INT_MIN)) {
            $optInFastPeriod = 3;
        } elseif (($optInFastPeriod < 2) || ($optInFastPeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        if ($optInSlowPeriod === (PHP_INT_MIN)) {
            $optInSlowPeriod = 10;
        } elseif (($optInSlowPeriod < 2) || ($optInSlowPeriod > 100000)) {
            return ReturnCode::BadParam->value;
        }
        if ($optInFastPeriod < $optInSlowPeriod) {
            $slowestPeriod = $optInSlowPeriod;
        } else {
            $slowestPeriod = $optInFastPeriod;
        }
        $lookbackTotal = Lookback::emaLookback($slowestPeriod);
        if ($startIdx < $lookbackTotal) {
            $startIdx = $lookbackTotal;
        }
        if ($startIdx > $endIdx) {
            $outBegIdx = 0;
            $outNBElement = 0;

            return ReturnCode::Success->value;
        }
        $outBegIdx = $startIdx;
        $today = $startIdx - $lookbackTotal;
        $ad = 0.0;
        $fastK = (2.0 / ((float) ($optInFastPeriod + 1)));
        $one_minus_fastK = 1.0 - $fastK;
        $slowK = (2.0 / ((float) ($optInSlowPeriod + 1)));
        $one_minus_slowK = 1.0 - $slowK;

        $high = $inHigh[$today];
        $low = $inLow[$today];
        $tmp = $high - $low;
        $close = $inClose[$today];
        if ($tmp > 0.0) {
            $ad += ((($close - $low) - ($high - $close)) / $tmp) * ((float) $inVolume[$today]);
        }
        $today++;

        $fastEMA = $ad;
        $slowEMA = $ad;
        while ($today < $startIdx) {

            $high = $inHigh[$today];
            $low = $inLow[$today];
            $tmp = $high - $low;
            $close = $inClose[$today];
            if ($tmp > 0.0) {
                $ad += ((($close - $low) - ($high - $close)) / $tmp) * ((float) $inVolume[$today]);
            }
            $today++;

            $fastEMA = ($fastK * $ad) + ($one_minus_fastK * $fastEMA);
            $slowEMA = ($slowK * $ad) + ($one_minus_slowK * $slowEMA);
        }
        $outIdx = 0;
        while ($today <= $endIdx) {

            $high = $inHigh[$today];
            $low = $inLow[$today];
            $tmp = $high - $low;
            $close = $inClose[$today];
            if ($tmp > 0.0) {
                $ad += ((($close - $low) - ($high - $close)) / $tmp) * ((float) $inVolume[$today]);
            }
            $today++;

            $fastEMA = ($fastK * $ad) + ($one_minus_fastK * $fastEMA);
            $slowEMA = ($slowK * $ad) + ($one_minus_slowK * $slowEMA);
            $outReal[$outIdx++] = $fastEMA - $slowEMA;
        }
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }

    public static function atr(int $startIdx, int $endIdx, array $inHigh, array $inLow, array $inClose, int $optInTimePeriod, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $outBegIdx1 = 0;
        $outNbElement1 = 0;
        $prevATRTemp = static::double(1);
        if ($optInTimePeriod === (PHP_INT_MIN)) {
            $optInTimePeriod = 14;
        } elseif (($optInTimePeriod < 1) || ($optInTimePeriod > 100000)) {
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
            return VolatilityIndicators::trueRange($startIdx, $endIdx, $inHigh, $inLow, $inClose, $outBegIdx, $outNBElement, $outReal);
        }
        $tempBuffer = static::double($lookbackTotal + ($endIdx - $startIdx) + 1);
        $retCode = VolatilityIndicators::trueRange(($startIdx - $lookbackTotal + 1), $endIdx, $inHigh, $inLow, $inClose, $outBegIdx1, $outNbElement1, $tempBuffer);
        if ($retCode !== ReturnCode::Success->value) {
            return $retCode;
        }
        $retCode = static::TA_INT_SMA($optInTimePeriod - 1, $optInTimePeriod - 1, $tempBuffer, $optInTimePeriod, $outBegIdx1, $outNbElement1, $prevATRTemp);
        if ($retCode !== ReturnCode::Success->value) {
            return $retCode;
        }
        $prevATR = $prevATRTemp[0];
        $today = $optInTimePeriod;
        $outIdx = (static::$unstablePeriod[FuncUnstId::ATR->value]);
        while ($outIdx > 0) {
            $prevATR *= $optInTimePeriod - 1;
            $prevATR += $tempBuffer[$today++];
            $prevATR /= $optInTimePeriod;
            $outIdx--;
        }
        $outIdx = 1;
        $outReal[0] = $prevATR;
        $nbATR = ($endIdx - $startIdx) + 1;
        while (--$nbATR > 0) {
            $prevATR *= $optInTimePeriod - 1;
            $prevATR += $tempBuffer[$today++];
            $prevATR /= $optInTimePeriod;
            $outReal[$outIdx++] = $prevATR;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return $retCode;
    }

    public static function obv(int $startIdx, int $endIdx, array $inReal, array &$inVolume, int &$outBegIdx, int &$outNBElement, array &$outReal): int
    {
        if ($RetCode = static::validateStartEndIndexes($startIdx, $endIdx)) {
            return $RetCode;
        }
        $prevOBV = $inVolume[$startIdx];
        $prevReal = $inReal[$startIdx];
        $outIdx = 0;
        for ($i = $startIdx; $i <= $endIdx; $i++) {
            $tempReal = $inReal[$i];
            if ($tempReal > $prevReal) {
                $prevOBV += $inVolume[$i];
            } elseif ($tempReal < $prevReal) {
                $prevOBV -= $inVolume[$i];
            }
            $outReal[$outIdx++] = $prevOBV;
            $prevReal = $tempReal;
        }
        $outBegIdx = $startIdx;
        $outNBElement = $outIdx;

        return ReturnCode::Success->value;
    }
}

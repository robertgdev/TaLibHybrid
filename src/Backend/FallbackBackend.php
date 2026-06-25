<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Backend;

use RobertGDev\TaLibHybrid\Enum\ReturnCode;
use RobertGDev\TaLibHybrid\Exception\TaLibCalculationException;
use RobertGDev\TaLibHybrid\Exception\TaLibInputException;
use RobertGDev\TaLibHybrid\Fallback\Core\Core;
use RobertGDev\TaLibHybrid\Fallback\Core\CycleIndicators;
use RobertGDev\TaLibHybrid\Fallback\Core\MathOperators;
use RobertGDev\TaLibHybrid\Fallback\Core\MathTransform;
use RobertGDev\TaLibHybrid\Fallback\Core\MomentumIndicators;
use RobertGDev\TaLibHybrid\Fallback\Core\OverlapStudies;
use RobertGDev\TaLibHybrid\Fallback\Core\PatternRecognition;
use RobertGDev\TaLibHybrid\Fallback\Core\PriceTransform;
use RobertGDev\TaLibHybrid\Fallback\Core\StatisticFunctions;
use RobertGDev\TaLibHybrid\Fallback\Core\VolatilityIndicators;
use RobertGDev\TaLibHybrid\Fallback\Core\VolumeIndicators;

class FallbackBackend implements BackendInterface
{
    private static bool $initialized = false;

    private function ensureInitialized(): void
    {
        if (! self::$initialized) {
            Core::construct();
            self::$initialized = true;
        }
    }

    private function singleInput(array $values, string $class, string $method): array
    {
        $this->ensureInitialized();
        $endIdx = count($values) - 1;
        $values = self::reindex($values);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $retCode = $class::$method(0, $endIdx, $values, $outBegIdx, $outNBElement, $outReal);
        $this->checkReturnCode($retCode);

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    private function validateArrays(array ...$arrays): int
    {
        $count = count($arrays[0]);
        if ($count === 0) {
            throw new TaLibInputException('Input arrays must not be empty');
        }
        foreach ($arrays as $array) {
            if (count($array) !== $count) {
                throw new TaLibInputException('All input arrays must have the same length');
            }
        }

        return $count - 1;
    }

    private static function reindex(array $array): array
    {
        return array_values($array);
    }

    private static function padWithNulls(array $sequentialOutput, int $outBegIdx, int $inputCount): array
    {
        $result = array_fill(0, $inputCount, null);
        foreach ($sequentialOutput as $idx => $value) {
            $result[$outBegIdx + $idx] = $value;
        }

        return $result;
    }

    private function checkReturnCode(int $retCode): void
    {
        if ($retCode !== ReturnCode::Success->value) {
            throw new TaLibCalculationException(ReturnCode::messageFromInt($retCode));
        }
    }

    public function isExtensionAvailable(): bool
    {
        return false;
    }

    public function version(): string
    {
        return '0.0.0-fallback';
    }

    public function setUnstablePeriod(int $functionId, int $timePeriod): void
    {
        $this->ensureInitialized();
        Core::setUnstablePeriod($functionId, $timePeriod);
    }

    public function getUnstablePeriod(int $functionId): int
    {
        $this->ensureInitialized();

        return Core::getUnstablePeriod($functionId);
    }

    public function acos(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'acos');
    }

    public function asin(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'asin');
    }

    public function atan(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'atan');
    }

    public function ceil(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'ceil');
    }

    public function cos(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'cos');
    }

    public function cosh(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'cosh');
    }

    public function exp(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'exp');
    }

    public function floor(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'floor');
    }

    public function ln(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'ln');
    }

    public function log10(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'log10');
    }

    public function sin(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'sin');
    }

    public function sinh(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'sinh');
    }

    public function sqrt(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'sqrt');
    }

    public function tan(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'tan');
    }

    public function tanh(array $values): array
    {
        return $this->singleInput($values, MathTransform::class, 'tanh');
    }

    public function add(array $valuesA, array $valuesB): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($valuesA, $valuesB);
        $valuesA = self::reindex($valuesA);
        $valuesB = self::reindex($valuesB);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::add(0, $endIdx, $valuesA, $valuesB, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function sub(array $valuesA, array $valuesB): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($valuesA, $valuesB);
        $valuesA = self::reindex($valuesA);
        $valuesB = self::reindex($valuesB);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::sub(0, $endIdx, $valuesA, $valuesB, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function mult(array $valuesA, array $valuesB): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($valuesA, $valuesB);
        $valuesA = self::reindex($valuesA);
        $valuesB = self::reindex($valuesB);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::mult(0, $endIdx, $valuesA, $valuesB, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function div(array $valuesA, array $valuesB): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($valuesA, $valuesB);
        $valuesA = self::reindex($valuesA);
        $valuesB = self::reindex($valuesB);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::div(0, $endIdx, $valuesA, $valuesB, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function sum(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::sum(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function max(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::max(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function min(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::min(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function maxindex(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::maxIndex(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function minindex(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::minIndex(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function minmax(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outMin = [];
        $outMax = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::minMax(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outMin, $outMax));

        return ['min' => self::padWithNulls($outMin, $outBegIdx, $endIdx + 1), 'max' => self::padWithNulls($outMax, $outBegIdx, $endIdx + 1)];
    }

    public function minmaxindex(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outMinIdx = [];
        $outMaxIdx = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MathOperators::minMaxIndex(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outMinIdx, $outMaxIdx));

        return ['min' => self::padWithNulls($outMinIdx, $outBegIdx, $endIdx + 1), 'max' => self::padWithNulls($outMaxIdx, $outBegIdx, $endIdx + 1)];
    }

    public function sma(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::sma(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ema(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::ema(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function wma(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::wma(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function dema(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::dema(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function tema(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::tema(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function trima(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::trima(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function kama(array $values, int $period): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::kama(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function t3(array $values, int $period, float $vFactor = 0.7): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::t3(0, $endIdx, $values, $period, $vFactor, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ma(array $values, int $period = 30, int $maType = 0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::movingAverage(0, $endIdx, $values, $period, $maType, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function mama(array $values, float $fastLimit = 0.5, float $slowLimit = 0.05): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outMAMA = [];
        $outFAMA = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::mama(0, $endIdx, $values, $fastLimit, $slowLimit, $outBegIdx, $outNBElement, $outMAMA, $outFAMA));

        return ['mama' => self::padWithNulls($outMAMA, $outBegIdx, $endIdx + 1), 'fama' => self::padWithNulls($outFAMA, $outBegIdx, $endIdx + 1)];
    }

    public function mavp(array $values, array $periods, int $minPeriod = 2, int $maxPeriod = 30, int $maType = 0): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($values, $periods);
        $values = self::reindex($values);
        $periods = self::reindex($periods);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::movingAverageVariablePeriod(0, $endIdx, $values, $periods, $minPeriod, $maxPeriod, $maType, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function midpoint(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::midPoint(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function midprice(array $high, array $low, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::midPrice(0, $endIdx, $high, $low, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function sar(array $high, array $low, float $acceleration = 0.02, float $maximum = 0.20): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::sar(0, $endIdx, $high, $low, $acceleration, $maximum, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function sarext(array $high, array $low, float $startValue = 0.0, float $offsetOnReverse = 0.0, float $accelerationInitLong = 0.02, float $accelerationLong = 0.02, float $accelerationMaxLong = 0.20, float $accelerationInitShort = 0.02, float $accelerationShort = 0.02, float $accelerationMaxShort = 0.20): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::sarExt(0, $endIdx, $high, $low, $startValue, $offsetOnReverse, $accelerationInitLong, $accelerationLong, $accelerationMaxLong, $accelerationInitShort, $accelerationShort, $accelerationMaxShort, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ht_trendline(array $values): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::htTrendline(0, $endIdx, $values, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function accbands(array $high, array $low, array $close, int $period = 20): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outUpper = [];
        $outMiddle = [];
        $outLower = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::accBands(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outUpper, $outMiddle, $outLower));
        $n = $endIdx + 1;

        return ['upper' => self::padWithNulls($outUpper, $outBegIdx, $n), 'middle' => self::padWithNulls($outMiddle, $outBegIdx, $n), 'lower' => self::padWithNulls($outLower, $outBegIdx, $n)];
    }

    public function bbands(array $values, int $period = 5, float $nbDevUp = 2.0, float $nbDevDn = 2.0, int $maType = 0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outUpper = [];
        $outMiddle = [];
        $outLower = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(OverlapStudies::bbands(0, $endIdx, $values, $period, $nbDevUp, $nbDevDn, $maType, $outBegIdx, $outNBElement, $outUpper, $outMiddle, $outLower));
        $n = $endIdx + 1;

        return ['upper' => self::padWithNulls($outUpper, $outBegIdx, $n), 'middle' => self::padWithNulls($outMiddle, $outBegIdx, $n), 'lower' => self::padWithNulls($outLower, $outBegIdx, $n)];
    }

    public function atr(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(VolatilityIndicators::atr(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function natr(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(VolatilityIndicators::natr(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function trange(array $high, array $low, array $close): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(VolatilityIndicators::trueRange(0, $endIdx, $high, $low, $close, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function adx(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::adx(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function adxr(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::adxr(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function apo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::apo(0, $endIdx, $values, $fastPeriod, $slowPeriod, $maType, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function aroon(array $high, array $low, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outDown = [];
        $outUp = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::aroon(0, $endIdx, $high, $low, $period, $outBegIdx, $outNBElement, $outDown, $outUp));
        $n = $endIdx + 1;

        return ['down' => self::padWithNulls($outDown, $outBegIdx, $n), 'up' => self::padWithNulls($outUp, $outBegIdx, $n)];
    }

    public function aroonosc(array $high, array $low, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::aroonOsc(0, $endIdx, $high, $low, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function bop(array $open, array $high, array $low, array $close): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($open, $high, $low, $close);
        $open = self::reindex($open);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::bop(0, $endIdx, $open, $high, $low, $close, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function cci(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::cci(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function cmo(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::cmo(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function dx(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::dx(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function imi(array $open, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($open, $close);
        $open = self::reindex($open);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::imi(0, $endIdx, $open, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function macd(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $signalPeriod = 9): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outMACD = [];
        $outSignal = [];
        $outHist = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::macd(0, $endIdx, $values, $fastPeriod, $slowPeriod, $signalPeriod, $outBegIdx, $outNBElement, $outMACD, $outSignal, $outHist));
        $n = $endIdx + 1;

        return ['macd' => self::padWithNulls($outMACD, $outBegIdx, $n), 'signal' => self::padWithNulls($outSignal, $outBegIdx, $n), 'hist' => self::padWithNulls($outHist, $outBegIdx, $n)];
    }

    public function macdext(array $values, int $fastPeriod = 12, int $fastMaType = 0, int $slowPeriod = 26, int $slowMaType = 0, int $signalPeriod = 9, int $signalMaType = 0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outMACD = [];
        $outSignal = [];
        $outHist = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::macdExt(0, $endIdx, $values, $fastPeriod, $fastMaType, $slowPeriod, $slowMaType, $signalPeriod, $signalMaType, $outBegIdx, $outNBElement, $outMACD, $outSignal, $outHist));
        $n = $endIdx + 1;

        return ['macd' => self::padWithNulls($outMACD, $outBegIdx, $n), 'signal' => self::padWithNulls($outSignal, $outBegIdx, $n), 'hist' => self::padWithNulls($outHist, $outBegIdx, $n)];
    }

    public function macdfix(array $values, int $signalPeriod = 9): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outMACD = [];
        $outSignal = [];
        $outHist = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::macdFix(0, $endIdx, $values, $signalPeriod, $outBegIdx, $outNBElement, $outMACD, $outSignal, $outHist));
        $n = $endIdx + 1;

        return ['macd' => self::padWithNulls($outMACD, $outBegIdx, $n), 'signal' => self::padWithNulls($outSignal, $outBegIdx, $n), 'hist' => self::padWithNulls($outHist, $outBegIdx, $n)];
    }

    public function mfi(array $high, array $low, array $close, array $volume, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close, $volume);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $volume = self::reindex($volume);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::mfi(0, $endIdx, $high, $low, $close, $volume, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function minus_di(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::minusDI(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function minus_dm(array $high, array $low, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::minusDM(0, $endIdx, $high, $low, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function mom(array $values, int $period = 10): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::mom(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function plus_di(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::plusDI(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function plus_dm(array $high, array $low, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::plusDM(0, $endIdx, $high, $low, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ppo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::ppo(0, $endIdx, $values, $fastPeriod, $slowPeriod, $maType, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function roc(array $values, int $period = 10): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::roc(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function rocp(array $values, int $period = 10): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::rocP(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function rocr(array $values, int $period = 10): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::rocR(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function rocr100(array $values, int $period = 10): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::rocR100(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function rsi(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::rsi(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function stoch(array $high, array $low, array $close, int $fastKPeriod = 5, int $slowKPeriod = 3, int $slowKMaType = 0, int $slowDPeriod = 3, int $slowDMaType = 0): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outSlowK = [];
        $outSlowD = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::stoch(0, $endIdx, $high, $low, $close, $fastKPeriod, $slowKPeriod, $slowKMaType, $slowDPeriod, $slowDMaType, $outBegIdx, $outNBElement, $outSlowK, $outSlowD));
        $n = $endIdx + 1;

        return ['slowk' => self::padWithNulls($outSlowK, $outBegIdx, $n), 'slowd' => self::padWithNulls($outSlowD, $outBegIdx, $n)];
    }

    public function stochf(array $high, array $low, array $close, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outFastK = [];
        $outFastD = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::stochF(0, $endIdx, $high, $low, $close, $fastKPeriod, $fastDPeriod, $fastDMaType, $outBegIdx, $outNBElement, $outFastK, $outFastD));
        $n = $endIdx + 1;

        return ['fastk' => self::padWithNulls($outFastK, $outBegIdx, $n), 'fastd' => self::padWithNulls($outFastD, $outBegIdx, $n)];
    }

    public function stochrsi(array $values, int $period = 14, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outFastK = [];
        $outFastD = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::stochRsi(0, $endIdx, $values, $period, $fastKPeriod, $fastDPeriod, $fastDMaType, $outBegIdx, $outNBElement, $outFastK, $outFastD));
        $n = $endIdx + 1;

        return ['fastk' => self::padWithNulls($outFastK, $outBegIdx, $n), 'fastd' => self::padWithNulls($outFastD, $outBegIdx, $n)];
    }

    public function trix(array $values, int $period = 30): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::trix(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ultosc(array $high, array $low, array $close, int $period1 = 7, int $period2 = 14, int $period3 = 28): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::ultOsc(0, $endIdx, $high, $low, $close, $period1, $period2, $period3, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function willr(array $high, array $low, array $close, int $period = 14): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(MomentumIndicators::willR(0, $endIdx, $high, $low, $close, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ht_dcperiod(array $values): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(CycleIndicators::htDcPeriod(0, $endIdx, $values, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ht_dcphase(array $values): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(CycleIndicators::htDcPhase(0, $endIdx, $values, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ht_phasor(array $values): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outInPhase = [];
        $outQuadrature = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(CycleIndicators::htPhasor(0, $endIdx, $values, $outBegIdx, $outNBElement, $outInPhase, $outQuadrature));
        $n = $endIdx + 1;

        return ['inphase' => self::padWithNulls($outInPhase, $outBegIdx, $n), 'quadrature' => self::padWithNulls($outQuadrature, $outBegIdx, $n)];
    }

    public function ht_sine(array $values): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outSine = [];
        $outLeadSine = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(CycleIndicators::htSine(0, $endIdx, $values, $outBegIdx, $outNBElement, $outSine, $outLeadSine));
        $n = $endIdx + 1;

        return ['sine' => self::padWithNulls($outSine, $outBegIdx, $n), 'leadsine' => self::padWithNulls($outLeadSine, $outBegIdx, $n)];
    }

    public function ht_trendmode(array $values): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(CycleIndicators::htTrendMode(0, $endIdx, $values, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function ad(array $high, array $low, array $close, array $volume): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close, $volume);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $volume = self::reindex($volume);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(VolumeIndicators::ad(0, $endIdx, $high, $low, $close, $volume, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function adosc(array $high, array $low, array $close, array $volume, int $fastPeriod = 3, int $slowPeriod = 10): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close, $volume);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $volume = self::reindex($volume);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(VolumeIndicators::adOsc(0, $endIdx, $high, $low, $close, $volume, $fastPeriod, $slowPeriod, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function obv(array $values, array $volume): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($values, $volume);
        $values = self::reindex($values);
        $volume = self::reindex($volume);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(VolumeIndicators::obv(0, $endIdx, $values, $volume, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function beta(array $valuesA, array $valuesB, int $period = 5): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($valuesA, $valuesB);
        $valuesA = self::reindex($valuesA);
        $valuesB = self::reindex($valuesB);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::beta(0, $endIdx, $valuesA, $valuesB, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function correl(array $valuesA, array $valuesB, int $period = 30): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($valuesA, $valuesB);
        $valuesA = self::reindex($valuesA);
        $valuesB = self::reindex($valuesB);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::correl(0, $endIdx, $valuesA, $valuesB, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function linearreg(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::linearReg(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function linearreg_angle(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::linearRegAngle(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function linearreg_intercept(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::linearRegIntercept(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function linearreg_slope(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::linearRegSlope(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function stddev(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::stdDev(0, $endIdx, $values, $period, $nbDev, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function tsf(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::tsf(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function var(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::variance(0, $endIdx, $values, $period, $nbDev, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function avgprice(array $open, array $high, array $low, array $close): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($open, $high, $low, $close);
        $open = self::reindex($open);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(PriceTransform::avgPrice(0, $endIdx, $open, $high, $low, $close, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function avgdev(array $values, int $period = 14): array
    {
        $this->ensureInitialized();
        $values = array_values($values);
        $endIdx = count($values) - 1;
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(StatisticFunctions::avgDev(0, $endIdx, $values, $period, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function medprice(array $high, array $low): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(PriceTransform::medPrice(0, $endIdx, $high, $low, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function typprice(array $high, array $low, array $close): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(PriceTransform::typPrice(0, $endIdx, $high, $low, $close, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    public function wclprice(array $high, array $low, array $close): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($high, $low, $close);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outReal = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $this->checkReturnCode(PriceTransform::wclPrice(0, $endIdx, $high, $low, $close, $outBegIdx, $outNBElement, $outReal));

        return self::padWithNulls($outReal, $outBegIdx, $endIdx + 1);
    }

    private function cdl(string $method, array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        $this->ensureInitialized();
        $endIdx = $this->validateArrays($open, $high, $low, $close);
        $open = self::reindex($open);
        $high = self::reindex($high);
        $low = self::reindex($low);
        $close = self::reindex($close);
        $outInteger = [];
        $outBegIdx = 0;
        $outNBElement = 0;
        $params = [0, $endIdx, $open, $high, $low, $close];
        $penetrationMethods = ['cdlAbandonedBaby', 'cdlDarkCloudCover', 'cdlEveningDojiStar', 'cdlEveningStar', 'cdlMatHold', 'cdlMorningDojiStar', 'cdlMorningStar'];
        if (in_array($method, $penetrationMethods)) {
            $params[] = $penetration;
        }
        $params[] = &$outBegIdx;
        $params[] = &$outNBElement;
        $params[] = &$outInteger;
        $retCode = PatternRecognition::$method(...$params);
        $this->checkReturnCode($retCode);

        return self::padWithNulls($outInteger, $outBegIdx, $endIdx + 1);
    }

    public function cdl2crows(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl2Crows', $open, $high, $low, $close);
    }

    public function cdl3blackcrows(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl3BlackCrows', $open, $high, $low, $close);
    }

    public function cdl3inside(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl3Inside', $open, $high, $low, $close);
    }

    public function cdl3linestrike(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl3LineStrike', $open, $high, $low, $close);
    }

    public function cdl3outside(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl3Outside', $open, $high, $low, $close);
    }

    public function cdl3starsinsouth(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl3StarsInSouth', $open, $high, $low, $close);
    }

    public function cdl3whitesoldiers(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdl3WhiteSoldiers', $open, $high, $low, $close);
    }

    public function cdlabandonedbaby(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlAbandonedBaby', $open, $high, $low, $close, $penetration);
    }

    public function cdladvanceblock(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlAdvanceBlock', $open, $high, $low, $close);
    }

    public function cdlbelthold(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlBeltHold', $open, $high, $low, $close);
    }

    public function cdlbreakaway(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlBreakaway', $open, $high, $low, $close);
    }

    public function cdlclosingmarubozu(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlClosingMarubozu', $open, $high, $low, $close);
    }

    public function cdlconcealbabyswall(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlConcealBabysWall', $open, $high, $low, $close);
    }

    public function cdlcounterattack(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlCounterAttack', $open, $high, $low, $close);
    }

    public function cdldarkcloudcover(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlDarkCloudCover', $open, $high, $low, $close, $penetration);
    }

    public function cdldoji(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlDoji', $open, $high, $low, $close);
    }

    public function cdldojistar(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlDojiStar', $open, $high, $low, $close);
    }

    public function cdldragonflydoji(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlDragonflyDoji', $open, $high, $low, $close);
    }

    public function cdlengulfing(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlEngulfing', $open, $high, $low, $close);
    }

    public function cdleveningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlEveningDojiStar', $open, $high, $low, $close, $penetration);
    }

    public function cdleveningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlEveningStar', $open, $high, $low, $close, $penetration);
    }

    public function cdlgapsidesidewhite(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlGapSideSideWhite', $open, $high, $low, $close);
    }

    public function cdlgravestonedoji(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlGravestoneDoji', $open, $high, $low, $close);
    }

    public function cdlhammer(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHammer', $open, $high, $low, $close);
    }

    public function cdlhangingman(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHangingMan', $open, $high, $low, $close);
    }

    public function cdlharami(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHarami', $open, $high, $low, $close);
    }

    public function cdlharamicross(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHaramiCross', $open, $high, $low, $close);
    }

    public function cdlhighwave(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHighWave', $open, $high, $low, $close);
    }

    public function cdlhikkake(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHikkake', $open, $high, $low, $close);
    }

    public function cdlhikkakemod(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHikkakeMod', $open, $high, $low, $close);
    }

    public function cdlhomingpigeon(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlHomingPigeon', $open, $high, $low, $close);
    }

    public function cdlidentical3crows(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlIdentical3Crows', $open, $high, $low, $close);
    }

    public function cdlinneck(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlInNeck', $open, $high, $low, $close);
    }

    public function cdlinvertedhammer(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlInvertedHammer', $open, $high, $low, $close);
    }

    public function cdlkicking(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlKicking', $open, $high, $low, $close);
    }

    public function cdlkickingbylength(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlKickingByLength', $open, $high, $low, $close);
    }

    public function cdlladderbottom(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlLadderBottom', $open, $high, $low, $close);
    }

    public function cdllongleggeddoji(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlLongLeggedDoji', $open, $high, $low, $close);
    }

    public function cdllongline(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlLongLine', $open, $high, $low, $close);
    }

    public function cdlmarubozu(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlMarubozu', $open, $high, $low, $close);
    }

    public function cdlmatchinglow(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlMatchingLow', $open, $high, $low, $close);
    }

    public function cdlmathold(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlMatHold', $open, $high, $low, $close, $penetration);
    }

    public function cdlmorningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlMorningDojiStar', $open, $high, $low, $close, $penetration);
    }

    public function cdlmorningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return $this->cdl('cdlMorningStar', $open, $high, $low, $close, $penetration);
    }

    public function cdlonneck(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlOnNeck', $open, $high, $low, $close);
    }

    public function cdlpiercing(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlPiercing', $open, $high, $low, $close);
    }

    public function cdlrickshawman(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlRickshawMan', $open, $high, $low, $close);
    }

    public function cdlrisefall3methods(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlRiseFall3Methods', $open, $high, $low, $close);
    }

    public function cdlseparatinglines(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlSeparatingLines', $open, $high, $low, $close);
    }

    public function cdlshootingstar(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlShootingStar', $open, $high, $low, $close);
    }

    public function cdlshortline(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlShortLine', $open, $high, $low, $close);
    }

    public function cdlspinningtop(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlSpinningTop', $open, $high, $low, $close);
    }

    public function cdlstalledpattern(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlStalledPattern', $open, $high, $low, $close);
    }

    public function cdlsticksandwich(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlStickSandwich', $open, $high, $low, $close);
    }

    public function cdltakuri(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlTakuri', $open, $high, $low, $close);
    }

    public function cdltasukigap(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlTasukiGap', $open, $high, $low, $close);
    }

    public function cdlthrusting(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlThrusting', $open, $high, $low, $close);
    }

    public function cdltristar(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlTristar', $open, $high, $low, $close);
    }

    public function cdlunique3river(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlUnique3River', $open, $high, $low, $close);
    }

    public function cdlupsidegap2crows(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlUpsideGap2Crows', $open, $high, $low, $close);
    }

    public function cdlxsidegap3methods(array $open, array $high, array $low, array $close): array
    {
        return $this->cdl('cdlXSideGap3Methods', $open, $high, $low, $close);
    }
}

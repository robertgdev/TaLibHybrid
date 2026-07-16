<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Backend;

interface BackendInterface
{
    public function isExtensionAvailable(): bool;

    public function setUnstablePeriod(int $functionId, int $timePeriod): void;

    public function getUnstablePeriod(int $functionId): int;

    public function version(): string;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<string, array<int, float|int|null>>
     */
    public function accbands(array $high, array $low, array $close, int $period = 20): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function bbands(array $values, int $period = 5, float $nbDevUp = 2.0, float $nbDevDn = 2.0, int $maType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function dema(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ema(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_trendline(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function kama(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ma(array $values, int $period = 30, int $maType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function mama(array $values, float $fastLimit = 0.5, float $slowLimit = 0.05): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @param  array<int, int>  $periods
     * @return array<int, float|int|null>
     */
    public function mavp(array $values, array $periods, int $minPeriod = 2, int $maxPeriod = 30, int $maType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function midpoint(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function midprice(array $high, array $low, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function sar(array $high, array $low, float $acceleration = 0.02, float $maximum = 0.20): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function sarext(array $high, array $low, float $startValue = 0.0, float $offsetOnReverse = 0.0, float $accelerationInitLong = 0.02, float $accelerationLong = 0.02, float $accelerationMaxLong = 0.20, float $accelerationInitShort = 0.02, float $accelerationShort = 0.02, float $accelerationMaxShort = 0.20): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sma(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function t3(array $values, int $period, float $vFactor = 0.7): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function tema(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function trima(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function wma(array $values, int $period): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function atr(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function natr(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function trange(array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function adx(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function adxr(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function apo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<string, array<int, float|int|null>>
     */
    public function aroon(array $high, array $low, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function aroonosc(array $high, array $low, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function bop(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cci(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function cmo(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function dx(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function imi(array $open, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function macd(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $signalPeriod = 9): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function macdext(array $values, int $fastPeriod = 12, int $fastMaType = 0, int $slowPeriod = 26, int $slowMaType = 0, int $signalPeriod = 9, int $signalMaType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function macdfix(array $values, int $signalPeriod = 9): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  array<int, float|int|null>  $volume
     * @return array<int, float|int|null>
     */
    public function mfi(array $high, array $low, array $close, array $volume, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function minus_di(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function minus_dm(array $high, array $low, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function mom(array $values, int $period = 10): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function plus_di(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function plus_dm(array $high, array $low, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ppo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function roc(array $values, int $period = 10): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function rocp(array $values, int $period = 10): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function rocr(array $values, int $period = 10): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function rocr100(array $values, int $period = 10): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function rsi(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<string, array<int, float|int|null>>
     */
    public function stoch(array $high, array $low, array $close, int $fastKPeriod = 5, int $slowKPeriod = 3, int $slowKMaType = 0, int $slowDPeriod = 3, int $slowDMaType = 0): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<string, array<int, float|int|null>>
     */
    public function stochf(array $high, array $low, array $close, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function stochrsi(array $values, int $period = 14, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function trix(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function ultosc(array $high, array $low, array $close, int $period1 = 7, int $period2 = 14, int $period3 = 28): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function willr(array $high, array $low, array $close, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_dcperiod(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_dcphase(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function ht_phasor(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function ht_sine(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_trendmode(array $values): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  array<int, float|int|null>  $volume
     * @return array<int, float|int|null>
     */
    public function ad(array $high, array $low, array $close, array $volume): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  array<int, float|int|null>  $volume
     * @return array<int, float|int|null>
     */
    public function adosc(array $high, array $low, array $close, array $volume, int $fastPeriod = 3, int $slowPeriod = 10): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @param  array<int, float|int|null>  $volume
     * @return array<int, float|int|null>
     */
    public function obv(array $values, array $volume): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl2crows(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3blackcrows(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3inside(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3linestrike(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3outside(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3starsinsouth(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3whitesoldiers(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlabandonedbaby(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdladvanceblock(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlbelthold(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlbreakaway(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlclosingmarubozu(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlconcealbabyswall(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlcounterattack(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldarkcloudcover(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldoji(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldojistar(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldragonflydoji(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlengulfing(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdleveningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdleveningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlgapsidesidewhite(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlgravestonedoji(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhammer(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhangingman(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlharami(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlharamicross(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhighwave(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhikkake(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhikkakemod(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhomingpigeon(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlidentical3crows(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlinneck(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlinvertedhammer(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlkicking(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlkickingbylength(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlladderbottom(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdllongleggeddoji(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdllongline(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmarubozu(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmatchinglow(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmathold(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmorningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmorningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlonneck(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlpiercing(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlrickshawman(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlrisefall3methods(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlseparatinglines(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlshootingstar(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlshortline(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlspinningtop(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlstalledpattern(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlsticksandwich(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdltakuri(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdltasukigap(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlthrusting(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdltristar(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlunique3river(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlupsidegap2crows(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlxsidegap3methods(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function beta(array $valuesA, array $valuesB, int $period = 5): array;

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function correl(array $valuesA, array $valuesB, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function linearreg(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function linearreg_angle(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function linearreg_intercept(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function linearreg_slope(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function stddev(array $values, int $period = 5, float $nbDev = 1.0): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function tsf(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function var(array $values, int $period = 5, float $nbDev = 1.0): array;

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function avgprice(array $open, array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function avgdev(array $values, int $period = 14): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function medprice(array $high, array $low): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function typprice(array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function wclprice(array $high, array $low, array $close): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function acos(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function asin(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function atan(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ceil(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function cos(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function cosh(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function exp(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function floor(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ln(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function log10(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sin(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sinh(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sqrt(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function tan(array $values): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function tanh(array $values): array;

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function add(array $valuesA, array $valuesB): array;

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function sub(array $valuesA, array $valuesB): array;

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function mult(array $valuesA, array $valuesB): array;

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function div(array $valuesA, array $valuesB): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sum(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function max(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function min(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, int|null>
     */
    public function maxindex(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, int|null>
     */
    public function minindex(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function minmax(array $values, int $period = 30): array;

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, int|null>>
     */
    public function minmaxindex(array $values, int $period = 30): array;
}

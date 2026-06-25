<?php

declare(strict_types=1);

namespace robertgdev\TaLibHybrid\Backend;

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
     * @return array<int, float|int|null>
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

    public function mavp(array $values, array $periods, int $minPeriod = 2, int $maxPeriod = 30, int $maType = 0): array;

    public function midpoint(array $values, int $period = 14): array;

    public function midprice(array $high, array $low, int $period = 14): array;

    public function sar(array $high, array $low, float $acceleration = 0.02, float $maximum = 0.20): array;

    public function sarext(array $high, array $low, float $startValue = 0.0, float $offsetOnReverse = 0.0, float $accelerationInitLong = 0.02, float $accelerationLong = 0.02, float $accelerationMaxLong = 0.20, float $accelerationInitShort = 0.02, float $accelerationShort = 0.02, float $accelerationMaxShort = 0.20): array;

    public function sma(array $values, int $period): array;

    public function t3(array $values, int $period, float $vFactor = 0.7): array;

    public function tema(array $values, int $period): array;

    public function trima(array $values, int $period): array;

    public function wma(array $values, int $period): array;

    public function atr(array $high, array $low, array $close, int $period = 14): array;

    public function natr(array $high, array $low, array $close, int $period = 14): array;

    public function trange(array $high, array $low, array $close): array;

    public function adx(array $high, array $low, array $close, int $period = 14): array;

    public function adxr(array $high, array $low, array $close, int $period = 14): array;

    public function apo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array;

    /** @return array<string, array<int, float|int|null>> */
    public function aroon(array $high, array $low, int $period = 14): array;

    public function aroonosc(array $high, array $low, int $period = 14): array;

    public function bop(array $open, array $high, array $low, array $close): array;

    public function cci(array $high, array $low, array $close, int $period = 14): array;

    public function cmo(array $values, int $period = 14): array;

    public function dx(array $high, array $low, array $close, int $period = 14): array;

    public function imi(array $open, array $close, int $period = 14): array;

    /** @return array<string, array<int, float|int|null>> */
    public function macd(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $signalPeriod = 9): array;

    /** @return array<string, array<int, float|int|null>> */
    public function macdext(array $values, int $fastPeriod = 12, int $fastMaType = 0, int $slowPeriod = 26, int $slowMaType = 0, int $signalPeriod = 9, int $signalMaType = 0): array;

    /** @return array<string, array<int, float|int|null>> */
    public function macdfix(array $values, int $signalPeriod = 9): array;

    public function mfi(array $high, array $low, array $close, array $volume, int $period = 14): array;

    public function minus_di(array $high, array $low, array $close, int $period = 14): array;

    public function minus_dm(array $high, array $low, int $period = 14): array;

    public function mom(array $values, int $period = 10): array;

    public function plus_di(array $high, array $low, array $close, int $period = 14): array;

    public function plus_dm(array $high, array $low, int $period = 14): array;

    public function ppo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array;

    public function roc(array $values, int $period = 10): array;

    public function rocp(array $values, int $period = 10): array;

    public function rocr(array $values, int $period = 10): array;

    public function rocr100(array $values, int $period = 10): array;

    public function rsi(array $values, int $period = 14): array;

    /** @return array<string, array<int, float|int|null>> */
    public function stoch(array $high, array $low, array $close, int $fastKPeriod = 5, int $slowKPeriod = 3, int $slowKMaType = 0, int $slowDPeriod = 3, int $slowDMaType = 0): array;

    /** @return array<string, array<int, float|int|null>> */
    public function stochf(array $high, array $low, array $close, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array;

    /** @return array<string, array<int, float|int|null>> */
    public function stochrsi(array $values, int $period = 14, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array;

    public function trix(array $values, int $period = 30): array;

    public function ultosc(array $high, array $low, array $close, int $period1 = 7, int $period2 = 14, int $period3 = 28): array;

    public function willr(array $high, array $low, array $close, int $period = 14): array;

    public function ht_dcperiod(array $values): array;

    public function ht_dcphase(array $values): array;

    /** @return array<string, array<int, float|int|null>> */
    public function ht_phasor(array $values): array;

    /** @return array<string, array<int, float|int|null>> */
    public function ht_sine(array $values): array;

    public function ht_trendmode(array $values): array;

    public function ad(array $high, array $low, array $close, array $volume): array;

    public function adosc(array $high, array $low, array $close, array $volume, int $fastPeriod = 3, int $slowPeriod = 10): array;

    public function obv(array $values, array $volume): array;

    public function cdl2crows(array $open, array $high, array $low, array $close): array;

    public function cdl3blackcrows(array $open, array $high, array $low, array $close): array;

    public function cdl3inside(array $open, array $high, array $low, array $close): array;

    public function cdl3linestrike(array $open, array $high, array $low, array $close): array;

    public function cdl3outside(array $open, array $high, array $low, array $close): array;

    public function cdl3starsinsouth(array $open, array $high, array $low, array $close): array;

    public function cdl3whitesoldiers(array $open, array $high, array $low, array $close): array;

    public function cdlabandonedbaby(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdladvanceblock(array $open, array $high, array $low, array $close): array;

    public function cdlbelthold(array $open, array $high, array $low, array $close): array;

    public function cdlbreakaway(array $open, array $high, array $low, array $close): array;

    public function cdlclosingmarubozu(array $open, array $high, array $low, array $close): array;

    public function cdlconcealbabyswall(array $open, array $high, array $low, array $close): array;

    public function cdlcounterattack(array $open, array $high, array $low, array $close): array;

    public function cdldarkcloudcover(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdldoji(array $open, array $high, array $low, array $close): array;

    public function cdldojistar(array $open, array $high, array $low, array $close): array;

    public function cdldragonflydoji(array $open, array $high, array $low, array $close): array;

    public function cdlengulfing(array $open, array $high, array $low, array $close): array;

    public function cdleveningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdleveningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdlgapsidesidewhite(array $open, array $high, array $low, array $close): array;

    public function cdlgravestonedoji(array $open, array $high, array $low, array $close): array;

    public function cdlhammer(array $open, array $high, array $low, array $close): array;

    public function cdlhangingman(array $open, array $high, array $low, array $close): array;

    public function cdlharami(array $open, array $high, array $low, array $close): array;

    public function cdlharamicross(array $open, array $high, array $low, array $close): array;

    public function cdlhighwave(array $open, array $high, array $low, array $close): array;

    public function cdlhikkake(array $open, array $high, array $low, array $close): array;

    public function cdlhikkakemod(array $open, array $high, array $low, array $close): array;

    public function cdlhomingpigeon(array $open, array $high, array $low, array $close): array;

    public function cdlidentical3crows(array $open, array $high, array $low, array $close): array;

    public function cdlinneck(array $open, array $high, array $low, array $close): array;

    public function cdlinvertedhammer(array $open, array $high, array $low, array $close): array;

    public function cdlkicking(array $open, array $high, array $low, array $close): array;

    public function cdlkickingbylength(array $open, array $high, array $low, array $close): array;

    public function cdlladderbottom(array $open, array $high, array $low, array $close): array;

    public function cdllongleggeddoji(array $open, array $high, array $low, array $close): array;

    public function cdllongline(array $open, array $high, array $low, array $close): array;

    public function cdlmarubozu(array $open, array $high, array $low, array $close): array;

    public function cdlmatchinglow(array $open, array $high, array $low, array $close): array;

    public function cdlmathold(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdlmorningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdlmorningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array;

    public function cdlonneck(array $open, array $high, array $low, array $close): array;

    public function cdlpiercing(array $open, array $high, array $low, array $close): array;

    public function cdlrickshawman(array $open, array $high, array $low, array $close): array;

    public function cdlrisefall3methods(array $open, array $high, array $low, array $close): array;

    public function cdlseparatinglines(array $open, array $high, array $low, array $close): array;

    public function cdlshootingstar(array $open, array $high, array $low, array $close): array;

    public function cdlshortline(array $open, array $high, array $low, array $close): array;

    public function cdlspinningtop(array $open, array $high, array $low, array $close): array;

    public function cdlstalledpattern(array $open, array $high, array $low, array $close): array;

    public function cdlsticksandwich(array $open, array $high, array $low, array $close): array;

    public function cdltakuri(array $open, array $high, array $low, array $close): array;

    public function cdltasukigap(array $open, array $high, array $low, array $close): array;

    public function cdlthrusting(array $open, array $high, array $low, array $close): array;

    public function cdltristar(array $open, array $high, array $low, array $close): array;

    public function cdlunique3river(array $open, array $high, array $low, array $close): array;

    public function cdlupsidegap2crows(array $open, array $high, array $low, array $close): array;

    public function cdlxsidegap3methods(array $open, array $high, array $low, array $close): array;

    public function beta(array $valuesA, array $valuesB, int $period = 5): array;

    public function correl(array $valuesA, array $valuesB, int $period = 30): array;

    public function linearreg(array $values, int $period = 14): array;

    public function linearreg_angle(array $values, int $period = 14): array;

    public function linearreg_intercept(array $values, int $period = 14): array;

    public function linearreg_slope(array $values, int $period = 14): array;

    public function stddev(array $values, int $period = 5, float $nbDev = 1.0): array;

    public function tsf(array $values, int $period = 14): array;

    public function var(array $values, int $period = 5, float $nbDev = 1.0): array;

    public function avgprice(array $open, array $high, array $low, array $close): array;

    public function avgdev(array $values, int $period = 14): array;

    public function medprice(array $high, array $low): array;

    public function typprice(array $high, array $low, array $close): array;

    public function wclprice(array $high, array $low, array $close): array;

    public function acos(array $values): array;

    public function asin(array $values): array;

    public function atan(array $values): array;

    public function ceil(array $values): array;

    public function cos(array $values): array;

    public function cosh(array $values): array;

    public function exp(array $values): array;

    public function floor(array $values): array;

    public function ln(array $values): array;

    public function log10(array $values): array;

    public function sin(array $values): array;

    public function sinh(array $values): array;

    public function sqrt(array $values): array;

    public function tan(array $values): array;

    public function tanh(array $values): array;

    public function add(array $valuesA, array $valuesB): array;

    public function sub(array $valuesA, array $valuesB): array;

    public function mult(array $valuesA, array $valuesB): array;

    public function div(array $valuesA, array $valuesB): array;

    public function sum(array $values, int $period = 30): array;

    /** @return array<string, array<int, float|int|null>> */
    public function max(array $values, int $period = 30): array;

    /** @return array<string, array<int, float|int|null>> */
    public function min(array $values, int $period = 30): array;

    /** @return array<int, int> */
    public function maxindex(array $values, int $period = 30): array;

    /** @return array<int, int> */
    public function minindex(array $values, int $period = 30): array;

    /** @return array<string, array<int, float|int|null>> */
    public function minmax(array $values, int $period = 30): array;

    /** @return array<string, array<int, int>> */
    public function minmaxindex(array $values, int $period = 30): array;
}

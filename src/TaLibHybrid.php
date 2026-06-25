<?php

declare(strict_types=1);

namespace robertgdev\TaLibHybrid;

use robertgdev\TaLibHybrid\Backend\BackendInterface;
use robertgdev\TaLibHybrid\Backend\ExtensionBackend;
use robertgdev\TaLibHybrid\Backend\FallbackBackend;

class TaLibHybrid
{
    private static ?BackendInterface $backend = null;

    public static function getBackend(): BackendInterface
    {
        if (self::$backend === null) {
            self::$backend = extension_loaded('ta_lib')
                ? new ExtensionBackend
                : new FallbackBackend;
        }

        return self::$backend;
    }

    public static function setBackend(?BackendInterface $backend): void
    {
        self::$backend = $backend;
    }

    public static function isExtensionAvailable(): bool
    {
        return self::getBackend()->isExtensionAvailable();
    }

    public static function version(): string
    {
        return self::getBackend()->version();
    }

    public static function setUnstablePeriod(int $functionId, int $timePeriod): void
    {
        self::getBackend()->setUnstablePeriod($functionId, $timePeriod);
    }

    public static function getUnstablePeriod(int $functionId): int
    {
        return self::getBackend()->getUnstablePeriod($functionId);
    }

    public static function accbands(array $high, array $low, array $close, int $period = 20): array
    {
        return self::getBackend()->accbands($high, $low, $close, $period);
    }

    public static function bbands(array $values, int $period = 5, float $nbDevUp = 2.0, float $nbDevDn = 2.0, int $maType = 0): array
    {
        return self::getBackend()->bbands($values, $period, $nbDevUp, $nbDevDn, $maType);
    }

    public static function dema(array $values, int $period): array
    {
        return self::getBackend()->dema($values, $period);
    }

    public static function ema(array $values, int $period): array
    {
        return self::getBackend()->ema($values, $period);
    }

    public static function ht_trendline(array $values): array
    {
        return self::getBackend()->ht_trendline($values);
    }

    public static function kama(array $values, int $period): array
    {
        return self::getBackend()->kama($values, $period);
    }

    public static function ma(array $values, int $period = 30, int $maType = 0): array
    {
        return self::getBackend()->ma($values, $period, $maType);
    }

    public static function mama(array $values, float $fastLimit = 0.5, float $slowLimit = 0.05): array
    {
        return self::getBackend()->mama($values, $fastLimit, $slowLimit);
    }

    public static function mavp(array $values, array $periods, int $minPeriod = 2, int $maxPeriod = 30, int $maType = 0): array
    {
        return self::getBackend()->mavp($values, $periods, $minPeriod, $maxPeriod, $maType);
    }

    public static function midpoint(array $values, int $period = 14): array
    {
        return self::getBackend()->midpoint($values, $period);
    }

    public static function midprice(array $high, array $low, int $period = 14): array
    {
        return self::getBackend()->midprice($high, $low, $period);
    }

    public static function sar(array $high, array $low, float $acceleration = 0.02, float $maximum = 0.20): array
    {
        return self::getBackend()->sar($high, $low, $acceleration, $maximum);
    }

    public static function sarext(array $high, array $low, float $startValue = 0.0, float $offsetOnReverse = 0.0, float $accelerationInitLong = 0.02, float $accelerationLong = 0.02, float $accelerationMaxLong = 0.20, float $accelerationInitShort = 0.02, float $accelerationShort = 0.02, float $accelerationMaxShort = 0.20): array
    {
        return self::getBackend()->sarext($high, $low, $startValue, $offsetOnReverse, $accelerationInitLong, $accelerationLong, $accelerationMaxLong, $accelerationInitShort, $accelerationShort, $accelerationMaxShort);
    }

    public static function sma(array $values, int $period): array
    {
        return self::getBackend()->sma($values, $period);
    }

    public static function t3(array $values, int $period, float $vFactor = 0.7): array
    {
        return self::getBackend()->t3($values, $period, $vFactor);
    }

    public static function tema(array $values, int $period): array
    {
        return self::getBackend()->tema($values, $period);
    }

    public static function trima(array $values, int $period): array
    {
        return self::getBackend()->trima($values, $period);
    }

    public static function wma(array $values, int $period): array
    {
        return self::getBackend()->wma($values, $period);
    }

    public static function atr(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->atr($high, $low, $close, $period);
    }

    public static function natr(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->natr($high, $low, $close, $period);
    }

    public static function trange(array $high, array $low, array $close): array
    {
        return self::getBackend()->trange($high, $low, $close);
    }

    public static function adx(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->adx($high, $low, $close, $period);
    }

    public static function adxr(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->adxr($high, $low, $close, $period);
    }

    public static function apo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        return self::getBackend()->apo($values, $fastPeriod, $slowPeriod, $maType);
    }

    public static function aroon(array $high, array $low, int $period = 14): array
    {
        return self::getBackend()->aroon($high, $low, $period);
    }

    public static function aroonosc(array $high, array $low, int $period = 14): array
    {
        return self::getBackend()->aroonosc($high, $low, $period);
    }

    public static function bop(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->bop($open, $high, $low, $close);
    }

    public static function cci(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->cci($high, $low, $close, $period);
    }

    public static function cmo(array $values, int $period = 14): array
    {
        return self::getBackend()->cmo($values, $period);
    }

    public static function dx(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->dx($high, $low, $close, $period);
    }

    public static function imi(array $open, array $close, int $period = 14): array
    {
        return self::getBackend()->imi($open, $close, $period);
    }

    public static function macd(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $signalPeriod = 9): array
    {
        return self::getBackend()->macd($values, $fastPeriod, $slowPeriod, $signalPeriod);
    }

    public static function macdext(array $values, int $fastPeriod = 12, int $fastMaType = 0, int $slowPeriod = 26, int $slowMaType = 0, int $signalPeriod = 9, int $signalMaType = 0): array
    {
        return self::getBackend()->macdext($values, $fastPeriod, $fastMaType, $slowPeriod, $slowMaType, $signalPeriod, $signalMaType);
    }

    public static function macdfix(array $values, int $signalPeriod = 9): array
    {
        return self::getBackend()->macdfix($values, $signalPeriod);
    }

    public static function mfi(array $high, array $low, array $close, array $volume, int $period = 14): array
    {
        return self::getBackend()->mfi($high, $low, $close, $volume, $period);
    }

    public static function minus_di(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->minus_di($high, $low, $close, $period);
    }

    public static function minus_dm(array $high, array $low, int $period = 14): array
    {
        return self::getBackend()->minus_dm($high, $low, $period);
    }

    public static function mom(array $values, int $period = 10): array
    {
        return self::getBackend()->mom($values, $period);
    }

    public static function plus_di(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->plus_di($high, $low, $close, $period);
    }

    public static function plus_dm(array $high, array $low, int $period = 14): array
    {
        return self::getBackend()->plus_dm($high, $low, $period);
    }

    public static function ppo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        return self::getBackend()->ppo($values, $fastPeriod, $slowPeriod, $maType);
    }

    public static function roc(array $values, int $period = 10): array
    {
        return self::getBackend()->roc($values, $period);
    }

    public static function rocp(array $values, int $period = 10): array
    {
        return self::getBackend()->rocp($values, $period);
    }

    public static function rocr(array $values, int $period = 10): array
    {
        return self::getBackend()->rocr($values, $period);
    }

    public static function rocr100(array $values, int $period = 10): array
    {
        return self::getBackend()->rocr100($values, $period);
    }

    public static function rsi(array $values, int $period = 14): array
    {
        return self::getBackend()->rsi($values, $period);
    }

    public static function stoch(array $high, array $low, array $close, int $fastKPeriod = 5, int $slowKPeriod = 3, int $slowKMaType = 0, int $slowDPeriod = 3, int $slowDMaType = 0): array
    {
        return self::getBackend()->stoch($high, $low, $close, $fastKPeriod, $slowKPeriod, $slowKMaType, $slowDPeriod, $slowDMaType);
    }

    public static function stochf(array $high, array $low, array $close, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        return self::getBackend()->stochf($high, $low, $close, $fastKPeriod, $fastDPeriod, $fastDMaType);
    }

    public static function stochrsi(array $values, int $period = 14, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        return self::getBackend()->stochrsi($values, $period, $fastKPeriod, $fastDPeriod, $fastDMaType);
    }

    public static function trix(array $values, int $period = 30): array
    {
        return self::getBackend()->trix($values, $period);
    }

    public static function ultosc(array $high, array $low, array $close, int $period1 = 7, int $period2 = 14, int $period3 = 28): array
    {
        return self::getBackend()->ultosc($high, $low, $close, $period1, $period2, $period3);
    }

    public static function willr(array $high, array $low, array $close, int $period = 14): array
    {
        return self::getBackend()->willr($high, $low, $close, $period);
    }

    public static function ht_dcperiod(array $values): array
    {
        return self::getBackend()->ht_dcperiod($values);
    }

    public static function ht_dcphase(array $values): array
    {
        return self::getBackend()->ht_dcphase($values);
    }

    public static function ht_phasor(array $values): array
    {
        return self::getBackend()->ht_phasor($values);
    }

    public static function ht_sine(array $values): array
    {
        return self::getBackend()->ht_sine($values);
    }

    public static function ht_trendmode(array $values): array
    {
        return self::getBackend()->ht_trendmode($values);
    }

    public static function ad(array $high, array $low, array $close, array $volume): array
    {
        return self::getBackend()->ad($high, $low, $close, $volume);
    }

    public static function adosc(array $high, array $low, array $close, array $volume, int $fastPeriod = 3, int $slowPeriod = 10): array
    {
        return self::getBackend()->adosc($high, $low, $close, $volume, $fastPeriod, $slowPeriod);
    }

    public static function obv(array $values, array $volume): array
    {
        return self::getBackend()->obv($values, $volume);
    }

    public static function cdl2crows(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl2crows($open, $high, $low, $close);
    }

    public static function cdl3blackcrows(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl3blackcrows($open, $high, $low, $close);
    }

    public static function cdl3inside(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl3inside($open, $high, $low, $close);
    }

    public static function cdl3linestrike(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl3linestrike($open, $high, $low, $close);
    }

    public static function cdl3outside(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl3outside($open, $high, $low, $close);
    }

    public static function cdl3starsinsouth(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl3starsinsouth($open, $high, $low, $close);
    }

    public static function cdl3whitesoldiers(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdl3whitesoldiers($open, $high, $low, $close);
    }

    public static function cdlabandonedbaby(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdlabandonedbaby($open, $high, $low, $close, $penetration);
    }

    public static function cdladvanceblock(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdladvanceblock($open, $high, $low, $close);
    }

    public static function cdlbelthold(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlbelthold($open, $high, $low, $close);
    }

    public static function cdlbreakaway(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlbreakaway($open, $high, $low, $close);
    }

    public static function cdlclosingmarubozu(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlclosingmarubozu($open, $high, $low, $close);
    }

    public static function cdlconcealbabyswall(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlconcealbabyswall($open, $high, $low, $close);
    }

    public static function cdlcounterattack(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlcounterattack($open, $high, $low, $close);
    }

    public static function cdldarkcloudcover(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdldarkcloudcover($open, $high, $low, $close, $penetration);
    }

    public static function cdldoji(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdldoji($open, $high, $low, $close);
    }

    public static function cdldojistar(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdldojistar($open, $high, $low, $close);
    }

    public static function cdldragonflydoji(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdldragonflydoji($open, $high, $low, $close);
    }

    public static function cdlengulfing(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlengulfing($open, $high, $low, $close);
    }

    public static function cdleveningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdleveningdojistar($open, $high, $low, $close, $penetration);
    }

    public static function cdleveningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdleveningstar($open, $high, $low, $close, $penetration);
    }

    public static function cdlgapsidesidewhite(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlgapsidesidewhite($open, $high, $low, $close);
    }

    public static function cdlgravestonedoji(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlgravestonedoji($open, $high, $low, $close);
    }

    public static function cdlhammer(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlhammer($open, $high, $low, $close);
    }

    public static function cdlhangingman(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlhangingman($open, $high, $low, $close);
    }

    public static function cdlharami(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlharami($open, $high, $low, $close);
    }

    public static function cdlharamicross(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlharamicross($open, $high, $low, $close);
    }

    public static function cdlhighwave(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlhighwave($open, $high, $low, $close);
    }

    public static function cdlhikkake(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlhikkake($open, $high, $low, $close);
    }

    public static function cdlhikkakemod(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlhikkakemod($open, $high, $low, $close);
    }

    public static function cdlhomingpigeon(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlhomingpigeon($open, $high, $low, $close);
    }

    public static function cdlidentical3crows(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlidentical3crows($open, $high, $low, $close);
    }

    public static function cdlinneck(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlinneck($open, $high, $low, $close);
    }

    public static function cdlinvertedhammer(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlinvertedhammer($open, $high, $low, $close);
    }

    public static function cdlkicking(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlkicking($open, $high, $low, $close);
    }

    public static function cdlkickingbylength(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlkickingbylength($open, $high, $low, $close);
    }

    public static function cdlladderbottom(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlladderbottom($open, $high, $low, $close);
    }

    public static function cdllongleggeddoji(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdllongleggeddoji($open, $high, $low, $close);
    }

    public static function cdllongline(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdllongline($open, $high, $low, $close);
    }

    public static function cdlmarubozu(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlmarubozu($open, $high, $low, $close);
    }

    public static function cdlmatchinglow(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlmatchinglow($open, $high, $low, $close);
    }

    public static function cdlmathold(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdlmathold($open, $high, $low, $close, $penetration);
    }

    public static function cdlmorningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdlmorningdojistar($open, $high, $low, $close, $penetration);
    }

    public static function cdlmorningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return self::getBackend()->cdlmorningstar($open, $high, $low, $close, $penetration);
    }

    public static function cdlonneck(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlonneck($open, $high, $low, $close);
    }

    public static function cdlpiercing(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlpiercing($open, $high, $low, $close);
    }

    public static function cdlrickshawman(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlrickshawman($open, $high, $low, $close);
    }

    public static function cdlrisefall3methods(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlrisefall3methods($open, $high, $low, $close);
    }

    public static function cdlseparatinglines(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlseparatinglines($open, $high, $low, $close);
    }

    public static function cdlshootingstar(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlshootingstar($open, $high, $low, $close);
    }

    public static function cdlshortline(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlshortline($open, $high, $low, $close);
    }

    public static function cdlspinningtop(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlspinningtop($open, $high, $low, $close);
    }

    public static function cdlstalledpattern(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlstalledpattern($open, $high, $low, $close);
    }

    public static function cdlsticksandwich(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlsticksandwich($open, $high, $low, $close);
    }

    public static function cdltakuri(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdltakuri($open, $high, $low, $close);
    }

    public static function cdltasukigap(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdltasukigap($open, $high, $low, $close);
    }

    public static function cdlthrusting(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlthrusting($open, $high, $low, $close);
    }

    public static function cdltristar(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdltristar($open, $high, $low, $close);
    }

    public static function cdlunique3river(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlunique3river($open, $high, $low, $close);
    }

    public static function cdlupsidegap2crows(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlupsidegap2crows($open, $high, $low, $close);
    }

    public static function cdlxsidegap3methods(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->cdlxsidegap3methods($open, $high, $low, $close);
    }

    public static function beta(array $valuesA, array $valuesB, int $period = 5): array
    {
        return self::getBackend()->beta($valuesA, $valuesB, $period);
    }

    public static function correl(array $valuesA, array $valuesB, int $period = 30): array
    {
        return self::getBackend()->correl($valuesA, $valuesB, $period);
    }

    public static function linearreg(array $values, int $period = 14): array
    {
        return self::getBackend()->linearreg($values, $period);
    }

    public static function linearreg_angle(array $values, int $period = 14): array
    {
        return self::getBackend()->linearreg_angle($values, $period);
    }

    public static function linearreg_intercept(array $values, int $period = 14): array
    {
        return self::getBackend()->linearreg_intercept($values, $period);
    }

    public static function linearreg_slope(array $values, int $period = 14): array
    {
        return self::getBackend()->linearreg_slope($values, $period);
    }

    public static function stddev(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        return self::getBackend()->stddev($values, $period, $nbDev);
    }

    public static function tsf(array $values, int $period = 14): array
    {
        return self::getBackend()->tsf($values, $period);
    }

    public static function var(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        return self::getBackend()->var($values, $period, $nbDev);
    }

    public static function avgprice(array $open, array $high, array $low, array $close): array
    {
        return self::getBackend()->avgprice($open, $high, $low, $close);
    }

    public static function avgdev(array $values, int $period = 14): array
    {
        return self::getBackend()->avgdev($values, $period);
    }

    public static function medprice(array $high, array $low): array
    {
        return self::getBackend()->medprice($high, $low);
    }

    public static function typprice(array $high, array $low, array $close): array
    {
        return self::getBackend()->typprice($high, $low, $close);
    }

    public static function wclprice(array $high, array $low, array $close): array
    {
        return self::getBackend()->wclprice($high, $low, $close);
    }

    public static function acos(array $values): array
    {
        return self::getBackend()->acos($values);
    }

    public static function asin(array $values): array
    {
        return self::getBackend()->asin($values);
    }

    public static function atan(array $values): array
    {
        return self::getBackend()->atan($values);
    }

    public static function ceil(array $values): array
    {
        return self::getBackend()->ceil($values);
    }

    public static function cos(array $values): array
    {
        return self::getBackend()->cos($values);
    }

    public static function cosh(array $values): array
    {
        return self::getBackend()->cosh($values);
    }

    public static function exp(array $values): array
    {
        return self::getBackend()->exp($values);
    }

    public static function floor(array $values): array
    {
        return self::getBackend()->floor($values);
    }

    public static function ln(array $values): array
    {
        return self::getBackend()->ln($values);
    }

    public static function log10(array $values): array
    {
        return self::getBackend()->log10($values);
    }

    public static function sin(array $values): array
    {
        return self::getBackend()->sin($values);
    }

    public static function sinh(array $values): array
    {
        return self::getBackend()->sinh($values);
    }

    public static function sqrt(array $values): array
    {
        return self::getBackend()->sqrt($values);
    }

    public static function tan(array $values): array
    {
        return self::getBackend()->tan($values);
    }

    public static function tanh(array $values): array
    {
        return self::getBackend()->tanh($values);
    }

    public static function add(array $valuesA, array $valuesB): array
    {
        return self::getBackend()->add($valuesA, $valuesB);
    }

    public static function sub(array $valuesA, array $valuesB): array
    {
        return self::getBackend()->sub($valuesA, $valuesB);
    }

    public static function mult(array $valuesA, array $valuesB): array
    {
        return self::getBackend()->mult($valuesA, $valuesB);
    }

    public static function div(array $valuesA, array $valuesB): array
    {
        return self::getBackend()->div($valuesA, $valuesB);
    }

    public static function sum(array $values, int $period = 30): array
    {
        return self::getBackend()->sum($values, $period);
    }

    public static function max(array $values, int $period = 30): array
    {
        return self::getBackend()->max($values, $period);
    }

    public static function min(array $values, int $period = 30): array
    {
        return self::getBackend()->min($values, $period);
    }

    public static function maxindex(array $values, int $period = 30): array
    {
        return self::getBackend()->maxindex($values, $period);
    }

    public static function minindex(array $values, int $period = 30): array
    {
        return self::getBackend()->minindex($values, $period);
    }

    public static function minmax(array $values, int $period = 30): array
    {
        return self::getBackend()->minmax($values, $period);
    }

    public static function minmaxindex(array $values, int $period = 30): array
    {
        return self::getBackend()->minmaxindex($values, $period);
    }
}

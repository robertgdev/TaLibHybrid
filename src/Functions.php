<?php

declare(strict_types=1);

use RobertGDev\TaLibHybrid\TaLibHybrid;

if (! function_exists('ta_version')) {
    function ta_version(): string
    {
        return TaLibHybrid::version();
    }

    function ta_set_unstable_period(int $functionId, int $timePeriod): void
    {
        TaLibHybrid::setUnstablePeriod($functionId, $timePeriod);
    }

    function ta_get_unstable_period(int $functionId): int
    {
        return TaLibHybrid::getUnstablePeriod($functionId);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
      * @return array<string, array<int, float|int|null>>
     */
    function ta_accbands(array $high, array $low, array $close, int $period = 20): array
    {
        return TaLibHybrid::accbands($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_bbands(array $values, int $period = 5, float $nbDevUp = 2.0, float $nbDevDn = 2.0, int $maType = 0): array
    {
        return TaLibHybrid::bbands($values, $period, $nbDevUp, $nbDevDn, $maType);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_dema(array $values, int $period): array
    {
        return TaLibHybrid::dema($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ema(array $values, int $period): array
    {
        return TaLibHybrid::ema($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ht_trendline(array $values): array
    {
        return TaLibHybrid::ht_trendline($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_kama(array $values, int $period): array
    {
        return TaLibHybrid::kama($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ma(array $values, int $period = 30, int $maType = 0): array
    {
        return TaLibHybrid::ma($values, $period, $maType);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_mama(array $values, float $fastLimit = 0.5, float $slowLimit = 0.05): array
    {
        return TaLibHybrid::mama($values, $fastLimit, $slowLimit);
    }

    /**
     * @param array<int, float|int|null> $values
     * @param array<int, int> $periods
     * @return array<int, float|int|null>
     */
    function ta_mavp(array $values, array $periods, int $minPeriod = 2, int $maxPeriod = 30, int $maType = 0): array
    {
        return TaLibHybrid::mavp($values, $periods, $minPeriod, $maxPeriod, $maType);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_midpoint(array $values, int $period = 14): array
    {
        return TaLibHybrid::midpoint($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_midprice(array $high, array $low, int $period = 14): array
    {
        return TaLibHybrid::midprice($high, $low, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_sar(array $high, array $low, float $acceleration = 0.02, float $maximum = 0.20): array
    {
        return TaLibHybrid::sar($high, $low, $acceleration, $maximum);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_sarext(array $high, array $low, float $startValue = 0.0, float $offsetOnReverse = 0.0, float $accelerationInitLong = 0.02, float $accelerationLong = 0.02, float $accelerationMaxLong = 0.20, float $accelerationInitShort = 0.02, float $accelerationShort = 0.02, float $accelerationMaxShort = 0.20): array
    {
        return TaLibHybrid::sarext($high, $low, $startValue, $offsetOnReverse, $accelerationInitLong, $accelerationLong, $accelerationMaxLong, $accelerationInitShort, $accelerationShort, $accelerationMaxShort);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_sma(array $values, int $period): array
    {
        return TaLibHybrid::sma($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_t3(array $values, int $period, float $vFactor = 0.7): array
    {
        return TaLibHybrid::t3($values, $period, $vFactor);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_tema(array $values, int $period): array
    {
        return TaLibHybrid::tema($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_trima(array $values, int $period): array
    {
        return TaLibHybrid::trima($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_wma(array $values, int $period): array
    {
        return TaLibHybrid::wma($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_atr(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::atr($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_natr(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::natr($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_trange(array $high, array $low, array $close): array
    {
        return TaLibHybrid::trange($high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_adx(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::adx($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_adxr(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::adxr($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_apo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        return TaLibHybrid::apo($values, $fastPeriod, $slowPeriod, $maType);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
      * @return array<string, array<int, float|int|null>>
     */
    function ta_aroon(array $high, array $low, int $period = 14): array
    {
        return TaLibHybrid::aroon($high, $low, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_aroonosc(array $high, array $low, int $period = 14): array
    {
        return TaLibHybrid::aroonosc($high, $low, $period);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_bop(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::bop($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cci(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::cci($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_cmo(array $values, int $period = 14): array
    {
        return TaLibHybrid::cmo($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_dx(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::dx($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_imi(array $open, array $close, int $period = 14): array
    {
        return TaLibHybrid::imi($open, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_macd(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $signalPeriod = 9): array
    {
        return TaLibHybrid::macd($values, $fastPeriod, $slowPeriod, $signalPeriod);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_macdext(array $values, int $fastPeriod = 12, int $fastMaType = 0, int $slowPeriod = 26, int $slowMaType = 0, int $signalPeriod = 9, int $signalMaType = 0): array
    {
        return TaLibHybrid::macdext($values, $fastPeriod, $fastMaType, $slowPeriod, $slowMaType, $signalPeriod, $signalMaType);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_macdfix(array $values, int $signalPeriod = 9): array
    {
        return TaLibHybrid::macdfix($values, $signalPeriod);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @param array<int, float|int|null> $volume
     * @return array<int, float|int|null>
     */
    function ta_mfi(array $high, array $low, array $close, array $volume, int $period = 14): array
    {
        return TaLibHybrid::mfi($high, $low, $close, $volume, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_minus_di(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::minus_di($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_minus_dm(array $high, array $low, int $period = 14): array
    {
        return TaLibHybrid::minus_dm($high, $low, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_mom(array $values, int $period = 10): array
    {
        return TaLibHybrid::mom($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_plus_di(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::plus_di($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_plus_dm(array $high, array $low, int $period = 14): array
    {
        return TaLibHybrid::plus_dm($high, $low, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ppo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        return TaLibHybrid::ppo($values, $fastPeriod, $slowPeriod, $maType);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_roc(array $values, int $period = 10): array
    {
        return TaLibHybrid::roc($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_rocp(array $values, int $period = 10): array
    {
        return TaLibHybrid::rocp($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_rocr(array $values, int $period = 10): array
    {
        return TaLibHybrid::rocr($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_rocr100(array $values, int $period = 10): array
    {
        return TaLibHybrid::rocr100($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_rsi(array $values, int $period = 14): array
    {
        return TaLibHybrid::rsi($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
      * @return array<string, array<int, float|int|null>>
     */
    function ta_stoch(array $high, array $low, array $close, int $fastKPeriod = 5, int $slowKPeriod = 3, int $slowKMaType = 0, int $slowDPeriod = 3, int $slowDMaType = 0): array
    {
        return TaLibHybrid::stoch($high, $low, $close, $fastKPeriod, $slowKPeriod, $slowKMaType, $slowDPeriod, $slowDMaType);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
      * @return array<string, array<int, float|int|null>>
     */
    function ta_stochf(array $high, array $low, array $close, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        return TaLibHybrid::stochf($high, $low, $close, $fastKPeriod, $fastDPeriod, $fastDMaType);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_stochrsi(array $values, int $period = 14, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        return TaLibHybrid::stochrsi($values, $period, $fastKPeriod, $fastDPeriod, $fastDMaType);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_trix(array $values, int $period = 30): array
    {
        return TaLibHybrid::trix($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_ultosc(array $high, array $low, array $close, int $period1 = 7, int $period2 = 14, int $period3 = 28): array
    {
        return TaLibHybrid::ultosc($high, $low, $close, $period1, $period2, $period3);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_willr(array $high, array $low, array $close, int $period = 14): array
    {
        return TaLibHybrid::willr($high, $low, $close, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ht_dcperiod(array $values): array
    {
        return TaLibHybrid::ht_dcperiod($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ht_dcphase(array $values): array
    {
        return TaLibHybrid::ht_dcphase($values);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_ht_phasor(array $values): array
    {
        return TaLibHybrid::ht_phasor($values);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_ht_sine(array $values): array
    {
        return TaLibHybrid::ht_sine($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ht_trendmode(array $values): array
    {
        return TaLibHybrid::ht_trendmode($values);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @param array<int, float|int|null> $volume
     * @return array<int, float|int|null>
     */
    function ta_ad(array $high, array $low, array $close, array $volume): array
    {
        return TaLibHybrid::ad($high, $low, $close, $volume);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @param array<int, float|int|null> $volume
     * @return array<int, float|int|null>
     */
    function ta_adosc(array $high, array $low, array $close, array $volume, int $fastPeriod = 3, int $slowPeriod = 10): array
    {
        return TaLibHybrid::adosc($high, $low, $close, $volume, $fastPeriod, $slowPeriod);
    }

    /**
     * @param array<int, float|int|null> $values
     * @param array<int, float|int|null> $volume
     * @return array<int, float|int|null>
     */
    function ta_obv(array $values, array $volume): array
    {
        return TaLibHybrid::obv($values, $volume);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl2crows(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl2crows($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl3blackcrows(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl3blackcrows($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl3inside(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl3inside($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl3linestrike(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl3linestrike($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl3outside(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl3outside($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl3starsinsouth(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl3starsinsouth($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdl3whitesoldiers(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdl3whitesoldiers($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlabandonedbaby(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdlabandonedbaby($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdladvanceblock(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdladvanceblock($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlbelthold(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlbelthold($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlbreakaway(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlbreakaway($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlclosingmarubozu(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlclosingmarubozu($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlconcealbabyswall(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlconcealbabyswall($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlcounterattack(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlcounterattack($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdldarkcloudcover(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdldarkcloudcover($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdldoji(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdldoji($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdldojistar(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdldojistar($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdldragonflydoji(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdldragonflydoji($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlengulfing(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlengulfing($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdleveningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdleveningdojistar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdleveningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdleveningstar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlgapsidesidewhite(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlgapsidesidewhite($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlgravestonedoji(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlgravestonedoji($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlhammer(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlhammer($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlhangingman(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlhangingman($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlharami(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlharami($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlharamicross(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlharamicross($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlhighwave(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlhighwave($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlhikkake(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlhikkake($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlhikkakemod(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlhikkakemod($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlhomingpigeon(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlhomingpigeon($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlidentical3crows(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlidentical3crows($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlinneck(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlinneck($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlinvertedhammer(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlinvertedhammer($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlkicking(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlkicking($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlkickingbylength(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlkickingbylength($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlladderbottom(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlladderbottom($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdllongleggeddoji(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdllongleggeddoji($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdllongline(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdllongline($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlmarubozu(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlmarubozu($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlmatchinglow(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlmatchinglow($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlmathold(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdlmathold($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlmorningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdlmorningdojistar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlmorningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return TaLibHybrid::cdlmorningstar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlonneck(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlonneck($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlpiercing(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlpiercing($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlrickshawman(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlrickshawman($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlrisefall3methods(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlrisefall3methods($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlseparatinglines(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlseparatinglines($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlshootingstar(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlshootingstar($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlshortline(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlshortline($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlspinningtop(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlspinningtop($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlstalledpattern(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlstalledpattern($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlsticksandwich(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlsticksandwich($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdltakuri(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdltakuri($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdltasukigap(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdltasukigap($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlthrusting(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlthrusting($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdltristar(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdltristar($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlunique3river(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlunique3river($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlupsidegap2crows(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlupsidegap2crows($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_cdlxsidegap3methods(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::cdlxsidegap3methods($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $valuesA
     * @param array<int, float|int|null> $valuesB
     * @return array<int, float|int|null>
     */
    function ta_beta(array $valuesA, array $valuesB, int $period = 5): array
    {
        return TaLibHybrid::beta($valuesA, $valuesB, $period);
    }

    /**
     * @param array<int, float|int|null> $valuesA
     * @param array<int, float|int|null> $valuesB
     * @return array<int, float|int|null>
     */
    function ta_correl(array $valuesA, array $valuesB, int $period = 30): array
    {
        return TaLibHybrid::correl($valuesA, $valuesB, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_linearreg(array $values, int $period = 14): array
    {
        return TaLibHybrid::linearreg($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_linearreg_angle(array $values, int $period = 14): array
    {
        return TaLibHybrid::linearreg_angle($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_linearreg_intercept(array $values, int $period = 14): array
    {
        return TaLibHybrid::linearreg_intercept($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_linearreg_slope(array $values, int $period = 14): array
    {
        return TaLibHybrid::linearreg_slope($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_stddev(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        return TaLibHybrid::stddev($values, $period, $nbDev);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_tsf(array $values, int $period = 14): array
    {
        return TaLibHybrid::tsf($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_var(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        return TaLibHybrid::var($values, $period, $nbDev);
    }

    /**
     * @param array<int, float|int|null> $open
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_avgprice(array $open, array $high, array $low, array $close): array
    {
        return TaLibHybrid::avgprice($open, $high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_avgdev(array $values, int $period = 14): array
    {
        return TaLibHybrid::avgdev($values, $period);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @return array<int, float|int|null>
     */
    function ta_medprice(array $high, array $low): array
    {
        return TaLibHybrid::medprice($high, $low);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_typprice(array $high, array $low, array $close): array
    {
        return TaLibHybrid::typprice($high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $high
     * @param array<int, float|int|null> $low
     * @param array<int, float|int|null> $close
     * @return array<int, float|int|null>
     */
    function ta_wclprice(array $high, array $low, array $close): array
    {
        return TaLibHybrid::wclprice($high, $low, $close);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_acos(array $values): array
    {
        return TaLibHybrid::acos($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_asin(array $values): array
    {
        return TaLibHybrid::asin($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_atan(array $values): array
    {
        return TaLibHybrid::atan($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ceil(array $values): array
    {
        return TaLibHybrid::ceil($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_cos(array $values): array
    {
        return TaLibHybrid::cos($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_cosh(array $values): array
    {
        return TaLibHybrid::cosh($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_exp(array $values): array
    {
        return TaLibHybrid::exp($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_floor(array $values): array
    {
        return TaLibHybrid::floor($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_ln(array $values): array
    {
        return TaLibHybrid::ln($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_log10(array $values): array
    {
        return TaLibHybrid::log10($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_sin(array $values): array
    {
        return TaLibHybrid::sin($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_sinh(array $values): array
    {
        return TaLibHybrid::sinh($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_sqrt(array $values): array
    {
        return TaLibHybrid::sqrt($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_tan(array $values): array
    {
        return TaLibHybrid::tan($values);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_tanh(array $values): array
    {
        return TaLibHybrid::tanh($values);
    }

    /**
     * @param array<int, float|int|null> $valuesA
     * @param array<int, float|int|null> $valuesB
     * @return array<int, float|int|null>
     */
    function ta_add(array $valuesA, array $valuesB): array
    {
        return TaLibHybrid::add($valuesA, $valuesB);
    }

    /**
     * @param array<int, float|int|null> $valuesA
     * @param array<int, float|int|null> $valuesB
     * @return array<int, float|int|null>
     */
    function ta_sub(array $valuesA, array $valuesB): array
    {
        return TaLibHybrid::sub($valuesA, $valuesB);
    }

    /**
     * @param array<int, float|int|null> $valuesA
     * @param array<int, float|int|null> $valuesB
     * @return array<int, float|int|null>
     */
    function ta_mult(array $valuesA, array $valuesB): array
    {
        return TaLibHybrid::mult($valuesA, $valuesB);
    }

    /**
     * @param array<int, float|int|null> $valuesA
     * @param array<int, float|int|null> $valuesB
     * @return array<int, float|int|null>
     */
    function ta_div(array $valuesA, array $valuesB): array
    {
        return TaLibHybrid::div($valuesA, $valuesB);
    }

    /**
     * @param array<int, float|int|null> $values
     * @return array<int, float|int|null>
     */
    function ta_sum(array $values, int $period = 30): array
    {
        return TaLibHybrid::sum($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_max(array $values, int $period = 30): array
    {
        return TaLibHybrid::max($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_min(array $values, int $period = 30): array
    {
        return TaLibHybrid::min($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<int, int|null>
     */
    function ta_maxindex(array $values, int $period = 30): array
    {
        return TaLibHybrid::maxindex($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<int, int|null>
     */
    function ta_minindex(array $values, int $period = 30): array
    {
        return TaLibHybrid::minindex($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, float|int|null>>
     */
    function ta_minmax(array $values, int $period = 30): array
    {
        return TaLibHybrid::minmax($values, $period);
    }

    /**
     * @param array<int, float|int|null> $values
      * @return array<string, array<int, int|null>>
     */
    function ta_minmaxindex(array $values, int $period = 30): array
    {
        return TaLibHybrid::minmaxindex($values, $period);
    }
}


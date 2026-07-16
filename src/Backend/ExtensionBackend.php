<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Backend;

class ExtensionBackend implements BackendInterface
{
    private ?FallbackBackend $fallback = null;

    private function fallback(): FallbackBackend
    {
        if ($this->fallback === null) {
            $this->fallback = new FallbackBackend;
        }

        return $this->fallback;
    }

    public function isExtensionAvailable(): bool
    {
        return true;
    }

    public function version(): string
    {
        return ta_version();
    }

    public function setUnstablePeriod(int $functionId, int $timePeriod): void {}

    public function getUnstablePeriod(int $functionId): int
    {
        return 0;
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int  $period        Number of periods.
     * @return array<string, array<int, float|int|null>>
     */
    public function accbands(array $high, array $low, array $close, int $period = 20): array
    {
        return ta_accbands($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int             $period  Number of periods.
     * @param  float                    $nbDevUp
     * @param  float                    $nbDevDn
     * @param  int                      $maType
     * @return array<string, array<int, float|int|null>>
     */
    public function bbands(array $values, int $period = 5, float $nbDevUp = 2.0, float $nbDevDn = 2.0, int $maType = 0): array
    {
        return ta_bbands($values, $period, $nbDevUp, $nbDevDn, $maType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function dema(array $values, int $period): array
    {
        return ta_dema($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function ema(array $values, int $period): array
    {
        return ta_ema($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_trendline(array $values): array
    {
        return ta_ht_trendline($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function kama(array $values, int $period): array
    {
        return ta_kama($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @param  int                         $maType
     * @return array<int, float|int|null>
     */
    public function ma(array $values, int $period = 30, int $maType = 0): array
    {
        return ta_ma($values, $period, $maType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  float                       $fastLimit
     * @param  float                       $slowLimit
     * @return array<string, array<int, float|int|null>>
     */
    public function mama(array $values, float $fastLimit = 0.5, float $slowLimit = 0.05): array
    {
        return $this->fallback()->mama($values, $fastLimit, $slowLimit);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  array<int, int>             $periods
     * @param  positive-int                $minPeriod  Minimum period.
     * @param  positive-int                $maxPeriod  Maximum period.
     * @param  int                         $maType
     * @return array<int, float|int|null>
     */
    public function mavp(array $values, array $periods, int $minPeriod = 2, int $maxPeriod = 30, int $maType = 0): array
    {
        return ta_mavp($values, $periods, $minPeriod, $maxPeriod, $maType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function midpoint(array $values, int $period = 14): array
    {
        return ta_midpoint($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function midprice(array $high, array $low, int $period = 14): array
    {
        return ta_midprice($high, $low, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  float                       $acceleration
     * @param  float                       $maximum
     * @return array<int, float|int|null>
     */
    public function sar(array $high, array $low, float $acceleration = 0.02, float $maximum = 0.20): array
    {
        return ta_sar($high, $low, $acceleration, $maximum);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  float                       $startValue
     * @param  float                       $offsetOnReverse
     * @param  float                       $accelerationInitLong
     * @param  float                       $accelerationLong
     * @param  float                       $accelerationMaxLong
     * @param  float                       $accelerationInitShort
     * @param  float                       $accelerationShort
     * @param  float                       $accelerationMaxShort
     * @return array<int, float|int|null>
     */
    public function sarext(array $high, array $low, float $startValue = 0.0, float $offsetOnReverse = 0.0, float $accelerationInitLong = 0.02, float $accelerationLong = 0.02, float $accelerationMaxLong = 0.20, float $accelerationInitShort = 0.02, float $accelerationShort = 0.02, float $accelerationMaxShort = 0.20): array
    {
        return ta_sarext($high, $low, $startValue, $offsetOnReverse, $accelerationInitLong, $accelerationLong, $accelerationMaxLong, $accelerationInitShort, $accelerationShort, $accelerationMaxShort);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function sma(array $values, int $period): array
    {
        return ta_sma($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @param  float                       $vFactor
     * @return array<int, float|int|null>
     */
    public function t3(array $values, int $period, float $vFactor = 0.7): array
    {
        return ta_t3($values, $period, $vFactor);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function tema(array $values, int $period): array
    {
        return ta_tema($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function trima(array $values, int $period): array
    {
        return ta_trima($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function wma(array $values, int $period): array
    {
        return ta_wma($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function atr(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_atr($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function natr(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_natr($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function trange(array $high, array $low, array $close): array
    {
        return ta_trange($high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function adx(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_adx($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function adxr(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_adxr($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $fastPeriod  Number of periods for fast moving average.
     * @param  positive-int                $slowPeriod  Number of periods for slow moving average.
     * @param  int                         $maType
     * @return array<int, float|int|null>
     */
    public function apo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        return ta_apo($values, $fastPeriod, $slowPeriod, $maType);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  positive-int                $period  Number of periods.
     * @return array<string, array<int, float|int|null>>
     */
    public function aroon(array $high, array $low, int $period = 14): array
    {
        return ta_aroon($high, $low, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function aroonosc(array $high, array $low, int $period = 14): array
    {
        return ta_aroonosc($high, $low, $period);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function bop(array $open, array $high, array $low, array $close): array
    {
        return ta_bop($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function cci(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_cci($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function cmo(array $values, int $period = 14): array
    {
        return ta_cmo($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function dx(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_dx($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function imi(array $open, array $close, int $period = 14): array
    {
        return ta_imi($open, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $fastPeriod    Number of periods for fast moving average.
     * @param  positive-int                $slowPeriod    Number of periods for slow moving average.
     * @param  positive-int                $signalPeriod  Number of periods for signal line.
     * @return array<string, array<int, float|int|null>>
     */
    public function macd(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $signalPeriod = 9): array
    {
        return ta_macd($values, $fastPeriod, $slowPeriod, $signalPeriod);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $fastPeriod     Number of periods for fast moving average.
     * @param  int                         $fastMaType
     * @param  positive-int                $slowPeriod     Number of periods for slow moving average.
     * @param  int                         $slowMaType
     * @param  positive-int                $signalPeriod   Number of periods for signal line.
     * @param  int                         $signalMaType
     * @return array<string, array<int, float|int|null>>
     */
    public function macdext(array $values, int $fastPeriod = 12, int $fastMaType = 0, int $slowPeriod = 26, int $slowMaType = 0, int $signalPeriod = 9, int $signalMaType = 0): array
    {
        return ta_macdext($values, $fastPeriod, $fastMaType, $slowPeriod, $slowMaType, $signalPeriod, $signalMaType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $signalPeriod  Number of periods for signal line.
     * @return array<string, array<int, float|int|null>>
     */
    public function macdfix(array $values, int $signalPeriod = 9): array
    {
        return ta_macdfix($values, $signalPeriod);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  array<int, float|int|null>  $volume
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function mfi(array $high, array $low, array $close, array $volume, int $period = 14): array
    {
        return ta_mfi($high, $low, $close, $volume, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function minus_di(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_minus_di($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function minus_dm(array $high, array $low, int $period = 14): array
    {
        return ta_minus_dm($high, $low, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function mom(array $values, int $period = 10): array
    {
        return $this->fallback()->mom($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function plus_di(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_plus_di($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function plus_dm(array $high, array $low, int $period = 14): array
    {
        return ta_plus_dm($high, $low, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $fastPeriod  Number of periods for fast moving average.
     * @param  positive-int                $slowPeriod  Number of periods for slow moving average.
     * @param  int                         $maType
     * @return array<int, float|int|null>
     */
    public function ppo(array $values, int $fastPeriod = 12, int $slowPeriod = 26, int $maType = 0): array
    {
        return ta_ppo($values, $fastPeriod, $slowPeriod, $maType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function roc(array $values, int $period = 10): array
    {
        return ta_roc($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function rocp(array $values, int $period = 10): array
    {
        return ta_rocp($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function rocr(array $values, int $period = 10): array
    {
        return ta_rocr($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function rocr100(array $values, int $period = 10): array
    {
        return ta_rocr100($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function rsi(array $values, int $period = 14): array
    {
        return ta_rsi($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $fastKPeriod  Number of periods for fast %K line.
     * @param  positive-int                $slowKPeriod  Number of periods for slow %K line.
     * @param  int                         $slowKMaType
     * @param  positive-int                $slowDPeriod  Number of periods for slow %D line.
     * @param  int                         $slowDMaType
     * @return array<string, array<int, float|int|null>>
     */
    public function stoch(array $high, array $low, array $close, int $fastKPeriod = 5, int $slowKPeriod = 3, int $slowKMaType = 0, int $slowDPeriod = 3, int $slowDMaType = 0): array
    {
        return ta_stoch($high, $low, $close, $fastKPeriod, $slowKPeriod, $slowKMaType, $slowDPeriod, $slowDMaType);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $fastKPeriod  Number of periods for fast %K line.
     * @param  positive-int                $fastDPeriod  Number of periods for fast %D line.
     * @param  int                         $fastDMaType
     * @return array<string, array<int, float|int|null>>
     */
    public function stochf(array $high, array $low, array $close, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        return ta_stochf($high, $low, $close, $fastKPeriod, $fastDPeriod, $fastDMaType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period       Number of periods.
     * @param  positive-int                $fastKPeriod  Number of periods for fast %K line.
     * @param  positive-int                $fastDPeriod  Number of periods for fast %D line.
     * @param  int                         $fastDMaType
     * @return array<string, array<int, float|int|null>>
     */
    public function stochrsi(array $values, int $period = 14, int $fastKPeriod = 5, int $fastDPeriod = 3, int $fastDMaType = 0): array
    {
        return ta_stochrsi($values, $period, $fastKPeriod, $fastDPeriod, $fastDMaType);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function trix(array $values, int $period = 30): array
    {
        return ta_trix($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period1  Number of periods for first time frame.
     * @param  positive-int                $period2  Number of periods for second time frame.
     * @param  positive-int                $period3  Number of periods for third time frame.
     * @return array<int, float|int|null>
     */
    public function ultosc(array $high, array $low, array $close, int $period1 = 7, int $period2 = 14, int $period3 = 28): array
    {
        return ta_ultosc($high, $low, $close, $period1, $period2, $period3);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function willr(array $high, array $low, array $close, int $period = 14): array
    {
        return ta_willr($high, $low, $close, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_dcperiod(array $values): array
    {
        return ta_ht_dcperiod($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_dcphase(array $values): array
    {
        return ta_ht_dcphase($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function ht_phasor(array $values): array
    {
        return ta_ht_phasor($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<string, array<int, float|int|null>>
     */
    public function ht_sine(array $values): array
    {
        return ta_ht_sine($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ht_trendmode(array $values): array
    {
        return ta_ht_trendmode($values);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  array<int, float|int|null>  $volume
     * @return array<int, float|int|null>
     */
    public function ad(array $high, array $low, array $close, array $volume): array
    {
        return ta_ad($high, $low, $close, $volume);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  array<int, float|int|null>  $volume
     * @param  positive-int                $fastPeriod  Number of periods for fast moving average.
     * @param  positive-int                $slowPeriod  Number of periods for slow moving average.
     * @return array<int, float|int|null>
     */
    public function adosc(array $high, array $low, array $close, array $volume, int $fastPeriod = 3, int $slowPeriod = 10): array
    {
        return ta_adosc($high, $low, $close, $volume, $fastPeriod, $slowPeriod);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  array<int, float|int|null>  $volume
     * @return array<int, float|int|null>
     */
    public function obv(array $values, array $volume): array
    {
        return ta_obv($values, $volume);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl2crows(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl2crows($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3blackcrows(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl3blackcrows($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3inside(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl3inside($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3linestrike(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl3linestrike($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3outside(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl3outside($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3starsinsouth(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl3starsinsouth($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdl3whitesoldiers(array $open, array $high, array $low, array $close): array
    {
        return ta_cdl3whitesoldiers($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdlabandonedbaby(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdlabandonedbaby($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdladvanceblock(array $open, array $high, array $low, array $close): array
    {
        return ta_cdladvanceblock($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlbelthold(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlbelthold($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlbreakaway(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlbreakaway($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlclosingmarubozu(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlclosingmarubozu($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlconcealbabyswall(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlconcealbabyswall($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlcounterattack(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlcounterattack($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdldarkcloudcover(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdldarkcloudcover($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldoji(array $open, array $high, array $low, array $close): array
    {
        return ta_cdldoji($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldojistar(array $open, array $high, array $low, array $close): array
    {
        return ta_cdldojistar($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdldragonflydoji(array $open, array $high, array $low, array $close): array
    {
        return ta_cdldragonflydoji($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlengulfing(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlengulfing($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdleveningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdleveningdojistar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdleveningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdleveningstar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlgapsidesidewhite(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlgapsidesidewhite($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlgravestonedoji(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlgravestonedoji($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhammer(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlhammer($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhangingman(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlhangingman($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlharami(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlharami($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlharamicross(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlharamicross($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhighwave(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlhighwave($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhikkake(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlhikkake($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhikkakemod(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlhikkakemod($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlhomingpigeon(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlhomingpigeon($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlidentical3crows(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlidentical3crows($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlinneck(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlinneck($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlinvertedhammer(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlinvertedhammer($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlkicking(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlkicking($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlkickingbylength(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlkickingbylength($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlladderbottom(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlladderbottom($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdllongleggeddoji(array $open, array $high, array $low, array $close): array
    {
        return ta_cdllongleggeddoji($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdllongline(array $open, array $high, array $low, array $close): array
    {
        return ta_cdllongline($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmarubozu(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlmarubozu($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlmatchinglow(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlmatchinglow($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdlmathold(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdlmathold($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdlmorningdojistar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdlmorningdojistar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @param  float                       $penetration
     * @return array<int, float|int|null>
     */
    public function cdlmorningstar(array $open, array $high, array $low, array $close, float $penetration = 0.0): array
    {
        return ta_cdlmorningstar($open, $high, $low, $close, $penetration);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlonneck(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlonneck($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlpiercing(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlpiercing($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlrickshawman(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlrickshawman($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlrisefall3methods(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlrisefall3methods($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlseparatinglines(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlseparatinglines($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlshootingstar(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlshootingstar($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlshortline(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlshortline($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlspinningtop(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlspinningtop($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlstalledpattern(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlstalledpattern($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlsticksandwich(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlsticksandwich($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdltakuri(array $open, array $high, array $low, array $close): array
    {
        return ta_cdltakuri($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdltasukigap(array $open, array $high, array $low, array $close): array
    {
        return ta_cdltasukigap($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlthrusting(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlthrusting($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdltristar(array $open, array $high, array $low, array $close): array
    {
        return ta_cdltristar($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlunique3river(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlunique3river($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlupsidegap2crows(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlupsidegap2crows($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function cdlxsidegap3methods(array $open, array $high, array $low, array $close): array
    {
        return ta_cdlxsidegap3methods($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function beta(array $valuesA, array $valuesB, int $period = 5): array
    {
        return ta_beta($valuesA, $valuesB, $period);
    }

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function correl(array $valuesA, array $valuesB, int $period = 30): array
    {
        return ta_correl($valuesA, $valuesB, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function linearreg(array $values, int $period = 14): array
    {
        return ta_linearreg($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function linearreg_angle(array $values, int $period = 14): array
    {
        return ta_linearreg_angle($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function linearreg_intercept(array $values, int $period = 14): array
    {
        return ta_linearreg_intercept($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function linearreg_slope(array $values, int $period = 14): array
    {
        return ta_linearreg_slope($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @param  float                       $nbDev
     * @return array<int, float|int|null>
     */
    public function stddev(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        return ta_stddev($values, $period, $nbDev);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function tsf(array $values, int $period = 14): array
    {
        return ta_tsf($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @param  float                       $nbDev
     * @return array<int, float|int|null>
     */
    public function var(array $values, int $period = 5, float $nbDev = 1.0): array
    {
        return ta_var($values, $period, $nbDev);
    }

    /**
     * @param  array<int, float|int|null>  $open
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function avgprice(array $open, array $high, array $low, array $close): array
    {
        return ta_avgprice($open, $high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function avgdev(array $values, int $period = 14): array
    {
        return ta_avgdev($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @return array<int, float|int|null>
     */
    public function medprice(array $high, array $low): array
    {
        return ta_medprice($high, $low);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function typprice(array $high, array $low, array $close): array
    {
        return ta_typprice($high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $high
     * @param  array<int, float|int|null>  $low
     * @param  array<int, float|int|null>  $close
     * @return array<int, float|int|null>
     */
    public function wclprice(array $high, array $low, array $close): array
    {
        return ta_wclprice($high, $low, $close);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function acos(array $values): array
    {
        return ta_acos($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function asin(array $values): array
    {
        return ta_asin($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function atan(array $values): array
    {
        return ta_atan($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ceil(array $values): array
    {
        return ta_ceil($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function cos(array $values): array
    {
        return ta_cos($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function cosh(array $values): array
    {
        return ta_cosh($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function exp(array $values): array
    {
        return ta_exp($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function floor(array $values): array
    {
        return ta_floor($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function ln(array $values): array
    {
        return ta_ln($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function log10(array $values): array
    {
        return ta_log10($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sin(array $values): array
    {
        return ta_sin($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sinh(array $values): array
    {
        return ta_sinh($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function sqrt(array $values): array
    {
        return ta_sqrt($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function tan(array $values): array
    {
        return ta_tan($values);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @return array<int, float|int|null>
     */
    public function tanh(array $values): array
    {
        return ta_tanh($values);
    }

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function add(array $valuesA, array $valuesB): array
    {
        return ta_add($valuesA, $valuesB);
    }

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function sub(array $valuesA, array $valuesB): array
    {
        return ta_sub($valuesA, $valuesB);
    }

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function mult(array $valuesA, array $valuesB): array
    {
        return ta_mult($valuesA, $valuesB);
    }

    /**
     * @param  array<int, float|int|null>  $valuesA
     * @param  array<int, float|int|null>  $valuesB
     * @return array<int, float|int|null>
     */
    public function div(array $valuesA, array $valuesB): array
    {
        return ta_div($valuesA, $valuesB);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, float|int|null>
     */
    public function sum(array $values, int $period = 30): array
    {
        return ta_sum($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<string, array<int, float|int|null>>
     */
    public function max(array $values, int $period = 30): array
    {
        return ta_max($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<string, array<int, float|int|null>>
     */
    public function min(array $values, int $period = 30): array
    {
        return ta_min($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, int|null>
     */
    public function maxindex(array $values, int $period = 30): array
    {
        return ta_maxindex($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<int, int|null>
     */
    public function minindex(array $values, int $period = 30): array
    {
        return ta_minindex($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<string, array<int, float|int|null>>
     */
    public function minmax(array $values, int $period = 30): array
    {
        return ta_minmax($values, $period);
    }

    /**
     * @param  array<int, float|int|null>  $values
     * @param  positive-int                $period  Number of periods.
     * @return array<string, array<int, int|null>>
     */
    public function minmaxindex(array $values, int $period = 30): array
    {
        return ta_minmaxindex($values, $period);
    }
}

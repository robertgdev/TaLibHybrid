<?php

declare(strict_types=1);

use RobertGDev\TaLibHybrid\Backend\ExtensionBackend;
use RobertGDev\TaLibHybrid\Backend\FallbackBackend;

describe('Cross-backend: single-output overlap studies', function () {
    $close = generateClose(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('sma matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->sma($close, 10), $fb->sma($close, 10)))->toBeTrue();
    });

    test('ema matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->ema($close, 10), $fb->ema($close, 10)))->toBeTrue();
    });

    test('wma matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->wma($close, 10), $fb->wma($close, 10)))->toBeTrue();
    });

    test('dema matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->dema($close, 10), $fb->dema($close, 10)))->toBeTrue();
    });

    test('tema matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->tema($close, 10), $fb->tema($close, 10)))->toBeTrue();
    });

    test('trima matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->trima($close, 10), $fb->trima($close, 10)))->toBeTrue();
    });

    test('kama matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->kama($close, 10), $fb->kama($close, 10)))->toBeTrue();
    });

    test('t3 matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->t3($close, 5), $fb->t3($close, 5)))->toBeTrue();
    });

    test('midpoint matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->midpoint($close, 14), $fb->midpoint($close, 14)))->toBeTrue();
    });
});

describe('Cross-backend: multi-output overlap studies', function () {
    $close = generateClose(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('bbands matches between backends', function () use ($ext, $fb, $close) {
        $e = $ext->bbands($close, 20, 2.0, 2.0, 0);
        $f = $fb->bbands($close, 20, 2.0, 2.0, 0);
        expect(multiOutputArraysMatch($e, $f))->toBeTrue();
    });

    test('accbands matches between backends', function () {
        [, $high, $low, $close] = generateOHLCV(100);
        $ext = new ExtensionBackend;
        $fb = new FallbackBackend;
        $e = $ext->accbands($high, $low, $close, 20);
        $f = $fb->accbands($high, $low, $close, 20);
        expect(multiOutputArraysMatch($e, $f))->toBeTrue();
    });

    test('mama matches between backends (within floating-point tolerance)', function () use ($ext, $fb, $close) {
        $e = $ext->mama($close, 0.5, 0.05);
        $f = $fb->mama($close, 0.5, 0.05);
        expect(array_keys($e))->toBe(array_keys($f));
        foreach (array_keys($e) as $key) {
            $nonNull = 0;
            $withinTolerance = 0;
            foreach ($e[$key] as $i => $v) {
                if ($v !== null && $f[$key][$i] !== null) {
                    $nonNull++;
                    if (abs($v - $f[$key][$i]) < 1.0) {
                        $withinTolerance++;
                    }
                }
            }
            expect($withinTolerance)->toBe($nonNull, "MAMA {$key} values differ by more than 1.0");
        }
    });
});

describe('Cross-backend: volatility indicators', function () {
    [, $high, $low, $close] = generateOHLCV(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('atr matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->atr($high, $low, $close, 14), $fb->atr($high, $low, $close, 14)))->toBeTrue();
    });

    test('natr matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->natr($high, $low, $close, 14), $fb->natr($high, $low, $close, 14)))->toBeTrue();
    });

    test('trange matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->trange($high, $low, $close), $fb->trange($high, $low, $close)))->toBeTrue();
    });
});

describe('Cross-backend: momentum indicators', function () {
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('rsi matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->rsi($close, 14), $fb->rsi($close, 14)))->toBeTrue();
    });

    test('adx matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->adx($high, $low, $close, 14), $fb->adx($high, $low, $close, 14)))->toBeTrue();
    });

    test('cci matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->cci($high, $low, $close, 14), $fb->cci($high, $low, $close, 14)))->toBeTrue();
    });

    test('willr matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->willr($high, $low, $close, 14), $fb->willr($high, $low, $close, 14)))->toBeTrue();
    });

    test('mom matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->mom($close, 10), $fb->mom($close, 10)))->toBeTrue();
    });

    test('roc matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->roc($close, 10), $fb->roc($close, 10)))->toBeTrue();
    });

    test('trix matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->trix($close, 10), $fb->trix($close, 10)))->toBeTrue();
    });

    test('minus_di matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->minus_di($high, $low, $close, 14), $fb->minus_di($high, $low, $close, 14)))->toBeTrue();
    });

    test('plus_di matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->plus_di($high, $low, $close, 14), $fb->plus_di($high, $low, $close, 14)))->toBeTrue();
    });

    test('minus_dm matches between backends', function () use ($ext, $fb, $high, $low) {
        expect(arraysMatch($ext->minus_dm($high, $low, 14), $fb->minus_dm($high, $low, 14)))->toBeTrue();
    });

    test('plus_dm matches between backends', function () use ($ext, $fb, $high, $low) {
        expect(arraysMatch($ext->plus_dm($high, $low, 14), $fb->plus_dm($high, $low, 14)))->toBeTrue();
    });

    test('aroonosc matches between backends', function () use ($ext, $fb, $high, $low) {
        expect(arraysMatch($ext->aroonosc($high, $low, 14), $fb->aroonosc($high, $low, 14)))->toBeTrue();
    });

    test('mfi matches between backends', function () use ($ext, $fb, $high, $low, $close, $volume) {
        expect(arraysMatch($ext->mfi($high, $low, $close, $volume, 14), $fb->mfi($high, $low, $close, $volume, 14)))->toBeTrue();
    });

    test('dx matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->dx($high, $low, $close, 14), $fb->dx($high, $low, $close, 14)))->toBeTrue();
    });

    test('ppo matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->ppo($close, 12, 26, 0), $fb->ppo($close, 12, 26, 0)))->toBeTrue();
    });

    test('apo matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->apo($close, 12, 26, 0), $fb->apo($close, 12, 26, 0)))->toBeTrue();
    });

    test('imi matches between backends', function () use ($ext, $fb, $open, $close) {
        expect(arraysMatch($ext->imi($open, $close, 14), $fb->imi($open, $close, 14)))->toBeTrue();
    });

    test('bop matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->bop($open, $high, $low, $close), $fb->bop($open, $high, $low, $close)))->toBeTrue();
    });

    test('cmo matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->cmo($close, 14), $fb->cmo($close, 14)))->toBeTrue();
    });

    test('rocp matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->rocp($close, 10), $fb->rocp($close, 10)))->toBeTrue();
    });

    test('rocr matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->rocr($close, 10), $fb->rocr($close, 10)))->toBeTrue();
    });

    test('rocr100 matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->rocr100($close, 10), $fb->rocr100($close, 10)))->toBeTrue();
    });
});

describe('Cross-backend: multi-output momentum indicators', function () {
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('macd matches between backends', function () use ($ext, $fb, $close) {
        $e = $ext->macd($close, 12, 26, 9);
        $f = $fb->macd($close, 12, 26, 9);
        expect(multiOutputArraysMatch($e, $f))->toBeTrue();
    });

    test('stoch matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        $e = $ext->stoch($high, $low, $close, 5, 3, 0, 3, 0);
        $f = $fb->stoch($high, $low, $close, 5, 3, 0, 3, 0);
        expect(multiOutputArraysMatch($e, $f))->toBeTrue();
    });

    test('stochrsi matches between backends', function () use ($ext, $fb, $close) {
        $e = $ext->stochrsi($close, 14, 5, 3, 0);
        $f = $fb->stochrsi($close, 14, 5, 3, 0);
        expect(multiOutputArraysMatch($e, $f))->toBeTrue();
    });

    test('aroon matches between backends', function () use ($ext, $fb, $high, $low) {
        $e = $ext->aroon($high, $low, 14);
        $f = $fb->aroon($high, $low, 14);
        expect(multiOutputArraysMatch($e, $f))->toBeTrue();
    });
});

describe('Cross-backend: volume indicators', function () {
    [, $high, $low, $close, $volume] = generateOHLCV(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('obv matches between backends', function () use ($ext, $fb, $close, $volume) {
        expect(arraysMatch($ext->obv($close, $volume), $fb->obv($close, $volume)))->toBeTrue();
    });

    test('ad matches between backends', function () use ($ext, $fb, $high, $low, $close, $volume) {
        expect(arraysMatch($ext->ad($high, $low, $close, $volume), $fb->ad($high, $low, $close, $volume)))->toBeTrue();
    });

    test('adosc matches between backends', function () use ($ext, $fb, $high, $low, $close, $volume) {
        expect(arraysMatch($ext->adosc($high, $low, $close, $volume, 3, 10), $fb->adosc($high, $low, $close, $volume, 3, 10)))->toBeTrue();
    });
});

describe('Cross-backend: price transform', function () {
    [$open, $high, $low, $close] = generateOHLCV(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('typprice matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->typprice($high, $low, $close), $fb->typprice($high, $low, $close)))->toBeTrue();
    });

    test('wclprice matches between backends', function () use ($ext, $fb, $high, $low, $close) {
        expect(arraysMatch($ext->wclprice($high, $low, $close), $fb->wclprice($high, $low, $close)))->toBeTrue();
    });

    test('avgprice matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->avgprice($open, $high, $low, $close), $fb->avgprice($open, $high, $low, $close)))->toBeTrue();
    });

    test('medprice matches between backends', function () use ($ext, $fb, $high, $low) {
        expect(arraysMatch($ext->medprice($high, $low), $fb->medprice($high, $low)))->toBeTrue();
    });

    test('midprice matches between backends', function () use ($ext, $fb, $high, $low) {
        expect(arraysMatch($ext->midprice($high, $low, 14), $fb->midprice($high, $low, 14)))->toBeTrue();
    });
});

describe('Cross-backend: statistic functions', function () {
    $close = generateClose(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('stddev matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->stddev($close, 10), $fb->stddev($close, 10)))->toBeTrue();
    });

    test('var matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->var($close, 10), $fb->var($close, 10)))->toBeTrue();
    });

    test('beta matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->beta($close, $close, 10), $fb->beta($close, $close, 10)))->toBeTrue();
    });

    test('correl matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->correl($close, $close, 10), $fb->correl($close, $close, 10)))->toBeTrue();
    });

    test('linearreg matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->linearreg($close, 14), $fb->linearreg($close, 14)))->toBeTrue();
    });

    test('linearreg_slope matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->linearreg_slope($close, 14), $fb->linearreg_slope($close, 14)))->toBeTrue();
    });

    test('linearreg_intercept matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->linearreg_intercept($close, 14), $fb->linearreg_intercept($close, 14)))->toBeTrue();
    });

    test('tsf matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->tsf($close, 10), $fb->tsf($close, 10)))->toBeTrue();
    });
});

describe('Cross-backend: pattern recognition', function () {
    [$open, $high, $low, $close] = generateOHLCV(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('cdldoji matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->cdldoji($open, $high, $low, $close), $fb->cdldoji($open, $high, $low, $close)))->toBeTrue();
    });

    test('cdlengulfing matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->cdlengulfing($open, $high, $low, $close), $fb->cdlengulfing($open, $high, $low, $close)))->toBeTrue();
    });

    test('cdl3blackcrows matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->cdl3blackcrows($open, $high, $low, $close), $fb->cdl3blackcrows($open, $high, $low, $close)))->toBeTrue();
    });

    test('cdlmorningstar matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->cdlmorningstar($open, $high, $low, $close, 0.3), $fb->cdlmorningstar($open, $high, $low, $close, 0.3)))->toBeTrue();
    });

    test('cdlabandonedbaby matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->cdlabandonedbaby($open, $high, $low, $close, 0.3), $fb->cdlabandonedbaby($open, $high, $low, $close, 0.3)))->toBeTrue();
    });

    test('cdldarkcloudcover matches between backends', function () use ($ext, $fb, $open, $high, $low, $close) {
        expect(arraysMatch($ext->cdldarkcloudcover($open, $high, $low, $close, 0.5), $fb->cdldarkcloudcover($open, $high, $low, $close, 0.5)))->toBeTrue();
    });
});

describe('Cross-backend: cycle indicators', function () {
    $close = generateClose(100);
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('ht_dcperiod matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->ht_dcperiod($close), $fb->ht_dcperiod($close), 0.1))->toBeTrue();
    });

    test('ht_sine matches between backends', function () use ($ext, $fb, $close) {
        $e = $ext->ht_sine($close);
        $f = $fb->ht_sine($close);
        expect(multiOutputArraysMatch($e, $f, 0.1))->toBeTrue();
    });

    test('ht_trendmode matches between backends', function () use ($ext, $fb, $close) {
        expect(arraysMatch($ext->ht_trendmode($close), $fb->ht_trendmode($close)))->toBeTrue();
    });
});

describe('Cross-backend: math operators', function () {
    $a = [1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0, 8.0, 9.0, 10.0];
    $b = [10.0, 9.0, 8.0, 7.0, 6.0, 5.0, 4.0, 3.0, 2.0, 1.0];
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    test('add matches between backends', function () use ($ext, $fb, $a, $b) {
        expect(arraysMatch($ext->add($a, $b), $fb->add($a, $b)))->toBeTrue();
    });

    test('sub matches between backends', function () use ($ext, $fb, $a, $b) {
        expect(arraysMatch($ext->sub($a, $b), $fb->sub($a, $b)))->toBeTrue();
    });

    test('mult matches between backends', function () use ($ext, $fb, $a, $b) {
        expect(arraysMatch($ext->mult($a, $b), $fb->mult($a, $b)))->toBeTrue();
    });

    test('div matches between backends', function () use ($ext, $fb, $a, $b) {
        expect(arraysMatch($ext->div($a, $b), $fb->div($a, $b)))->toBeTrue();
    });

    test('max matches between backends', function () use ($ext, $fb, $a) {
        expect(arraysMatch($ext->max($a, 3), $fb->max($a, 3)))->toBeTrue();
    });

    test('min matches between backends', function () use ($ext, $fb, $a) {
        expect(arraysMatch($ext->min($a, 3), $fb->min($a, 3)))->toBeTrue();
    });
});

describe('Cross-backend: math transform', function () {
    $values = [0.1, 0.5, 1.0, 1.5, 2.0, 2.5, 3.0];
    $ext = new ExtensionBackend;
    $fb = new FallbackBackend;

    foreach (['acos', 'asin', 'atan', 'ceil', 'cos', 'cosh', 'exp', 'floor', 'ln', 'log10', 'sin', 'sinh', 'sqrt', 'tan', 'tanh'] as $fn) {
        test("{$fn} matches between backends", function () use ($ext, $fb, $fn, $values) {
            expect(arraysMatch($ext->$fn($values), $fb->$fn($values), 0.001))->toBeTrue();
        });
    }
});

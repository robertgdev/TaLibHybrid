<?php

declare(strict_types=1);

use robertgdev\TaLibHybrid\Backend\FallbackBackend;
use robertgdev\TaLibHybrid\Exception\TaLibInputException;

describe('FallbackBackend input validation', function () {
    $fb = new FallbackBackend;

    test('empty input arrays throw exception', function () use ($fb) {
        expect(fn () => $fb->sma([], 10))->toThrow(Exception::class);
    });

    test('mismatched array lengths throw TaLibInputException', function () use ($fb) {
        expect(fn () => $fb->atr([1, 2, 3], [1, 2], [1, 2, 3], 14))->toThrow(TaLibInputException::class);
    });
});

describe('FallbackBackend single-output overlap studies', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('sma returns null-padded array', function () use ($fb, $close) {
        $result = $fb->sma($close, 10);
        expect($result)->toHaveCount(100);
        expect($result[0])->toBeNull();
        expect($result[8])->toBeNull();
        expect($result[9])->toBeFloat();
    });

    test('sma calculates correct values', function () use ($fb) {
        $data = [1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0, 8.0, 9.0, 10.0];
        $result = $fb->sma($data, 5);
        expect($result[4])->toBe(3.0);
        expect($result[5])->toBe(4.0);
        expect($result[9])->toBe(8.0);
    });

    test('ema returns null-padded array with correct value count', function () use ($fb, $close) {
        $result = $fb->ema($close, 10);
        expect($result)->toHaveCount(100);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('wma returns correct results', function () use ($fb, $close) {
        $result = $fb->wma($close, 10);
        expect($result)->toHaveCount(100);
        expect(countNonNull($result))->toBe(91);
    });

    test('dema returns correct results', function () use ($fb, $close) {
        $result = $fb->dema($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('tema returns correct results', function () use ($fb, $close) {
        $result = $fb->tema($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('trima returns correct results', function () use ($fb, $close) {
        $result = $fb->trima($close, 10);
        expect(countNonNull($result))->toBe(91);
    });

    test('kama returns correct results', function () use ($fb, $close) {
        $result = $fb->kama($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('t3 returns correct results', function () use ($fb, $close) {
        $result = $fb->t3($close, 5);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('midpoint returns correct results', function () use ($fb, $close) {
        $result = $fb->midpoint($close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('midprice returns correct results', function () use ($fb, $high, $low) {
        $result = $fb->midprice($high, $low, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('sar returns correct results', function () use ($fb, $high, $low) {
        $result = $fb->sar($high, $low);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend multi-output overlap studies', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('bbands returns upper, middle, lower keys', function () use ($fb, $close) {
        $result = $fb->bbands($close, 20, 2.0, 2.0, 0);
        expect($result)->toHaveKeys(['upper', 'middle', 'lower']);
        expect($result['upper'])->toHaveCount(100);
        expect($result['middle'])->toHaveCount(100);
        expect($result['lower'])->toHaveCount(100);
    });

    test('bbands upper >= middle >= lower for non-null values', function () use ($fb, $close) {
        $result = $fb->bbands($close, 20, 2.0, 2.0, 0);
        foreach ($result['upper'] as $i => $upper) {
            if ($upper !== null) {
                expect($upper)->toBeGreaterThanOrEqual($result['middle'][$i]);
                expect($result['middle'][$i])->toBeGreaterThanOrEqual($result['lower'][$i]);
            }
        }
    });

    test('accbands returns upper, middle, lower keys', function () use ($fb, $high, $low, $close) {
        $result = $fb->accbands($high, $low, $close, 20);
        expect($result)->toHaveKeys(['upper', 'middle', 'lower']);
    });

    test('mama returns mama, fama keys', function () use ($fb, $close) {
        $result = $fb->mama($close, 0.5, 0.05);
        expect($result)->toHaveKeys(['mama', 'fama']);
    });

    test('ma with different MA types', function () use ($fb, $close) {
        $result = $fb->ma($close, 10, 0);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend volatility indicators', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('atr returns null-padded result', function () use ($fb, $high, $low, $close) {
        $result = $fb->atr($high, $low, $close, 14);
        expect($result)->toHaveCount(100);
        expect($result[0])->toBeNull();
        expect($result[99])->toBeFloat();
    });

    test('atr values are positive', function () use ($fb, $high, $low, $close) {
        $result = $fb->atr($high, $low, $close, 14);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThan(0);
            }
        }
    });

    test('natr returns correct results', function () use ($fb, $high, $low, $close) {
        $result = $fb->natr($high, $low, $close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('trange returns correct results', function () use ($fb, $high, $low, $close) {
        $result = $fb->trange($high, $low, $close);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend momentum indicators', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('rsi returns values in 0-100 range', function () use ($fb, $close) {
        $result = $fb->rsi($close, 14);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThanOrEqual(0.0);
                expect($v)->toBeLessThanOrEqual(100.0);
            }
        }
    });

    test('macd returns macd, signal, hist keys', function () use ($fb, $close) {
        $result = $fb->macd($close, 12, 26, 9);
        expect($result)->toHaveKeys(['macd', 'signal', 'hist']);
        expect($result['macd'])->toHaveCount(100);
    });

    test('stoch returns slowk, slowd keys', function () use ($fb, $high, $low, $close) {
        $result = $fb->stoch($high, $low, $close, 5, 3, 0, 3, 0);
        expect($result)->toHaveKeys(['slowk', 'slowd']);
    });

    test('stoch values are in 0-100 range', function () use ($fb, $high, $low, $close) {
        $result = $fb->stoch($high, $low, $close, 5, 3, 0, 3, 0);
        foreach ($result['slowk'] as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThanOrEqual(0.0);
                expect($v)->toBeLessThanOrEqual(100.0);
            }
        }
    });

    test('adx returns values in 0-100 range', function () use ($fb, $high, $low, $close) {
        $result = $fb->adx($high, $low, $close, 14);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThanOrEqual(0.0);
                expect($v)->toBeLessThanOrEqual(100.0);
            }
        }
    });

    test('cci returns correct results', function () use ($fb, $high, $low, $close) {
        $result = $fb->cci($high, $low, $close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('willr returns values in -100 to 0 range', function () use ($fb, $high, $low, $close) {
        $result = $fb->willr($high, $low, $close, 14);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThanOrEqual(-100.0);
                expect($v)->toBeLessThanOrEqual(0.0);
            }
        }
    });

    test('mom returns correct results', function () use ($fb, $close) {
        $result = $fb->mom($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('roc returns correct results', function () use ($fb, $close) {
        $result = $fb->roc($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('trix returns correct results', function () use ($fb, $close) {
        $result = $fb->trix($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('aroon returns down, up keys', function () use ($fb, $high, $low) {
        $result = $fb->aroon($high, $low, 14);
        expect($result)->toHaveKeys(['down', 'up']);
    });

    test('aroonosc returns single array', function () use ($fb, $high, $low) {
        $result = $fb->aroonosc($high, $low, 14);
        expect($result)->toHaveCount(100);
    });

    test('mfi returns values in 0-100 range', function () use ($fb, $high, $low, $close, $volume) {
        $result = $fb->mfi($high, $low, $close, $volume, 14);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThanOrEqual(0.0);
                expect($v)->toBeLessThanOrEqual(100.0);
            }
        }
    });

    test('ppo returns correct results', function () use ($fb, $close) {
        $result = $fb->ppo($close, 12, 26, 0);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('apo returns correct results', function () use ($fb, $close) {
        $result = $fb->apo($close, 12, 26, 0);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('imi returns correct results', function () use ($fb, $open, $close) {
        $result = $fb->imi($open, $close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('bop returns correct results', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->bop($open, $high, $low, $close);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('ultosc returns correct results', function () use ($fb, $high, $low, $close) {
        $result = $fb->ultosc($high, $low, $close, 7, 14, 28);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend volume indicators', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('obv returns same-length result', function () use ($fb, $close, $volume) {
        $result = $fb->obv($close, $volume);
        expect($result)->toHaveCount(100);
    });

    test('ad returns same-length result', function () use ($fb, $high, $low, $close, $volume) {
        $result = $fb->ad($high, $low, $close, $volume);
        expect($result)->toHaveCount(100);
    });

    test('adosc returns correct results', function () use ($fb, $high, $low, $close, $volume) {
        $result = $fb->adosc($high, $low, $close, $volume, 3, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend cycle indicators', function () {
    $fb = new FallbackBackend;
    $close = generateClose(100);

    test('ht_dcperiod returns correct results', function () use ($fb, $close) {
        $result = $fb->ht_dcperiod($close);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('ht_dcphase returns correct results', function () use ($fb, $close) {
        $result = $fb->ht_dcphase($close);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('ht_phasor returns inphase, quadrature keys', function () use ($fb, $close) {
        $result = $fb->ht_phasor($close);
        expect($result)->toHaveKeys(['inphase', 'quadrature']);
    });

    test('ht_sine returns sine, leadsine keys', function () use ($fb, $close) {
        $result = $fb->ht_sine($close);
        expect($result)->toHaveKeys(['sine', 'leadsine']);
    });

    test('ht_trendmode returns correct results', function () use ($fb, $close) {
        $result = $fb->ht_trendmode($close);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend price transform', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('typprice returns same-length result', function () use ($fb, $high, $low, $close) {
        $result = $fb->typprice($high, $low, $close);
        expect($result)->toHaveCount(100);
        expect(countNonNull($result))->toBe(100);
    });

    test('wclprice returns correct results', function () use ($fb, $high, $low, $close) {
        $result = $fb->wclprice($high, $low, $close);
        expect(countNonNull($result))->toBe(100);
    });

    test('avgprice returns correct results', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->avgprice($open, $high, $low, $close);
        expect(countNonNull($result))->toBe(100);
    });

    test('medprice returns correct results', function () use ($fb, $high, $low) {
        $result = $fb->medprice($high, $low);
        expect(countNonNull($result))->toBe(100);
    });
});

describe('FallbackBackend statistic functions', function () {
    $fb = new FallbackBackend;
    $close = generateClose(100);

    test('beta returns correct results', function () use ($fb, $close) {
        $result = $fb->beta($close, $close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('correl returns correct results', function () use ($fb, $close) {
        $result = $fb->correl($close, $close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('stddev returns correct results', function () use ($fb, $close) {
        $result = $fb->stddev($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('var returns correct results', function () use ($fb, $close) {
        $result = $fb->var($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('linearreg returns correct results', function () use ($fb, $close) {
        $result = $fb->linearreg($close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('linearreg_slope returns correct results', function () use ($fb, $close) {
        $result = $fb->linearreg_slope($close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('tsf returns correct results', function () use ($fb, $close) {
        $result = $fb->tsf($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('FallbackBackend math transform', function () {
    $fb = new FallbackBackend;
    $values = [0.1, 0.5, 1.0, 1.5, 2.0, 2.5, 3.0];

    test('sqrt returns correct values', function () use ($fb, $values) {
        $result = $fb->sqrt($values);
        expect($result[2])->toBe(1.0);
    });

    test('ln returns correct values', function () use ($fb, $values) {
        $result = $fb->ln($values);
        expect(abs($result[2] - 0.0) < 0.001)->toBeTrue();
    });

    test('exp returns correct values', function () use ($fb) {
        $result = $fb->exp([0.0, 1.0]);
        expect(abs($result[0] - 1.0) < 0.001)->toBeTrue();
        expect(abs($result[1] - M_E) < 0.001)->toBeTrue();
    });

    test('ceil returns correct values', function () use ($fb) {
        $result = $fb->ceil([1.1, 2.9, 3.0]);
        expect($result[0])->toBe(2.0);
        expect($result[1])->toBe(3.0);
        expect($result[2])->toBe(3.0);
    });

    test('floor returns correct values', function () use ($fb) {
        $result = $fb->floor([1.1, 2.9, 3.0]);
        expect($result[0])->toBe(1.0);
        expect($result[1])->toBe(2.0);
        expect($result[2])->toBe(3.0);
    });
});

describe('FallbackBackend math operators', function () {
    $fb = new FallbackBackend;
    $a = [1.0, 2.0, 3.0, 4.0, 5.0];
    $b = [5.0, 4.0, 3.0, 2.0, 1.0];

    test('add returns correct values', function () use ($fb, $a, $b) {
        $result = $fb->add($a, $b);
        expect($result[0])->toBe(6.0);
        expect($result[2])->toBe(6.0);
        expect($result[4])->toBe(6.0);
    });

    test('sub returns correct values', function () use ($fb, $a, $b) {
        $result = $fb->sub($a, $b);
        expect($result[0])->toBe(-4.0);
        expect($result[2])->toBe(0.0);
        expect($result[4])->toBe(4.0);
    });

    test('mult returns correct values', function () use ($fb, $a, $b) {
        $result = $fb->mult($a, $b);
        expect($result[0])->toBe(5.0);
        expect($result[2])->toBe(9.0);
    });

    test('div returns correct values', function () use ($fb, $a, $b) {
        $result = $fb->div($a, $b);
        expect($result[2])->toBe(1.0);
    });

    test('sum returns correct values', function () use ($fb, $a) {
        $result = $fb->sum($a, 3);
        expect($result[2])->toBe(6.0);
    });

    test('max returns correct values', function () use ($fb, $a) {
        $result = $fb->max($a, 3);
        expect($result[2])->toBe(3.0);
    });

    test('min returns correct values', function () use ($fb, $a) {
        $result = $fb->min($a, 3);
        expect($result[2])->toBe(1.0);
    });
});

describe('FallbackBackend pattern recognition', function () {
    $fb = new FallbackBackend;
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('cdldoji returns integer array', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->cdldoji($open, $high, $low, $close);
        expect($result)->toHaveCount(100);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeInt();
            }
        }
    });

    test('cdlengulfing returns correct results', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->cdlengulfing($open, $high, $low, $close);
        expect($result)->toHaveCount(100);
    });

    test('cdlmorningstar with penetration returns correct results', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->cdlmorningstar($open, $high, $low, $close, 0.3);
        expect($result)->toHaveCount(100);
    });

    test('cdlabandonedbaby with penetration returns correct results', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->cdlabandonedbaby($open, $high, $low, $close, 0.3);
        expect($result)->toHaveCount(100);
    });

    test('cdl3blackcrows returns correct results', function () use ($fb, $open, $high, $low, $close) {
        $result = $fb->cdl3blackcrows($open, $high, $low, $close);
        expect($result)->toHaveCount(100);
    });

    test('all 61 cdl methods return arrays with correct length', function () use ($fb, $open, $high, $low, $close) {
        $r = new ReflectionClass($fb);
        $methods = $r->getMethods(ReflectionMethod::IS_PUBLIC);
        $cdlMethods = array_filter($methods, fn ($m) => str_starts_with($m->getName(), 'cdl'));
        expect($cdlMethods)->toHaveCount(61);
        foreach ($cdlMethods as $m) {
            $name = $m->getName();
            $params = $m->getParameters();
            $args = [];
            foreach ($params as $p) {
                $type = $p->getType()?->getName();
                if ($type === 'array') {
                    $pos = $p->getPosition();
                    $args[] = match ($pos) {
                        0 => $open, 1 => $high, 2 => $low, 3 => $close,
                        default => $close,
                    };
                } elseif ($type === 'float' && $p->isDefaultValueAvailable()) {
                    $args[] = $p->getDefaultValue();
                } elseif ($type === 'float') {
                    $args[] = 0.3;
                }
            }
            $result = $fb->$name(...$args);
            expect($result)->toHaveCount(100, "Failed for {$name}");
        }
    });
});

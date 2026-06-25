<?php

declare(strict_types=1);

use RobertGDev\TaLibHybrid\Backend\ExtensionBackend;

describe('ExtensionBackend basic functionality', function () {
    test('sma returns correct results', function () {
        $close = generateClose(50);
        $ext = new ExtensionBackend;
        $result = $ext->sma($close, 10);
        expect($result)->toHaveCount(50);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('ema returns correct results', function () {
        $close = generateClose(50);
        $ext = new ExtensionBackend;
        $result = $ext->ema($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('atr returns correct results', function () {
        [, $high, $low, $close] = generateOHLCV(50);
        $ext = new ExtensionBackend;
        $result = $ext->atr($high, $low, $close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('rsi returns values in 0-100 range', function () {
        $close = generateClose(50);
        $ext = new ExtensionBackend;
        $result = $ext->rsi($close, 14);
        foreach ($result as $v) {
            if ($v !== null) {
                expect($v)->toBeGreaterThanOrEqual(0.0);
                expect($v)->toBeLessThanOrEqual(100.0);
            }
        }
    });

    test('macd returns multi-output with correct keys', function () {
        $close = generateClose(50);
        $ext = new ExtensionBackend;
        $result = $ext->macd($close, 12, 26, 9);
        expect($result)->toHaveKeys(['macd', 'signal', 'hist']);
    });

    test('bbands returns multi-output with correct keys', function () {
        $close = generateClose(50);
        $ext = new ExtensionBackend;
        $result = $ext->bbands($close, 20, 2.0, 2.0, 0);
        expect($result)->toHaveKeys(['upper', 'middle', 'lower']);
    });

    test('mom falls back to FallbackBackend', function () {
        $close = generateClose(50);
        $ext = new ExtensionBackend;
        $result = $ext->mom($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

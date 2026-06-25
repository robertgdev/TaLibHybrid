<?php

declare(strict_types=1);

use RobertGDev\TaLibHybrid\Backend\BackendInterface;
use RobertGDev\TaLibHybrid\Backend\FallbackBackend;
use RobertGDev\TaLibHybrid\TaLibHybrid;

describe('TaLibHybrid facade', function () {
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('sma static method works', function () use ($close) {
        $result = TaLibHybrid::sma($close, 10);
        expect($result)->toHaveCount(100);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('atr static method works', function () use ($high, $low, $close) {
        $result = TaLibHybrid::atr($high, $low, $close, 14);
        expect($result)->toHaveCount(100);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('rsi static method works', function () use ($close) {
        $result = TaLibHybrid::rsi($close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('macd static method works', function () use ($close) {
        $result = TaLibHybrid::macd($close, 12, 26, 9);
        expect($result)->toHaveKeys(['macd', 'signal', 'hist']);
    });

    test('bbands static method works', function () use ($close) {
        $result = TaLibHybrid::bbands($close, 20, 2.0, 2.0, 0);
        expect($result)->toHaveKeys(['upper', 'middle', 'lower']);
    });

    test('setBackend changes the active backend', function () use ($close) {
        $fallback = new FallbackBackend;
        TaLibHybrid::setBackend($fallback);
        $result = TaLibHybrid::sma($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('getBackend returns current backend', function () {
        $backend = TaLibHybrid::getBackend();
        expect($backend)->toBeInstanceOf(BackendInterface::class);
    });
});

describe('ta_* polyfill functions', function () {
    [$open, $high, $low, $close, $volume] = generateOHLCV(100);

    test('ta_sma function works', function () use ($close) {
        expect(function_exists('ta_sma'))->toBeTrue();
        $result = ta_sma($close, 10);
        expect($result)->toHaveCount(100);
    });

    test('ta_atr function works', function () use ($high, $low, $close) {
        expect(function_exists('ta_atr'))->toBeTrue();
        $result = ta_atr($high, $low, $close, 14);
        expect($result)->toHaveCount(100);
    });

    test('ta_rsi function works', function () use ($close) {
        expect(function_exists('ta_rsi'))->toBeTrue();
        $result = ta_rsi($close, 14);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });

    test('ta_macd function works', function () use ($close) {
        expect(function_exists('ta_macd'))->toBeTrue();
        $result = ta_macd($close, 12, 26, 9);
        expect($result)->toHaveKeys(['macd', 'signal', 'hist']);
    });

    test('ta_ema function works', function () use ($close) {
        expect(function_exists('ta_ema'))->toBeTrue();
        $result = ta_ema($close, 10);
        expect(countNonNull($result))->toBeGreaterThan(0);
    });
});

describe('Constants polyfill', function () {
    test('TA_MA_TYPE_SMA is defined', function () {
        expect(defined('TA_MA_TYPE_SMA'))->toBeTrue();
        expect(TA_MA_TYPE_SMA)->toBe(0);
    });

    test('TA_SUCCESS is defined', function () {
        expect(defined('TA_SUCCESS'))->toBeTrue();
        expect(TA_SUCCESS)->toBe(0);
    });

    test('TA_FUNC_UNST_RSI is defined', function () {
        expect(defined('TA_FUNC_UNST_RSI'))->toBeTrue();
        expect(TA_FUNC_UNST_RSI)->toBe(20);
    });

    test('TA_REAL_MIN is defined', function () {
        expect(defined('TA_REAL_MIN'))->toBeTrue();
    });
});

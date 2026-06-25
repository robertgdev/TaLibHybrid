<?php

declare(strict_types=1);

use robertgdev\TaLibHybrid\Enum\CandleSettingType;
use robertgdev\TaLibHybrid\Enum\Compatibility;
use robertgdev\TaLibHybrid\Enum\FuncUnstId;
use robertgdev\TaLibHybrid\Enum\MovingAverageType;
use robertgdev\TaLibHybrid\Enum\RangeType;
use robertgdev\TaLibHybrid\Enum\ReturnCode;
use robertgdev\TaLibHybrid\Exception\TaLibCalculationException;
use robertgdev\TaLibHybrid\Exception\TaLibException;
use robertgdev\TaLibHybrid\Exception\TaLibInputException;

describe('ReturnCode enum', function () {
    test('Success has value 0', function () {
        expect(ReturnCode::Success->value)->toBe(0);
    });

    test('BadParam has value 1', function () {
        expect(ReturnCode::BadParam->value)->toBe(1);
    });

    test('messageFromInt returns string for known codes', function () {
        expect(ReturnCode::messageFromInt(0))->toBeString();
        expect(ReturnCode::messageFromInt(1))->toBeString();
    });

    test('messageFromInt returns unknown for invalid code', function () {
        expect(ReturnCode::messageFromInt(999))->toContain('Unknown');
    });
});

describe('MovingAverageType enum', function () {
    test('has SMA with value 0', function () {
        expect(MovingAverageType::SMA->value)->toBe(0);
    });

    test('has all 9 types', function () {
        expect(MovingAverageType::cases())->toHaveCount(9);
    });
});

describe('FuncUnstId enum', function () {
    test('has ALL with value 23', function () {
        expect(FuncUnstId::ALL->value)->toBe(23);
    });

    test('has NONE with value 24', function () {
        expect(FuncUnstId::NONE->value)->toBe(24);
    });

    test('has all 25 cases', function () {
        expect(FuncUnstId::cases())->toHaveCount(25);
    });
});

describe('CandleSettingType enum', function () {
    test('has 12 cases', function () {
        expect(CandleSettingType::cases())->toHaveCount(12);
    });
});

describe('RangeType enum', function () {
    test('has 3 cases', function () {
        expect(RangeType::cases())->toHaveCount(3);
    });
});

describe('Compatibility enum', function () {
    test('has 2 cases', function () {
        expect(Compatibility::cases())->toHaveCount(2);
    });
});

describe('Exception hierarchy', function () {
    test('TaLibException extends Exception', function () {
        expect(new TaLibException('test'))->toBeInstanceOf(Exception::class);
    });

    test('TaLibInputException extends TaLibException', function () {
        expect(new TaLibInputException('test'))->toBeInstanceOf(TaLibException::class);
    });

    test('TaLibCalculationException extends TaLibException', function () {
        expect(new TaLibCalculationException('test'))->toBeInstanceOf(TaLibException::class);
    });
});

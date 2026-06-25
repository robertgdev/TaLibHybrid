<?php

declare(strict_types=1);

use robertgdev\TaLibHybrid\Backend\BackendInterface;
use robertgdev\TaLibHybrid\Backend\ExtensionBackend;
use robertgdev\TaLibHybrid\Backend\FallbackBackend;

describe('BackendInterface contract', function () {
    test('ExtensionBackend implements BackendInterface', function () {
        expect(new ExtensionBackend)->toBeInstanceOf(BackendInterface::class);
    });

    test('FallbackBackend implements BackendInterface', function () {
        expect(new FallbackBackend)->toBeInstanceOf(BackendInterface::class);
    });

    $backendClasses = [ExtensionBackend::class, FallbackBackend::class];

    foreach ($backendClasses as $class) {
        test("{$class} has all required interface methods", function () use ($class) {
            $interfaceMethods = get_class_methods(BackendInterface::class);
            $backendMethods = get_class_methods($class);
            foreach ($interfaceMethods as $method) {
                expect($backendMethods)->toContain($method);
            }
        });
    }
});

describe('Backend utility methods', function () {
    test('ExtensionBackend::isExtensionAvailable returns true', function () {
        expect((new ExtensionBackend)->isExtensionAvailable())->toBeTrue();
    });

    test('FallbackBackend::isExtensionAvailable returns false', function () {
        expect((new FallbackBackend)->isExtensionAvailable())->toBeFalse();
    });

    test('ExtensionBackend::version returns string', function () {
        expect((new ExtensionBackend)->version())->toBeString();
    });

    test('FallbackBackend::version returns fallback version string', function () {
        expect((new FallbackBackend)->version())->toBe('0.0.0-fallback');
    });

    test('ExtensionBackend::setUnstablePeriod does not throw', function () {
        expect(fn () => (new ExtensionBackend)->setUnstablePeriod(0, 5))->not->toThrow(Exception::class);
    });

    test('ExtensionBackend::getUnstablePeriod returns 0', function () {
        expect((new ExtensionBackend)->getUnstablePeriod(0))->toBe(0);
    });
});

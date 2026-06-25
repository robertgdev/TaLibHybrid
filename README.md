# TaLibHybrid

A hybrid PHP wrapper for [TA-Lib](https://ta-lib.org/) that provides **161 technical analysis indicator functions** with automatic pass-through to the C extension when available, and a pure-PHP fallback when it's not.

## Installation

```bash
composer require robertgdev/ta-lib-hybrid
```

The C extension is optional but recommended for performance:

```bash
pecl install ta_lib
```

Add to `php.ini`:

```ini
extension=ta_lib.so
```

The library works without the extension — it will automatically fall back to the pure-PHP implementation.

## Requirements

- PHP 8.3+
- `ext-ta_lib` ^1.0 (optional, recommended for 5-50x faster calculations)

## Design

### Goals

1. **Transparent dual-backend** — When `ext-ta_lib` is loaded, all calls go through the C extension for maximum speed. When it's absent, the pure-PHP fallback delivers identical results.
2. **Zero-disruption migration** — Procedural `ta_*` polyfill functions (`ta_sma`, `ta_atr`, etc.) and `TA_*` constants are defined only when the extension is not present, so existing code using `ta_sma()` works unchanged.
3. **Consistent output format** — Both backends return the same array structure: null-padded aligned arrays where leading positions (the lookback period) are `null` and actual values start at the correct offset. Multi-output indicators use lowercase string keys.
4. **Full coverage** — All 161 TA-Lib indicator functions are implemented, including `imi` and `mom` which are missing from the C extension.

### Architecture

```
┌─────────────────────────────────────────────────┐
│  TaLibHybrid (static facade)                    │
│  TaLibHybrid::sma($values, 14)                 │
├─────────────────────────────────────────────────┤
│  Functions.php (procedural polyfill)            │
│  ta_sma($values, 14)                           │
├─────────────────────────────────────────────────┤
│  BackendInterface                               │
│  ├── ExtensionBackend  → ext-ta-lib C calls    │
│  └── FallbackBackend   → pure PHP (Core/)      │
├─────────────────────────────────────────────────┤
│  Constants.php  (TA_* constants polyfill)       │
│  Enum/          (MovingAverageType, ReturnCode…)│
│  Exception/     (TaLibException hierarchy)      │
└─────────────────────────────────────────────────┘
```

**Auto-detection**: `TaLibHybrid` checks `extension_loaded('ta_lib')` on first call and selects the appropriate backend. You can override this with `TaLibHybrid::setBackend()`.

**Fallback delegation**: `ExtensionBackend` delegates `mom()` and `mama()` to `FallbackBackend` because the C extension does not provide `ta_mom`, and `ta_mama` returns a broken flat array instead of the expected multi-output format.

### Directory structure

```
src/
├── TaLibHybrid.php           # Static facade (167 methods)
├── Constants.php              # TA_* constant polyfill (per-constant guards)
├── Functions.php              # ta_* procedural polyfill (161 functions)
├── Backend/
│   ├── BackendInterface.php   # Contract: 4 utility + 161 indicator methods
│   ├── ExtensionBackend.php   # Pass-through to ext-ta-lib
│   └── FallbackBackend.php    # Pure PHP with null-padded output formatting
├── Enum/
│   ├── MovingAverageType.php  # 9 cases (SMA, EMA, WMA, …)
│   ├── FuncUnstId.php         # 25 cases (ADX, RSI, EMA, …)
│   ├── ReturnCode.php         # 6 cases (Success, BadParam, …)
│   ├── CandleSettingType.php  # 12 cases
│   ├── RangeType.php          # 3 cases
│   └── Compatibility.php      # 2 cases
├── Exception/
│   ├── TaLibException.php
│   ├── TaLibInputException.php
│   └── TaLibCalculationException.php
└── Fallback/
    ├── Classes/
    │   ├── CandleSetting.php
    │   └── MoneyFlow.php
    └── Core/                  # Ported calculation engines
        ├── Core.php
        ├── Lookback.php
        ├── OverlapStudies.php
        ├── VolatilityIndicators.php
        ├── MomentumIndicators.php
        ├── CycleIndicators.php
        ├── VolumeIndicators.php
        ├── PatternRecognition.php
        ├── StatisticFunctions.php
        ├── PriceTransform.php
        ├── MathTransform.php
        └── MathOperators.php
```

## Usage

### OOP via static facade

```php
use RobertGDev\TaLibHybrid\TaLibHybrid;

$close = [44.02, 44.10, 44.16, 44.22, 44.10, 44.00, 44.12, 44.18, 44.28, 44.32];

// Single-output indicator — returns flat array, null-padded
$sma = TaLibHybrid::sma($close, 5);
// [null, null, null, null, 44.12, 44.116, 44.12, 44.124, 44.136, 44.18]

// Multi-output indicator — returns associative array of aligned arrays
$bbands = TaLibHybrid::bbands($close, 5, 2.0, 2.0, 0);
// ['upper' => [...], 'middle' => [...], 'lower' => [...]]

$macd = TaLibHybrid::macd($close, 12, 26, 9);
// ['macd' => [...], 'signal' => [...], 'hist' => [...]]
```

### Procedural polyfill

Works identically to the C extension's function signatures:

```php
$sma = ta_sma($close, 14);
$atr = ta_atr($high, $low, $close, 14);
$rsi = ta_rsi($close, 14);
$macd = ta_macd($close, 12, 26, 9);
```

These functions are only defined when `ext-ta_lib` is not loaded, so they never conflict with the extension.

### Backend selection

```php
use RobertGDev\TaLibHybrid\TaLibHybrid;
use RobertGDev\TaLibHybrid\Backend\FallbackBackend;

// Force pure-PHP backend (e.g. for testing)
TaLibHybrid::setBackend(new FallbackBackend());

// Check which backend is active
if (TaLibHybrid::isExtensionAvailable()) {
    echo 'Using C extension v' . TaLibHybrid::version();
} else {
    echo 'Using pure-PHP fallback';
}

// Reset to auto-detection
TaLibHybrid::setBackend(null);
```

### Direct backend instantiation

```php
use RobertGDev\TaLibHybrid\Backend\ExtensionBackend;
use RobertGDev\TaLibHybrid\Backend\FallbackBackend;

$ext = new ExtensionBackend();
$fb  = new FallbackBackend();

// Both implement the same interface
$smaExt = $ext->sma($close, 14);
$smaFb  = $fb->sma($close, 14);
```

## Output format

All indicator methods return arrays aligned with the input index. Values in the lookback period are `null`:

```php
// SMA(3) on [1, 2, 3, 4, 5]
$result = TaLibHybrid::sma([1, 2, 3, 4, 5], 3);
// [null, null, 2.0, 3.0, 4.0]
//  idx0   idx1  idx2  idx3  idx4
```

Multi-output indicators return an associative array of such arrays:

```php
$stoch = TaLibHybrid::stoch($high, $low, $close, 5, 3, 0, 3, 0);
// ['slowk' => [null, null, ...], 'slowd' => [null, null, ...]]

$aroon = TaLibHybrid::aroon($high, $low, 14);
// ['down' => [...], 'up' => [...]]

$ht_sine = TaLibHybrid::ht_sine($close);
// ['sine' => [...], 'leadsine' => [...]]
```

## Indicator categories

| Category | Count | Examples |
|---|---|---|
| Overlap Studies | 18 | `sma`, `ema`, `wma`, `dema`, `tema`, `bbands`, `kama`, `t3` |
| Momentum Indicators | 31 | `rsi`, `macd`, `stoch`, `adx`, `cci`, `willr`, `mom`, `imi` |
| Pattern Recognition | 61 | `cdldoji`, `cdlengulfing`, `cdlhammer`, `cdlmorningstar` |
| Statistic Functions | 9 | `beta`, `correl`, `stddev`, `linearreg`, `tsf` |
| Math Operators | 11 | `add`, `sub`, `mult`, `div`, `sum`, `max`, `min` |
| Math Transform | 15 | `sin`, `cos`, `sqrt`, `exp`, `ln`, `ceil`, `floor` |
| Volatility Indicators | 3 | `atr`, `natr`, `trange` |
| Cycle Indicators | 5 | `ht_dcperiod`, `ht_dcphase`, `ht_sine` |
| Volume Indicators | 3 | `obv`, `ad`, `adosc` |
| Price Transform | 5 | `avgprice`, `medprice`, `typprice`, `wclprice` |

## Exceptions

```
TaLibException                  # Base
├── TaLibInputException         # Invalid input (empty arrays, mismatched lengths)
└── TaLibCalculationException   # Calculation error (bad parameters, internal error)
```

## Constants

When `ext-ta_lib` is loaded, it provides `TA_MA_TYPE_SMA` and similar constants. When it's not, `Constants.php` polyfills them all:

- `TA_MA_TYPE_*` — Moving average types (0–8)
- `TA_FUNC_UNST_*` — Unstable period function IDs (0–24)
- `TA_SUCCESS`, `TA_BAD_PARAM`, … — Return codes
- `TA_CANDLE_SETTING_*` — Candle setting types (0–11)
- `TA_RANGE_TYPE_*` — Range types (0–2)
- `TA_COMPATIBILITY_*` — Compatibility modes (0–1)
- `TA_REAL_MIN`, `TA_REAL_MAX`, `TA_INTEGER_MIN`, `TA_INTEGER_MAX`

Each constant is guarded individually with `if (!defined(...))`, so they coexist correctly with the extension.

## Testing

The package includes a Pest test suite with 213 tests and ~3000 assertions:

```bash
cd src/TaLibHybrid
composer install
vendor/bin/pest
```

**Test suites:**

- **Unit** — Input validation, output format, value ranges, key names, all 61 pattern recognition functions
- **Comparison** — Cross-backend verification: Extension vs Fallback output for 60+ indicators within floating-point tolerance

## License

MIT

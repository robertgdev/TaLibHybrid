<?php

declare(strict_types=1);

if (! defined('TA_MA_TYPE_SMA')) {
    define('TA_MA_TYPE_SMA', 0);
}
if (! defined('TA_MA_TYPE_EMA')) {
    define('TA_MA_TYPE_EMA', 1);
}
if (! defined('TA_MA_TYPE_WMA')) {
    define('TA_MA_TYPE_WMA', 2);
}
if (! defined('TA_MA_TYPE_DEMA')) {
    define('TA_MA_TYPE_DEMA', 3);
}
if (! defined('TA_MA_TYPE_TEMA')) {
    define('TA_MA_TYPE_TEMA', 4);
}
if (! defined('TA_MA_TYPE_TRIMA')) {
    define('TA_MA_TYPE_TRIMA', 5);
}
if (! defined('TA_MA_TYPE_KAMA')) {
    define('TA_MA_TYPE_KAMA', 6);
}
if (! defined('TA_MA_TYPE_MAMA')) {
    define('TA_MA_TYPE_MAMA', 7);
}
if (! defined('TA_MA_TYPE_T3')) {
    define('TA_MA_TYPE_T3', 8);
}

if (! defined('TA_REAL_MIN')) {
    define('TA_REAL_MIN', -3e+37);
}
if (! defined('TA_REAL_MAX')) {
    define('TA_REAL_MAX', 3e+37);
}
if (! defined('TA_INTEGER_MIN')) {
    define('TA_INTEGER_MIN', -2147483648);
}
if (! defined('TA_INTEGER_MAX')) {
    define('TA_INTEGER_MAX', 2147483647);
}

if (! defined('TA_FUNC_UNST_ADX')) {
    define('TA_FUNC_UNST_ADX', 0);
}
if (! defined('TA_FUNC_UNST_ADXR')) {
    define('TA_FUNC_UNST_ADXR', 1);
}
if (! defined('TA_FUNC_UNST_ATR')) {
    define('TA_FUNC_UNST_ATR', 2);
}
if (! defined('TA_FUNC_UNST_CMO')) {
    define('TA_FUNC_UNST_CMO', 3);
}
if (! defined('TA_FUNC_UNST_DX')) {
    define('TA_FUNC_UNST_DX', 4);
}
if (! defined('TA_FUNC_UNST_EMA')) {
    define('TA_FUNC_UNST_EMA', 5);
}
if (! defined('TA_FUNC_UNST_HT_DCPERIOD')) {
    define('TA_FUNC_UNST_HT_DCPERIOD', 6);
}
if (! defined('TA_FUNC_UNST_HT_DCPHASE')) {
    define('TA_FUNC_UNST_HT_DCPHASE', 7);
}
if (! defined('TA_FUNC_UNST_HT_PHASOR')) {
    define('TA_FUNC_UNST_HT_PHASOR', 8);
}
if (! defined('TA_FUNC_UNST_HT_SINE')) {
    define('TA_FUNC_UNST_HT_SINE', 9);
}
if (! defined('TA_FUNC_UNST_HT_TRENDLINE')) {
    define('TA_FUNC_UNST_HT_TRENDLINE', 10);
}
if (! defined('TA_FUNC_UNST_HT_TRENDMODE')) {
    define('TA_FUNC_UNST_HT_TRENDMODE', 11);
}
if (! defined('TA_FUNC_UNST_KAMA')) {
    define('TA_FUNC_UNST_KAMA', 12);
}
if (! defined('TA_FUNC_UNST_MAMA')) {
    define('TA_FUNC_UNST_MAMA', 13);
}
if (! defined('TA_FUNC_UNST_MFI')) {
    define('TA_FUNC_UNST_MFI', 14);
}
if (! defined('TA_FUNC_UNST_MINUS_DI')) {
    define('TA_FUNC_UNST_MINUS_DI', 15);
}
if (! defined('TA_FUNC_UNST_MINUS_DM')) {
    define('TA_FUNC_UNST_MINUS_DM', 16);
}
if (! defined('TA_FUNC_UNST_NATR')) {
    define('TA_FUNC_UNST_NATR', 17);
}
if (! defined('TA_FUNC_UNST_PLUS_DI')) {
    define('TA_FUNC_UNST_PLUS_DI', 18);
}
if (! defined('TA_FUNC_UNST_PLUS_DM')) {
    define('TA_FUNC_UNST_PLUS_DM', 19);
}
if (! defined('TA_FUNC_UNST_RSI')) {
    define('TA_FUNC_UNST_RSI', 20);
}
if (! defined('TA_FUNC_UNST_STOCHRSI')) {
    define('TA_FUNC_UNST_STOCHRSI', 21);
}
if (! defined('TA_FUNC_UNST_T3')) {
    define('TA_FUNC_UNST_T3', 22);
}
if (! defined('TA_FUNC_UNST_ALL')) {
    define('TA_FUNC_UNST_ALL', 23);
}
if (! defined('TA_FUNC_UNST_NONE')) {
    define('TA_FUNC_UNST_NONE', 24);
}

if (! defined('TA_COMPATIBILITY_DEFAULT')) {
    define('TA_COMPATIBILITY_DEFAULT', 0);
}
if (! defined('TA_COMPATIBILITY_METASTOCK')) {
    define('TA_COMPATIBILITY_METASTOCK', 1);
}

if (! defined('TA_SUCCESS')) {
    define('TA_SUCCESS', 0);
}
if (! defined('TA_BAD_PARAM')) {
    define('TA_BAD_PARAM', 1);
}
if (! defined('TA_OUT_OF_RANGE_START_INDEX')) {
    define('TA_OUT_OF_RANGE_START_INDEX', 2);
}
if (! defined('TA_OUT_OF_RANGE_END_INDEX')) {
    define('TA_OUT_OF_RANGE_END_INDEX', 3);
}
if (! defined('TA_ALLOC_ERROR')) {
    define('TA_ALLOC_ERROR', 4);
}
if (! defined('TA_INTERNAL_ERROR')) {
    define('TA_INTERNAL_ERROR', 5);
}

if (! defined('TA_CANDLE_SETTING_BODY_LONG')) {
    define('TA_CANDLE_SETTING_BODY_LONG', 0);
}
if (! defined('TA_CANDLE_SETTING_BODY_VERY_LONG')) {
    define('TA_CANDLE_SETTING_BODY_VERY_LONG', 1);
}
if (! defined('TA_CANDLE_SETTING_BODY_SHORT')) {
    define('TA_CANDLE_SETTING_BODY_SHORT', 2);
}
if (! defined('TA_CANDLE_SETTING_BODY_DOJI')) {
    define('TA_CANDLE_SETTING_BODY_DOJI', 3);
}
if (! defined('TA_CANDLE_SETTING_SHADOW_LONG')) {
    define('TA_CANDLE_SETTING_SHADOW_LONG', 4);
}
if (! defined('TA_CANDLE_SETTING_SHADOW_VERY_LONG')) {
    define('TA_CANDLE_SETTING_SHADOW_VERY_LONG', 5);
}
if (! defined('TA_CANDLE_SETTING_SHADOW_SHORT')) {
    define('TA_CANDLE_SETTING_SHADOW_SHORT', 6);
}
if (! defined('TA_CANDLE_SETTING_SHADOW_VERY_SHORT')) {
    define('TA_CANDLE_SETTING_SHADOW_VERY_SHORT', 7);
}
if (! defined('TA_CANDLE_SETTING_NEAR')) {
    define('TA_CANDLE_SETTING_NEAR', 8);
}
if (! defined('TA_CANDLE_SETTING_FAR')) {
    define('TA_CANDLE_SETTING_FAR', 9);
}
if (! defined('TA_CANDLE_SETTING_EQUAL')) {
    define('TA_CANDLE_SETTING_EQUAL', 10);
}
if (! defined('TA_CANDLE_SETTING_ALL')) {
    define('TA_CANDLE_SETTING_ALL', 11);
}

if (! defined('TA_RANGE_TYPE_REAL_BODY')) {
    define('TA_RANGE_TYPE_REAL_BODY', 0);
}
if (! defined('TA_RANGE_TYPE_HIGH_LOW')) {
    define('TA_RANGE_TYPE_HIGH_LOW', 1);
}
if (! defined('TA_RANGE_TYPE_SHADOWS')) {
    define('TA_RANGE_TYPE_SHADOWS', 2);
}

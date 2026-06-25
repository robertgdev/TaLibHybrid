<?php

declare(strict_types=1);

namespace robertgdev\TaLibHybrid\Enum;

enum FuncUnstId: int
{
    case ADX = 0;
    case ADXR = 1;
    case ATR = 2;
    case CMO = 3;
    case DX = 4;
    case EMA = 5;
    case HT_DCPERIOD = 6;
    case HT_DCPHASE = 7;
    case HT_PHASOR = 8;
    case HT_SINE = 9;
    case HT_TRENDLINE = 10;
    case HT_TRENDMODE = 11;
    case KAMA = 12;
    case MAMA = 13;
    case MFI = 14;
    case MINUS_DI = 15;
    case MINUS_DM = 16;
    case NATR = 17;
    case PLUS_DI = 18;
    case PLUS_DM = 19;
    case RSI = 20;
    case STOCHRSI = 21;
    case T3 = 22;
    case ALL = 23;
    case NONE = 24;
}

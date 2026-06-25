<?php

declare(strict_types=1);

namespace robertgdev\TaLibHybrid\Enum;

enum CandleSettingType: int
{
    case BodyLong = 0;
    case BodyVeryLong = 1;
    case BodyShort = 2;
    case BodyDoji = 3;
    case ShadowLong = 4;
    case ShadowVeryLong = 5;
    case ShadowShort = 6;
    case ShadowVeryShort = 7;
    case Near = 8;
    case Far = 9;
    case Equal = 10;
    case AllCandleSettings = 11;
}

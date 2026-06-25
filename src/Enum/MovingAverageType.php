<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Enum;

enum MovingAverageType: int
{
    case SMA = 0;
    case EMA = 1;
    case WMA = 2;
    case DEMA = 3;
    case TEMA = 4;
    case TRIMA = 5;
    case KAMA = 6;
    case MAMA = 7;
    case T3 = 8;
}

<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Enum;

enum RangeType: int
{
    case RealBody = 0;
    case HighLow = 1;
    case Shadows = 2;
}

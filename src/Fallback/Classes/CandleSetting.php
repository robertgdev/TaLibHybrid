<?php

declare(strict_types=1);

namespace RobertGDev\TaLibHybrid\Fallback\Classes;

class CandleSetting
{
    public int $settingType;

    public int $rangeType;

    public int $avgPeriod;

    public float $factor;

    public function __construct(int $settingType, int $rangeType = 0, int $avgPeriod = 0, float $factor = 0.0)
    {
        $this->settingType = $settingType;
        $this->rangeType = $rangeType;
        $this->avgPeriod = $avgPeriod;
        $this->factor = $factor;
    }

    public function copyFrom(self $source): void
    {
        $this->settingType = $source->settingType;
        $this->rangeType = $source->rangeType;
        $this->avgPeriod = $source->avgPeriod;
        $this->factor = $source->factor;
    }
}

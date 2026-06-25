<?php

declare(strict_types=1);

namespace robertgdev\TaLibHybrid\Enum;

enum ReturnCode: int
{
    case Success = 0;
    case BadParam = 1;
    case OutOfRangeStartIndex = 2;
    case OutOfRangeEndIndex = 3;
    case AllocError = 4;
    case InternalError = 5;

    public function message(): string
    {
        return match ($this) {
            self::Success => 'Success',
            self::BadParam => 'Bad parameter',
            self::OutOfRangeStartIndex => 'Out of range start index',
            self::OutOfRangeEndIndex => 'Out of range end index',
            self::AllocError => 'Allocation error',
            self::InternalError => 'Internal error',
        };
    }

    public static function messageFromInt(int $code): string
    {
        return self::tryFrom($code)?->message() ?? 'Unknown return code';
    }
}

<?php

namespace SentrumDTO\Enums;

class ProductLanguage
{
    public const RUSSIAN = 'russian';
    public const UKRAINIAN = 'ukrainian';
    public const CHINESE = 'chinese';
    public const TAIWAN = 'taiwans';
    public const HONGKONG = 'hongkongs';

    private const DEFAULT = self::RUSSIAN;

    public static function getLanguage(string $language): string
    {
        if (in_array($language, [
            self::RUSSIAN,
            self::UKRAINIAN,
            self::CHINESE,
            self::TAIWAN,
            self::HONGKONG
        ])) {
            return $language;
        }

        return self::DEFAULT;
    }
}
<?php

namespace SentrumDTO\Enums;

class ProductType
{
    public const BOOK_ADULT = 'adult_book';
    public const BOOK_KIDS = 'kids_book';
    public const BOOK = 'book';
    public const AUDIOBOOK = 'audiobook';
    public const DIGITAL = 'digital';
    public const MOVIE = 'movie';
    public const DVD = 'dvd';
    public const MEDIA = 'media';
    public const SUBSCRIPTION = 'sub';
    public const ISSUE = 'issue';

    private const DEFAULT = self::BOOK;

    public static function getType(string $type): string
    {
        if (in_array($type, [
            self::BOOK_ADULT,
            self::BOOK_KIDS,
            self::BOOK,
            self::AUDIOBOOK,
            self::DIGITAL,
            self::MOVIE,
            self::DVD,
            self::MEDIA,
            self::SUBSCRIPTION,
            self::ISSUE
        ])) {
            return $type;
        }

        return self::DEFAULT;
    }
}
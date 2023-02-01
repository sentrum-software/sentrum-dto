<?php

namespace SentrumDTO\Enums;

class ProductCategory
{
    public const FICTION = 'fiction';
    public const NONFICTION = 'nonfiction';
    public const KIDS = 'kids';

    private const DEFAULT = self::NONFICTION;

    public static function getCategory(string $category): string
    {
        if (in_array($category, [
            self::FICTION,
            self::NONFICTION,
            self::KIDS
        ])) {
            return $category;
        }

        return self::DEFAULT;
    }
}
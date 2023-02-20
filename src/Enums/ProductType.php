<?php

namespace SentrumDTO\Enums;

enum ProductType: string
{
    case BOOK_ADULT = 'adult_book';
    case BOOK_KIDS = 'kids_book';
    case BOOK = 'book';
    case AUDIOBOOK = 'audiobook';
    case DIGITAL = 'digital';
    case MOVIE = 'movie';
    case DVD = 'dvd';
    case MEDIA = 'media';
    case SUBSCRIPTION = 'subscription';
    case ISSUE = 'issue';
}
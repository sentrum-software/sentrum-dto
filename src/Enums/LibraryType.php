<?php

namespace SentrumDTO\Enums;

enum LibraryType: string
{
    case PUBLIC = 'public';
    case SCHOOL = 'school';
    case ACADEMIC = 'academic';
    case OTHER = 'other';
}

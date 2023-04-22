<?php

namespace SentrumDTO;

use PHPUnit\Framework\TestCase;
use SentrumDTO\Enums\LibraryType;

/**
 * @covers \SentrumDTO\LibraryDTO
 */
class LibraryDTOTest extends TestCase
{
    public function testSuccessTransformation(): void
    {
        $loadedArray = DataProvider::getLibrary();
        $libraryDto = LibraryDTO::fromArray($loadedArray);

        $this->assertEquals($loadedArray, $libraryDto->toArray());
    }

    public function testWrongType(): void
    {
        $loadedArray = DataProvider::getLibrary();
        $loadedArray['type'] = 'undefined';

        $libraryDto = LibraryDTO::fromArray($loadedArray);
        $this->assertEquals(LibraryType::OTHER, $libraryDto->type);
    }
}

<?php

declare(strict_types=1);

namespace Ablabs\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Ablabs\CommissionTask\Service\Csv;

class CsvTest extends TestCase
{
    /**
     * @var Csv
     */
    private $csv;

    public function setUp()
    {
        $this->csv = new Csv("../../../sample.csv");
    }

    /**
     * @param string $leftOperand
     * @param string $rightOperand
     * @param string $expectation
     *
     * @dataProvider dataProviderForAddTesting
     */
    public function testStoreData(string $expectation)
    {
        $this->csv->storeData();
        $csvData = $this->csv->csvData;

        $this->assertEquals(
            $expectation,
            count($csvData)
        );
    }
}

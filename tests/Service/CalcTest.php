<?php

declare(strict_types=1);

namespace Ablabs\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Ablabs\CommissionTask\Service\Calc;
use Ablabs\CommissionTask\Service\Csv;

class CalcTest extends TestCase
{
    /**
     * @var Calc
     */
    private $calc;
    private $csv;

    public function setUp()
    {
        $this->calc = new Calc(2000);
        $this->csv = new Csv("../../../sample.csv");
    }

    /**
     * @param int $expectation
     */
    public function testcalcDipositCommission(int $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->calc->calcDipositCommission()
        );
    }

    /**
     * @param int $expectation
     */
    public function calcWithdrawComissionBusiness(int $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->calc->calcWithdrawComissionBusiness()
        );
    }

    /**
     * @param int $expectation
     */
    public function calcComissionableAmountPvt(int $expectation)
    {
        $this->csv->storeData();
        $csv_data = $this->csv->csvData;
        $user_data = $csv_data[2];
        $comissionable_amount = $this->csv->calcComissionableAmountPvt($user_data, $csv_data);

        $this->assertEquals(
            $expectation,
            $comissionable_amount
        );
    }
}

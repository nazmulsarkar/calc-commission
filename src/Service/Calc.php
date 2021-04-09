<?php

declare(strict_types=1);

namespace Ablabs\CommissionTask\Service;

class Calc
{
    private $_amount;
    private $_depositComission;
    private $_withdrawComissionPvt;
    private $_withdrawComissionBusi;

    public function __construct($amount)
    {
        $this->_amount = $amount;
        $this->_depositComission = 0.03;
        $this->_withdrawComissionPvt = 0.3;
        $this->_withdrawComissionBusi = 0.5;
    }

    public function calcDipositCommission()
    {
        return $this->_amount * ($this->_depositComission / 100);
    }

    public function calcWithdrawComissionPrivate()
    {
        return $this->_amount * ($this->_withdrawComissionPvt / 100);
    }

    public function calcWithdrawComissionBusiness()
    {
        return $this->_amount * ($this->_withdrawComissionBusi / 100);
    }

    public function calcComissionableAmountPvt($userData, $csvData)
    {
        $total_amount = 0;

        list($start_date, $end_date) = $this->x_week_range($userData[0]);

        $list_user_data = array_map(function ($csvD) use ($userData, $start_date, $end_date) {
            if ($csvD[1] == $userData[1] && $csvD[0] <= $end_date[0] && $csvD[0] >= $start_date) {
                return $csvD;
            }
        }, $csvData);

        if (count($list_user_data) > 3) {
            array_map(function ($list_data) use ($total_amount) {
                return $total_amount += $list_data[4];
            }, $list_user_data);
        }
        return $this->_amount = $total_amount > 1000 ? ($total_amount - 1000) : 0;
    }

    private function x_week_range($date)
    {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
        return array(
            date('Y-m-d', $start),
            date('Y-m-d', strtotime('next sunday', $start))
        );
    }

    // public function dateToday($userDate,$csvData){
    //     return $this->_day = 
    // }
}

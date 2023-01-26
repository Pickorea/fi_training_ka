<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use \App\Models\Training\Island;


class ExpensesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('San Francisco vs Boston.')
            ->setSubtitle('Wins during season 2021.')
            ->addData('Males', [Island::genderMaleCount()],)
            ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}

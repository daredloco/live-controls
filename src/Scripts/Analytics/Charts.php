<?php

namespace Helvetiapps\LiveControls\Scripts\Analytics;

use Exception;
use Illuminate\Support\Collection;

class Charts
{
    public static function pathsChartData(Collection $paths)
    {
        static::checkForLagoon();

        $pieChartTable = new \HelvetiApps\LagoonCharts\DataTables\PieChartTable();
        
        foreach($paths as $path => $amount)
        {
            $pieChartTable->addRow($path, $amount);
        }
        
        return $pieChartTable->toArray();
    }

    private static function checkForLagoon(bool $throwException = true):bool
    {
        $exists = class_exists('Helvetiapps\LagoonCharts\LagoonServiceProvider');
        if($throwException && !$exists)
        {
            throw new Exception('Please install helvetiapps/lagoon-charts with "composer require helvetiapps/lagoon-charts" to use charts!');
        }
        return $exists;
    }
}
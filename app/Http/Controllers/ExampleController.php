<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Generator;

class ExampleController extends Controller
{
    public function create()
    {
        return view('beranda', ['months' => iterator_to_array($this->getMonths())]);
    }

    protected function getMonths(): Generator {
        foreach (range(1, Carbon::MONTHS_PER_YEAR) as $month) {
            $human = DateTime::createFromFormat('!m', $month)->format('F');
            yield str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . $human;
        }
    }
}
?>
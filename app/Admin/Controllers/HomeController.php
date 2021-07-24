<?php

namespace App\Admin\Controllers;

use App\Admin\Services\Statistics;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('The Book')
            ->description('Статистика')
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->append(Statistics::render());
                });
            });
    }
}

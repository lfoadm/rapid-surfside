<?php

namespace App\Http\Controllers;

use App\Models\Admin\Brand;
use App\Models\Admin\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $dashboardDatas = DB::select("Select sum(total) As TotalAmount,
            sum(if(status='ordered', total, 0)) As TotalOrderedAmount,
            sum(if(status='delivered', total, 0)) As TotalDeliveredAmount,
            sum(if(status='canceled', total, 0)) As TotalCanceledAmount,
            Count(*) As Total,
            sum(if(status='ordered', 1, 0)) As TotalOrdered,
            sum(if(status='delivered', 1, 0)) As TotalDelivered,
            sum(if(status='canceled', 1, 0)) As TotalCanceled
            From Orders
        ");
        $monthlyDatas = DB::select("SELECT M.id As MonthNo, M.name As MonthName,
            IFNULL(D.TotalAmount, 0) As TotalAmount,
            IFNULL(D.TotalOrderedAmount, 0) As TotalOrderedAmount,
            IFNULL(D.TotalDeliveredAmount, 0) As TotalDeliveredAmount,
            IFNULL(D.TotalCanceledAmount, 0) As TotalCanceledAmount FROM month_names M LEFT JOIN (Select DATE_FORMAT(created_at, '%b') As MonthName,
            MONTH(created_at) As MonthNo,
            sum(total) As TotalAmount,
            sum(if(status = 'ordered', total, 0)) As TotalOrderedAmount,
            sum(if(status = 'delivered', total, 0)) As TotalDeliveredAmount,
            sum(if(status = 'canceled', total, 0)) As TotalCanceledAmount
            From Orders WHERE YEAR(created_at) = YEAR(NOW()) GROUP BY YEAR(created_at), MONTH(created_at), DATE_FORMAT(created_at, '%b')
            Order By MONTH(created_at)) D On D.MonthNo=M.id
        ");

        $AmountM = implode(',', collect($monthlyDatas)->pluck('TotalAmount')->toArray());
        $OrderedAmountM = implode(',', collect($monthlyDatas)->pluck('TotalOrderedAmount')->toArray());
        $DeliveredAmountM = implode(',', collect($monthlyDatas)->pluck('TotalDeliveredAmount')->toArray());
        $CanceledAmountM = implode(',', collect($monthlyDatas)->pluck('TotalCanceledAmount')->toArray());

        $TotalAmount = number_format(floatval(collect($monthlyDatas)->sum('TotalAmount')),2,',','.');
        $TotalOrderedAmount = number_format(floatval(collect($monthlyDatas)->sum('TotalOrderedAmount')),2,',','.');
        $TotalDeliveredAmount = number_format(floatval(collect($monthlyDatas)->sum('TotalDeliveredAmount')),2,',','.');
        $TotalCanceledAmount = number_format(floatval(collect($monthlyDatas)->sum('TotalCanceledAmount')),2,',','.');

        return view('admin.index', compact(
            'orders',
            'dashboardDatas',
            'monthlyDatas',
            'AmountM',
            'OrderedAmountM',
            'DeliveredAmountM',
            'CanceledAmountM',
            'TotalAmount',
            'TotalOrderedAmount',
            'TotalDeliveredAmount',
            'TotalCanceledAmount'
        ));
    }

}

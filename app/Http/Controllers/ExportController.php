<?php
namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\ExportDeposit;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportDeposit()
    {
        return Excel::download(new ExportDeposit, 'deposits.xlsx');
    }
}
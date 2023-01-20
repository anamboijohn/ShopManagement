<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class PDFController extends Controller
{
    public function generatePDF()
    {
        $records = Record::all();

        $data = [
            'title' => 'Sales Record for',
            'date' => date('m/d/Y'),
            'records'=>$records,
        ];

        $pdf = PDF::loadView(request('url'), $data);

        return $pdf->download('records.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function index(){
        $records = auth()->user()->records()->latest();

        return view('records.index', ['records'=>$records->filter(request(['date', 'search']))->paginate(30)->withQueryString()]);

    }

    public function generatePDF()
    {
        $records = auth()->user()->records()->latest();

        $data = [
            'title' => 'Sales Record for',
            'date' => date('m/d/Y'),
            'records'=>$records->filter(request(['date', 'search']))->get(),
        ];

        $pdf = PDF::loadView('records.loadPdf', $data);

        return $pdf->download('records.pdf');
    }
}

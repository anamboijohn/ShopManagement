<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function index(){
        $records = auth()->user()->records()->latest();

        return view('records.index', ['records'=>$records->filter(request(['date', 'search']))->paginate(30)->withQueryString()]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $records = Record::where('is_paid', false)
        ->orderBy('created_at', 'desc')
        ->get();

        return view("home.index", [
            "records" => $records
        ]);
    }
}

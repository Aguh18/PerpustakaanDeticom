<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = books::where('user_id', auth()->user()->id)->get();
        return view('dashboard', compact('books'));
    }

}

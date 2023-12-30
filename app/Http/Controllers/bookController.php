<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function newbookView()
    {
        return view('booksManagement.addBook');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function newbookPost(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'category' => 'required',
            'cover' => 'required|mimes:png,jpg,jpeg',
            'file' => 'required|mimes:pdf',
        ]);



        $cover = $request->file('cover')->store('public/books/cover/');
        $file = $request->file('file')->store('public/books/file/');

        books::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category' => $request->category,
            'cover' => $cover,
            'file' => $file,
            'user_id' => auth()->user()->id,
        ]);


        return redirect()->route('dashboard')->with('success', 'Book Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(books $books)
    {
        //
    }
}

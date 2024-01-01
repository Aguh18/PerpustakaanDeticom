<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function newbookView()
    {

        return view('booksManagement.addBook');
    }

    public function editbookView($id)
    {
        $book = books::findorFail($id);

        return view('booksManagement.editBook', compact('book'));
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


        $image = $request->file('cover');

        $input['imagename'] = time() . '.' . $image->extension();



        $destinationPathresize = public_path('storage/covers');

        $img = Image::make($image->path());

        $img->resize(100, 100, function ($constraint) {

            $constraint->aspectRatio();
        })->save($destinationPathresize . '/' . $input['imagename']);



        $destinationPath = public_path('storage/fullsizecover');

        $image->move($destinationPath, $input['imagename']);
        $destinationPath = public_path('storage/files');

        $file = $request->file('file');

        $input['filename'] = $file->getClientOriginalName() . time() . '.' . $file->extension();
        $path = $file->storeAs('public/files', $input['filename']);

        books::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category' => $request->category,
            'cover' => $input['imagename'],
            'file' => $input['filename'],
            'user_id' => auth()->user()->id,
        ]);




        return redirect()->route('dashboard')->with('success', 'Book Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(books $books)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editBook($id, request $request)
    {


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'category' => 'required',
            'cover' => 'mimes:png,jpg,jpeg',
            'file' => 'mimes:pdf',
        ]);
        @dd($request->all());
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
    public function Delete($id)
    {

        $book = books::find($id);

        Storage::delete('public/covers/' . $book->cover);
        Storage::delete('public/fullsizecover/' . $book->cover);
        Storage::delete('public/files/' . $book->file);
        $book->delete();

        return redirect()->route('dashboard')->with('success', 'Book Deleted Successfully');
    }
}

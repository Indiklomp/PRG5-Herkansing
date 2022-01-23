<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class BookController extends Controller
{
    public function index(Request $request){


        if(request('search')){
$search = request('search');
$books = Book::where ('title', 'LIKE', '%' . $search . '%')
    ->orWhere('genre', 'LIKE', '%' . $search . '%')
    ->orWhere('description', 'LIKE', '%' . $search . '%')
    ->orWhere('releaseyear', 'LIKE', '%' . $search . '%')
    ->get();
}

elseif(request('filter')){
$filter = request('filter');
$books = Book::where ('genre', 'LIKE', '%' .  $filter . '%')
    ->get();
}

else{
    $books = Book::all();
}
    return view('books.index', compact( 'books'));
    }


    public function show($id)
    {
        $books = book::find($id);
        return view('books.show')->with('book',$books);
    }


    public function create ()
    {
        $this->authorize('books_create');
        return view('books.create');
    }


    public function store(Request $request)
    {
        $this->authorize('books_create');
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'genre' => 'required',
            ]);

        $book = new Book;
        $book->title = $request->input('title');
        $book->releaseyear = $request->input('releaseyear');
        $book->description = $request->input('description');
        $book->genre = $request->input('genre');
        $book->image = $request->file('image')->storePublicly('images', 'public');
        $book->image = str_replace('images/', '', $book->image);
        $book->save();

        return redirect()->route('books.index');
    }


    public function edit(Book $book)
    {
        $this->authorize('books_edit');
        return view('books.edit',compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('books_edit');
        $book = Book::find($book->id);

        if (!$request->file('image') == "") {
            $book->image = $request->file('image')->storePublicly('images', 'public');
            $book->image = str_replace('images/', '', $book->image);
        }

        if (!$request->input('title') == "") {
            $book->title = $request->input('title');
        }

        if (!$request->input('genre') == "") {
            $book->genre = $request->input('genre');
        }

        if (!$request->input('description') == "") {
            $book->description = $request->input('description');
        }

        if (!$request->input('releaseyear') == "") {
            $book->releaseyear = $request->input('releaseyear');
        }


        $book->save();
        return redirect()->route('books.index');

    }


    public function destroy(Book $book)
    {
        $this->authorize('books_delete');
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');

    }


    public function updateStatus(Request $request)
    {
        $this->authorize('books_status');

        $book = Book::findOrFail($request->book_id);
        $book->status = $request->status;
        $book->save();


        return response()->json(['recommended successfully!']);
    }
}

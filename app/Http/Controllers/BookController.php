<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $title = 'My books';
        $books = book::all();

        return view('books/index', compact('title', 'books'));
    }

    public function show($id)
    {
        $books = book::find($id);
        return view('books.show')->with('book',$books);
    }


    public function create ()
    {
        return view('books.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'genre' => 'required',
            ]);

        $book = new Book;
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->genre = $request->input('genre');
        $book->image = $request->file('image')->storePublicly('images', 'public');
        $book->image = str_replace('images/', '', $book->image);
        $book->save();

        return redirect()->route('books.index');
    }


    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }


    public function update(Request $request, Book $book)
    {
        $book = Book::find($book->id);
        if (!$request->file('image') == "")
        {
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


        $book->save();
        return redirect()->route('books.index');

    }


    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');

    }
}

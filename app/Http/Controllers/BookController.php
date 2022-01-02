<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $title = 'My books';

        $books = book::where([
            ['title', '!=', Null],
            ['genre', '!=', Null],
            ['description', '!=', Null],
            ['id', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                    $query->orWhere('genre', 'LIKE', '%' . $term . '%')->get();
                    $query->orWhere('description', 'LIKE', '%' . $term . '%')->get();
                    $query->orWhere('id', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy("id", "asc")
            ->paginate(10);


        return view('books.index', compact('title', 'books'));
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
        $this->authorize('books_delete');
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');

    }
}

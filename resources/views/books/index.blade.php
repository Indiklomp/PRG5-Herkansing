
@extends('layouts.app')

@section('content')
    <h1> {{$title}}</h1>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('books.create') }}"> Create New book</a>
            </div>
        </div>
    </div>
    <table class="p-3 mb-2 bg-secondary text-light" class="table table-bordered">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <tr>
            <th>Number</th>
            <th>Title</th>
            <th>Image</th>
            <th>Details</th>
            <th>Genre</th>
            <th>Action</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td> {{$book['id']}}</td>
                <td> {{$book['title']}} </td>
                <td> <img src="{{ asset("storage/images/".$book['image']) }}"  height="100px" width="100px"> </td>
                <td> {{$book ['description']}}</td>
                <td> {{$book ['genre']}}</td>
                <td>
                    <form action="{{ route('books.destroy',$book) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('books.show',$book) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('books.edit',$book) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger">end of story</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

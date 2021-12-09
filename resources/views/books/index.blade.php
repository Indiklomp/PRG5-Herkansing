
@extends('layouts.app')

@section('content')
    <h1> {{$title}}</h1>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                @can('book-create')
                    <a class="btn btn-success" href="{{ route('books.create') }}"> Create New book</a>
                @endcan
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
            <th>Action</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td> {{$book['id']}}</td>
                <td> {{$book['title']}} </td>
                <td> <img src="{{ asset("storage/images/".$book['image']) }}"  height="100px" width="100px"> </td>
                <td> {{$book ['excerpt']}}</td>
                <td>
                    <form action="{{ route('books.destroy',$book) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('books.show',$book) }}">Show</a>
                        @can('book-edit')
                            <a class="btn btn-primary" href="{{ route('books.edit',$book) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('book-delete')
                            <button type="submit" class="btn btn-danger">DESTROY</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

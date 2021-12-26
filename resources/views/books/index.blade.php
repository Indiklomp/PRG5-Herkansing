
@extends('layouts.app')

@section('content')
    <h1> {{$title}}</h1>

    <div>
        <div class="mx-auto float-right">
            <div class="">
                <form action="{{ route('books.index') }}" method="GET" role="search">
                    <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="submit">Search</button>
                                        <span class="fas fa-search"></span>
                            </span>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Name or Type" id="term">
                        <a href="{{ route('books.index') }}" class="mt-1"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('books.create') }}"> Create New book</a>
            </div>
        </div>
    </div>
    <table class="p-3 mb-2 bg-light text-secondary" class="table table-bordered">

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
                <td> <img src="{{ asset("storage/images/".$book['image']) }}"  height="200px" width="140px"> </td>
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

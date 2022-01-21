
@extends('layouts.app')
@section('head')
    {{--    Ajax loading in --}}
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    {{--    Cloudflare Toggle   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@endsection

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >

    <h1> {{$title}}</h1>

    <div>
        <div class="mx-auto float-right">
                <form action="{{ route('books.index') }}" method="GET" role="search">
                    <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="submit">Search</button>
                                        <span class="fas fa-search"></span>
                            </span>
                        <input type="text" style="width: 33.3%"  name="term" placeholder="search or enter something" id="term">
                        <a href="{{ route('books.index') }}" class="mt-1"></a>



                        <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semi-bold">
                            <option value="genre" disabled selected> Genre</option>
                            @foreach($books as $book)
                            <option value="{{$book['genre']}}"> {{ $book['genre'] }}</option>
                            @endforeach
                        </select>




                    </div>
                </form>

        </div>
    </div>
    <br>


    <br>

        <br>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                @can ('books_create')
                    <a class="btn btn-success" href="{{ route('books.create') }}"> Create New book</a>
                    @endcan
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
            <th>Title</th>
            <th>Image</th>
            <th>release-year</th>
            <th>Description</th>
            <th>Genre</th>
            <th>read</th>
            <th>Action</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td style="width: 15%"> {{$book['title']}} </td>
                <td> <img src="{{ asset("storage/images/".$book['image']) }}"  height="200px" width="140px"> </td>
                <td> {{$book['releaseyear']}}</td>
                <td style="width: 33.3%" > {{$book ['description']}}</td>
                <td> {{$book ['genre']}}</td>
                <td>
                    <input type="checkbox" data-id="{{ $book->id }}" name="status"
                           class="js-switch" {{ $book->status == 1 ? 'checked' : '' }}>
                </td>
                <td>
                    <form action="{{ route('books.destroy',$book) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('books.show',$book) }}">Show</a>
                        @can ('books_edit')
                            <a class="btn btn-primary" href="{{ route('books.edit',$book) }}">Edit</a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can ('books_delete')
                            <button type="submit" class="btn btn-danger">end of story</button>
                            @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('script')
    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            let newSlider = new Switchery(html,  { size: 'small' });
        });
    </script>
    <script src="{{asset("js/slider.js")}}"></script>
@endsection

@extends('layouts.app')

 @section('content')
<div class="container"C6W8glH0hrvmaoSybXJ05LOrBJiAqD9Oq5QCt4gm.jpg
     style=" background:url('public/storage/images/C6W8glH0hrvmaoSybXJ05LOrBJiAqD9Oq5QCt4gm.jpg')">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                        <a href="{{ url('/books') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Take a look at your book collection</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

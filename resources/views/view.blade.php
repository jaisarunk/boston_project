@extends('layouts.app')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 mt-4">
            <div class="card p-4">
                <p>Name: <b>{{$data->book_name}}</b></p>
                <p>Author: <b>{{$data->author_name}}</b></p>
                <p>Price: <b>{{$data->price}}</b></p>
                <p>Language: <b>{{$data->language}}</b></p>
                <p>Access: <b>{{$data->access}}</b></p>
                <p>Country: <b>{{$data->country}}</b></p>
                <p>Pic: <img src="/storage/uploads/{{ $data->image}}" class="rounded ms-5" width="100px" height="130px" alt=""></p>
                
            </div>
            <a href="/"><button type="button" class="btn btn-info btn-sm mt-2">Back</button></a>
        </div>
    </div>
</div>
@endsection
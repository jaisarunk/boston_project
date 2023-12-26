@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="justify-content-center">
            <div class="col-sm-10"  style="margin-top: 5%;">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><h3>Show Available Books</h3></div>
                <div class="col-sm-4"><h3 class="text-end"><a href="form" ><btutton class=" btn btn-sm btn-info">Add</button></a></h3></div>
            </div>                                
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Language</th>
                        <th scope="col">Access</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = '1';?>
                        @if(count($data) >0)
                        @foreach($data as $index => $row)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td><a href="/product/{{$row->id}}/view" style="color:#fff;text-decoration:none">{{$row->book_name}} </a></td>
                            <td>{{$row->author_name}}</td>
                            <td>{{$row->price}}</td>
                            <td>@if($row->image !=null)<img src="storage/uploads/{{$row->image}}" height="70px" width="55px">@endif</td>
                            <td>{{$row->language}}</td>
                            <td>{{$row->access}}</td>
                            <td>{{$row->country}}</td>
                            <td><a href="api/product/{{Crypt::encrypt($row->id)}}/edit" ><btutton class=" btn btn-sm btn-primary">Edit</button></a>
                                <form action="delete/{{$row->id}}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger ms-1 ">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9" class="text-center">No record found</td>
                        </tr>
                        @endif                           
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
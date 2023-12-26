@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="justify-content-center">
            <div class="col-sm-6"  style="margin-top: 5%;">
            <div class="alert alert-success" id="alert_success" style="display:none"></div>
            <div class="alert alert-danger" id="alert_error" style="display:none"></div>
            <center><h3>Update Book Details</h3></center>
        <form action="/api/update" id="myForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Book Name</label>
                <input type="text" name="book_name" id="book_name" value="{{ old('book_name', $data->book_name)}}" class="form-control">
                <input type="hidden" name="book_id" value="{{$data->id}}">
                <div class="text-danger" id="book_name_error"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Author Name</label>
                <input type="text" name="author_name" id="author_name" value="{{old('author_name', $data->author_name)}}" class="form-control" >
                <div class="text-danger" id="author_name_error"></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <input type="text" name="price" id="price" value="{{old('price',$data->price)}}" class="form-control">
    
                <div class="text-danger" id="price_error"></div>
            </div>
            <div class="mb-3">
                <label for="formFileSm" class="form-label">Book Pic:</label>
                <input name="file" id="file" class="form-control form-control-sm" id="formFileSm" type="file">
                <div class="text-danger" id="file_error"> </div>
            </div>
            <legend>Language:</legend>
            <div class="form-check">
                <input class="form-check-input" name="language[]" {{in_array('English',explode(',',$data->language))?'checked':''}}  type="checkbox" value="English">
                <label class="form-check-label" for="flexCheckDefault">
                    English
                </label>
                </div>
            <div class="form-check">
                <input class="form-check-input" name="language[]" {{in_array('Hindi',explode(',',$data->language))?'checked':''}} type="checkbox" value="Hindi">
                <label class="form-check-label" for="flexCheckChecked">
                    Hindi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="language[]" {{in_array('Marathi',explode(',',$data->language))?'checked':''}} type="checkbox" value="Marathi" id="flexCheckChecked3">
                <label class="form-check-label" for="flexCheckChecked">
                    Marathi
                </label>
            </div>

            <legend>Access</legend>
            <div class="form-check">
                <input class="form-check-input access" {{ $data->access == 'Public' ? 'checked' : '' }} type="radio" name="access" value="Public">
                <label class="form-check-label" for="flexRadioDefault1">
                    Public
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input access" {{ $data->access == 'Private' ? 'checked' : '' }} type="radio" name="access" value="Private">
                <label class="form-check-label" for="flexRadioDefault2">
                    Private
                </label>                
            </div>
                <div class="text-danger"></div>
            <legend>Country:</legend>
            <select class="form-select" name="country" id="country" aria-label="Default select example">
                <option value="">Please select country</option>
                <option value="US" {{ $data->country == 'US' ? 'selected' : '' }}>US</option>
                <option value="UK" {{ $data->country == 'UK' ? 'selected' : '' }}>UK</option>
                <option value="Australia" {{ $data->country == 'Australia' ? 'selected' : '' }}>Australia</option>
            </select>
            <div class="text-danger" id="country_error"></div></br>
            <button type="button" id="form_submit" class="btn btn-primary">Submit</button>
            <a href="/"><button type="button" class="btn btn-defaut">Back</button></a>
        </form>
            </div>
        </div>        
    </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#alert_success").hide();
        $("#alert_error").hide();
        $("#alert_success").empty();
        $("#alert_error").empty();        
        $('#form_submit').click(function() {
            // Serialize the form data
            //var formData = $('#myForm').serialize();
            var formData = new FormData($('#myForm')[0]);
            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: '/api/update',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#response').text(response.message);
                    console.log(response);
                    if (response.status =="422")
                    {
                        console.log(Object.keys(response.errors).length);
                        for (let index = 0; index < Object.keys(response.errors).length; index++) {
                            const element = Object.keys(response.errors)[index];
                            //console.log(element);
                            if (element == "book_name") 
                            {
                                console.log('book_name', Object.values(response.errors)[index][0]);
                                $('#book_name_error').empty();
                                $('#book_name_error').append(Object.values(response.errors)[index][0]);    
                            }
                            if (element == "author_name") 
                            {
                                console.log('author_name', Object.values(response.errors)[index][0]);
                                $('#author_name_error').empty();
                                $('#author_name_error').append(Object.values(response.errors)[index][0]);    
                            }
                            if (element == "price") 
                            {
                                console.log('price', Object.values(response.errors)[index][0]);
                                $('#price_error').empty();
                                $('#price_error').append(Object.values(response.errors)[index][0]);    
                            }
                            if (element == "access") 
                            {
                                console.log('access', Object.values(response.errors)[index][0]);
                                $('#access_error').empty();
                                $('#access_error').append(Object.values(response.errors)[index][0]);    
                            }
                            if (element == "country") 
                            {
                                console.log('country', Object.values(response.errors)[index][0]);
                                $('#country_error').empty();
                                $('#country_error').append(Object.values(response.errors)[index][0]);    
                            }
                            if (element == "file") 
                            {
                                console.log('file', Object.values(response.errors)[index][0]);
                                $('#file_error').empty();
                                $('#file_error').append(Object.values(response.errors)[index][0]);    
                            }
                        }
                    }
                    else if(response.status =="200")
                    {
                        console.log(response.message);
                        $('#alert_success').css('display', 'block');
                        $("#alert_success").append(response.message);
                        $('#book_name_error').empty();
                        $('#author_name_error').empty();
                        $('#price_error').empty();
                        $('#access_error').empty();
                        $('#country_error').empty();
                        $('#file_error').empty();
                    }
                    else
                    {
                        console.log(response.message);
                        $('#alert_error').css('display', 'block');
                        $("#alert_error").append(response.message); 
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });        
    });

    $("#book_name").keypress(function(){
        $("#book_name_error").empty();
    });
    $("#author_name").keypress(function(){
        $("#author_name_error").empty();
    });
    $("#price").keypress(function(){
        $("#price_error").empty();
    });
    $("#file").keypress(function(){
        $("#file_error").empty();
    });
    $('#country').change(function(){
        //$(this).valid()
        $("#country_error").empty();
    });
    $('.access').change(function(){
        $("#access_error").empty();
    });
</script>
@endsection
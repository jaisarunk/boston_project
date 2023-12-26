<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    function show()
    {
        //$data = Form::all()->where('status', 'Active');
        $data = Form::latest()->get()->where('status', 'Active');
        //$data = Form::latest()->where('status', 'Active')->paginate(2);
        //return view ('show',compact('data'));
        //return $data;
        //$data = ();
        if ($data->count() > 0) 
        {
            return response()->json([
                'status' => 200,
                'data' => $data,
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'data' => 'No records found.',
            ], 404);
        }
        
    }
    function list()
    {
        $data = Form::latest()->where('status', 'Active')->paginate(8);
        return view ('show',compact('data'));
    }

    function form()
    {
        return view('form');
    }
    function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'book_name'=> 'required',
            'author_name'=> 'required',
            'price'=> 'required|numeric|min:2',
            'access' => 'required',
            'country' => 'required',
            'file' => 'sometimes|required|mimes:jpg,png,jpeg,pdf,gif',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status'=> 422,'errors' => $validator->messages(),422]);
        }
        else
        {
            $row_data = [
                'book_name' => $request->book_name,
                'author_name' => $request->author_name,
                'price' => $request->price,
                'access' => $request->access,
                'country' => $request->country,
            ];
            if ($request->hasFile('file')) 
            {
                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move('storage/uploads', $filename);
                $row_data['image'] = $filename;               
            }
            if($request->has('language'))
            {
                $language_array = $request->input('language');
                $row_data['language'] = implode(',', $language_array);
            }
            $data = Form::create($row_data); 
            if ($data) 
            {
                return response()->json(['status'=>200,'message'=> 'Book record created successfully.'], 200);
            }
            else
            {
                return response()->json(['status' =>500,'message'=> 'Something went wrong'],500);
            }
        }
    }   

    function edit($id)
    {
        //return decrypt($id);
        $data = Form::find(decrypt($id));
        //return $data;
        return view('edit', compact('data'));
    } 

    function delete($id)
    {
        //return $id;
        Form::destroy($id);
        //return back();
        return redirect()->back()->with('success', 'Record has been deleted successfully.');
    }

    function update(Request $request)
    {

        $record = Form::find($request->book_id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $validator = Validator::make($request->all(),[
            'book_name'=> 'required',
            'author_name'=> 'required',
            'price'=> 'required|numeric|min:2',
            'access' => 'required',
            'country' => 'required',
            'file' => 'sometimes|required|mimes:jpg,png,jpeg,pdf,gif',
        ]);
        if ($validator->fails())
        {
            return response()->json(['status'=> 422,'errors' => $validator->messages(),422]);
        }
        else
        {
            $row_data = [
                'book_name' => $request->book_name,
                'author_name' => $request->author_name,
                'price' => $request->price,
                'access' => $request->access,
                'country' => $request->country,
            ];
            if ($request->hasFile('file')) 
            {
                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move('storage/uploads', $filename);
                $row_data['image'] = $filename;               
            }
            if($request->has('language'))
            {
                $language_array = $request->input('language');
                $row_data['language'] = implode(',', $language_array);
            }
            $result = $record->update($row_data); 
            if ($result) 
            {
                return response()->json(['status'=>200,'message'=> 'Book record updated successfully.'], 200);
            }
            else
            {
                return response()->json(['status' =>500,'message'=> 'Something went wrong'],500);
            }
        }
    }

    function view($id)
    {
        //return decrypt($id);
        $data = Form::find($id);
        //return $data;
        return view('view', compact('data'));
    }
}

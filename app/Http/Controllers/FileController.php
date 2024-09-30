<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Validator;

class FileController extends Controller
{
    function index()
    {
     return view('newfileUpload');
    }

    function upload(Request $request)
    {
     $rules = array(
      'file'  => 'required|image|max:2048'
     );

     $error = Validator::make($request->all(), $rules);

     if($error->fails())
     {
      return response()->json(['errors' => $error->errors()->all()]);
     }

     $image = $request->file('file');

     $new_name = rand() . '.' . $image->getClientOriginalExtension();
     $image->move(public_path('tmp'), $new_name);

     $output = array(
         'success' => 'تم تحميل المرفق بنجاح',
         'image'  => '<img src="/tmp/'.$new_name.'" width="77" class="img-thumbnail" />',
         'image_input'  => '<input type="hidden" name="imagepath" value="'.$new_name.'" >',
         'image_name'  => 'delete_image_form("'.$new_name.'")',
        );
        return response()->json($output);
    }


    public function deleteImage(Request $r)
    {
        dd($r);
    }
}


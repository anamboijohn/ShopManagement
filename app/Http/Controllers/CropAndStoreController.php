<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CropAndStoreController extends Controller
{
    function crop(Request $request){
        $path = 'storage/Images';
        $this->deleteFile('storage/'.$product->image);
        $file = $request->file('file');
        $filename = $product->name . '-image';
        $path = $this->UploadFile($file, 'Images', 'public', $filename);
        // $product->update(['thumbnail'=>$path]);
        if($path){
            return response()->json(['status'=>1, 'msg'=>'Image has been updated successfully.', 'name'=>$filename]);
        }else{
              return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }
      }
    // function crop(Request $request, Product $product){
    //     $path = 'storage/Images';
    //     $this->deleteFile('storage/'.$product->image);
    //     $file = $request->file('file');
    //     $filename = $product->name . '-image';
    //     $path = $this->UploadFile($file, 'Images', 'public', $filename);
    //     // $product->update(['thumbnail'=>$path]);
    //     if($path){
    //         return response()->json(['status'=>1, 'msg'=>'Image has been updated successfully.', 'name'=>$filename]);
    //     }else{
    //           return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
    //     }
    //   }
}

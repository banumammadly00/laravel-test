<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $images= Gallery::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(12);

        return view('gallery.gallery',
         [
            'images'  =>  $images
         ]);
    }

    public function store(Request $request){

        $user_id= auth()->id();

        foreach( $request->image as $image){

       $request->validate([
           'image[]'  =>  'mimes:jpeg,jpg,svg,png'
       ]);

        $image ? $this->uploadimage($request, $image) : '' ;
        Gallery::create([
            'image'     =>  $image->getClientOriginalName(),
            'user_id'   =>  $user_id,
            'created'   =>  date("Y-m-d")
        ]);
        }

       return redirect()->back()->with('success', 'Images are uploaded successfully');

    }

    public  function  uploadimage(Request $request, $image){

         if($request->hasFile('image')) {

                $filename = $image->getClientOriginalName() ;
                $image->storeAs('images', $filename, 'public');
         }
    }

    public function delete(Gallery $id){

        $id->delete();
        Storage::delete('public/images/'.$id->image);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function bulkdelete(Request $request){

         $images= $request->check ;
         for($i=0; $i<count($images); $i++){
         $image= Gallery::find($images[$i])->image;
         Storage::delete('public/images/'.$image);
         }
         Gallery::destroy($request->check);
         //return $request->check;
         return redirect('gallery')->with('success', 'Selected images are deleted successfully');
    }
}

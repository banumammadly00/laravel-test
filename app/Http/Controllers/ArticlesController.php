<?php

namespace App\Http\Controllers;

use App\Articles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $articles= Articles::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(12);

        return view('articles.index', [
            'articles' => $articles
        ]);
        //test
    }


    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $date= $request->date;
        $time= $request->time;

        $request->image ? $this->uploadimage($request) : '' ;

        Articles::create([
            'title'     =>  $request->title,
            'lead'      =>  $request->lead,
            'body'      =>  $request->body,
            'status'    =>  $request->status,
            'image'     =>  $request->image ? $request->image->getClientOriginalName() : '',
            'user_name' =>  $request->user_name,
            'created'   =>  Carbon::now(),
            'updated'   =>  date("Y-m-d H:i", strtotime("$date $time")),
            'user_id'   =>  auth()->id()
        ]);

        return redirect('articles')->with('success', 'Articles are added successfully');
    }


    public function edit(Articles $id)
    {
         return  view('articles.edit', [
            'article' => $id
        ]);
    }


    public function update(Request $request, Articles $id)
    {
        $date= $request->date;
        $time= $request->time;

        $request->image ? $this->uploadimage($request,$id->image) : '' ;

        $id->update([
            'title'     =>  $request->title,
            'lead'      =>  $request->lead,
            'body'      =>  $request->body,
            'status'    =>  $request->status,
            'image'     =>  $request->image ? $request->image->getClientOriginalName() : $id->image,
            'user_name' =>  $request->user_name,
            'created'   =>   Carbon::now(),
            'updated'   =>  date("Y-m-d H:i", strtotime("$date $time")),
            'user_id'   =>  auth()->id()
        ]);

        return redirect('articles')->with('success', 'Articles are added successfully');

    }


    public function destroy(Articles $id)
    {
        Storage::delete('public/images/'.$id->image);
        $id->delete();
        return redirect()->back()->with('success', 'Deleted successfully');

    }


    public  function  uploadimage(Request $request, $image=null){

        if($request->hasFile('image')) {

            ($image) ? Storage::delete('public/images/'.$image) : '';

            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
        }
    }


    public  function updatestatus(Articles $id){

        $id->status == 1 ? $id->status=0 : $id->status=1 ;
       $id->save();
      return  redirect()->back();

    }

    public function bulkdelete(Request $request){

        $articles= $request->check ;
        for($i=0; $i<count($articles); $i++){
            $image= Articles::find($articles[$i])->image;
            Storage::delete('public/images/'.$image);
        }
        Articles::destroy($request->check);

        return redirect('articles')->with('success', 'Selected articles are deleted successfully');
    }
}

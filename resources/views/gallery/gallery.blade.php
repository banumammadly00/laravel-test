@extends('layouts.layout')
@section('content')
<style>
  .span_style{
        float: right;
         margin-right: 132px;
         margin-top: -80px;
         color: #ff5b60;
         font-size: medium;
    }
</style>
      <!-- Sidebar Navigation-->
      @include('partials.sidebar')

    <div class="page-content">
        <div class="page-header">
        <form action="{{ route('gallery.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
            <div class="col-md-3">
               <input id="image" type="file" name="image[]" multiple="multiple" accept="image/*" style="display: none;">
               <label class="form-control" for="image" style="cursor: pointer; ">Choose files<i class="fa fa-image" style="float: right;"></i></label>
            </div>
                <button class="btn btn-primary" type="submit" style="margin-right: 2%">Upload<i class="fa fa-download"></i></button>
                <div class="form-group">
                    <span style="font-size: medium; color: #1ba162;">{{ session()->has('success') ? session()->get('success') : "" }}</span></br>
                </div>
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <span style="color: #ff5b60; font-size: medium;">{{ $error }}</span>
                @endforeach
                @endif
            </div>
           </form>
       </div>
      <form action="{{ route('gallery.bulkdelete') }}" method="post">
           @csrf
           @method('delete')
         <button style="float: right; margin-top: -117px; margin-right: 11px" class="btn btn-primary" type="submit" id="delete-all"  onclick="delete_check()">
             Delete All
        </button>
            <span class="span_style"> </span>

        <section class="no-padding-bottom">
            <div class="container-fluid">
                <div class="row">
                @foreach ($images as $image)
                <div class="col-lg-4">
                    <div class="user-block block text-center">
                    <div> <img src="{{ asset('storage/images/'.$image->image)}}" alt="..." class="img-fluid">
                    <div class="details d-flex">
                    <div class="item"> <input class="checkbox-template" type="checkbox" name="check[]"  value="{{ $image->id }}"></div>
                        <div class="item"><i class="fa fa-gg"></i><strong></strong></div>
                        <div class="item">
                        </form>

                       <form action="{{ route('gallery.delete' , $image->id) }}" id="{{'delete-'.$image->id }}" method="post" >
                        @csrf
                        @method('delete')
                        <button type="submit" style="float:right;" class="btn btn-primary btn-round fa fa-trash-o" >
                        </button>
                       </form>
                       </div>
                     </div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
         </section>
<script>
    function delete_check() {
    let checkBox = document.getElementsByName("check[]");
    let checked=0;
    for (let i=0; i<checkBox.length; i++) {
    if(checkBox[i].checked == true){
        checked++
        }
    }
    (checked <= 0) ? alert('Choose files for delete') : "" ;
    }
</script>
<div>{{ $images->links()}}</div>
@endsection

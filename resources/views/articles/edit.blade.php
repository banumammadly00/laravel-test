@extends('layouts.layout')
@section('content')
    <!-- Sidebar Navigation-->
    @include('partials.sidebar')
    <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Basic forms</h2>
            </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Profile     </li>
            </ul>
        </div>

        <section class="no-padding-top">
            <div class="container-fluid">
                <div class="">
                    <!-- Form Elements -->
                    <div class="col-lg-12">
                        <div class="block">
                            <div class="title"><strong>User Profile</strong></div>
                            <form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="block-body">
                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            Title
                                            <input type="text" class="form-control"  name="title" placeholder="" value="{{$article->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            Lead
                                            <input type="text" class="form-control"  name="lead" placeholder="" value="{{$article->lead}}">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Writer
                                                    <input type="" placeholder="" class="form-control" name="user_name" value="{{$article->user_name}}">
                                                </div>
                                                <div class="col-md-4">
                                                    Date
                                                    <input type="date" placeholder="" class="form-control" name="date" value="{{ date('Y-m-d', strtotime($article->updated)) }}">
                                                </div>
                                                <div class="col-md-5">
                                                    Time
                                                    <input type="time" placeholder="" class="form-control"  name="time" value="{{ date( 'H:i',strtotime($article->updated)) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-sm-12">
                                            Body
                                            <textarea style="min-height: 260px; min-width: 100%;" class="form-control" name="body" id="body">{{$article->body}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-md-3">
                                            Image
                                            <input type="file" name="image" id="image" onchange="loadFile(event)" style="display: none;" placeholder="" class="form-control" value="">
                                            <label class="form-control" for="image" style="cursor: pointer;">Upload Image <i class="fa fa-image" style="float: right;"></i></label>
                                            <img id="output" width="200" src="{{asset('storage/images/'.$article->image)}}" >
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-md-3">
                                            Status
                                            <select type="checkbox" placeholder="" class="form-control"  name="status" >
                                                <option class="dropdown-menu show" value="1">  Active   </option>
                                                <option class="dropdown-menu show" value="0" selected="{{$article->status=0 ? "selected" :  ''}}"> Deactive </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="submit" value="" class="btn btn-primary"style="margin-left: 80px;"> Add </button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{route('articles')}}">
                                <button type="submit" class="btn btn-secondary" style="margin-top: -100px;"> Cancel </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    </section>
@endsection

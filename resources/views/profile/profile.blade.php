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
                <div class="row">
                    <!-- Form Elements -->
                    <div class="col-lg-4">
                   <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                       @csrf
                        <div class="user-block block text-center">
                                <div class="" >
                                    @if($user->image)
                                        <img  src="{{ asset('storage/images/'.$user->image) }}" alt="Select photo" class="img-fluid" style="border-radius: 50%; width:65%">
                                    @endif
                                </div>
                                <div style="margin-top: 17px;">
                                    <h3 class="h5">  </h3>
                                </div>
                                <div class="details">
                                    <div class="form-group ">
                                        <div class="input-group">
                                            <input type="file" name="image" id="image" style="display: none;" class="form-control">
                                            <label class="form-control" for="image" style="cursor: pointer; ">Choose profile photo <i class="fa fa-image" ></i></label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="block">
                            <div class="title"><strong>User Profile</strong></div>
                            <div class="form-group">
                                <span style="font-size: medium; color: #1ba162; margin-left: 26%; ">{{ session()->has('success') ? session()->get('success') : "" }}</span></br>
                            </div>
                            <div class="form-group">
                                <span style="font-size: medium; color: #cc7070; margin-left: 26%; ">{{ session()->has('error') ? session()->get('error') : "" }}</span></br>
                            </div>
                            @if ($errors->any())
                                <div class="form-group">
                                @foreach ($errors->all() as $error)
                                    <span style="font-size: medium; color: #cc7070; margin-left: 26%; ">{{ $error }}</span>
                               @endforeach
                                </div>
                            @endif
                            <div class="block-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" placeholder="" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label">Mail Address</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label"></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    Role
                                                    <input type="text" placeholder="" class="form-control" name="role" value="{{ $user->role }}">
                                                </div>
                                                <div class="col-md-4">
                                                    Mobile
                                                    <input type="number" placeholder="" class="form-control" name="mobile" value="{{ $user->mobile }}">
                                                </div>
                                                <div class="col-md-5">
                                                    Birthdate
                                                    <input type="date" placeholder=""  min="1920-12-02" class="form-control" name="birthdate" value="{{ $user->birthday }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label">About</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" placeholder="" name="about" style="height: 200px;">{{ $user->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 ml-auto" >
                                            <!-- <button type="submit" class="btn btn-secondary">Cancel</button> -->
                                            <button   style="float: right;" type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                              </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
@endsection
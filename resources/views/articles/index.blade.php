@extends('layouts.layout')
@section('content')
 <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 55px;
            height: 25px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            width: 20px;
            height: 18px;
        }

        input:checked + .slider {
            background-color: #843d3d;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <!-- Sidebar Navigation-->
    @include('partials.sidebar')
    <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Articles</h2>
            </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Articles </li>
            </ul>
        </div>

        <section class="no-padding-top">
            <div class="container-fluid">
                <div class="">
                    <form action="{{  route('articles.bulkdelete') }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="col-lg-12">
                            <div class="block margin-bottom-sm">
                                <div class="title">
                                    <strong>Striped Table</strong>
                                    <div class="form-group">
                                        <span style="font-size: medium; color: #1ba162; margin-left: 26%; ">{{ session()->has('success') ? session()->get('success') : "" }}</span></br>
                                    </div>
                                    <a class="btn btn-primary"  style="float: right;" href="{{route('articles.create')}}">
                                        +Add
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>    Id        </th>
                                            <th>    Title     </th>
                                            <th>    Lead      </th>
                                            <th>    Writer    </th>
                                            <th>    Datetime  </th>
                                            <th>    Image     </th>
                                            <th>    Status    </th>
                                            <th>    Edit      </th>
                                            <th>    Delete    </th>
                                            <th>
                                            <button class="btn btn-primary" type="submit" name="delete-all" onclick="delete_check()">
                                                    <i style="color: #ffffff;" class="fa fa-trash-o"></i>
                                           </button>
                                           </a>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($articles as $article)
                                        <tr>
                                            <th scope="row">
                                                <a href="#">{{$article->id}}</a>
                                            </th>
                                            <td>
                                                <a href="{{route('articles.edit', $article->id )}}">
                                                {{$article->title}}
                                                </a>
                                            </td>
                                            <td>
                                               {{$article->lead}}
                                            </td>

                                            <td>
                                                {{$article->lead}}
                                            </td>
                                            <td>
                                                {{date( 'd-m-Y H:i', strtotime($article->updated))}}
                                            </td>
                                            <td>
                                                <div style="width: 50px;">
                                                    <img class="img-fluid rounded-circle" src="{{asset('storage/images/'.$article->image)}}" style="width: 50px; height: 50px;">
                                                </div>
                                            </td>
                                            <td>
                                             <label class="switch">
                                                 <a href="{{route('articles.status', $article->id) }}">
                                                <input type="submit" name="status" value="" >
                                                <input type="checkbox" name="check" {{$article->status==1 ? 'checked' : ''}} >
                                                <span class="slider round"></span>
                                                 </a>
                                             </label>
                                           </td>
                                        <td>
                                         <a href="{{route('articles.edit', $article->id )}}">
                                            <i style="color: #ffffff;" class="fa fa-edit"></i>
                                         </a>
                                        </td>
                                        <td>
                                          <a href="{{ route('articles.destroy', $article->id )}}">
                                            <i style="color: #ffffff;" class="fa fa-trash-o"></i>
                                          </a>
                                        </td>
                                        <td>
                                            <input style="margin-left: 10px;" class="checkbox-template" id="checkboxCustom2"  type="checkbox" name="check[]" value="{{$article->id}}">
                                        </td>
                                      </tr>
                              @endforeach
                            </tbody>
                    </table>
                </div>
          </div>
    </div>
</form>
</div>
</section>
<script>
    function delete_check() {
        var checkBox = document.getElementsByName("check[]");
        var checked=0, i;
        for ( i=0; i<checkBox.length; i++) {
            if(checkBox[i].checked == true){
                checked++
            }
        }
        (checked <= 0) ?  alert('Choose files for delete') : "" ;
    }
</script>

@endsection
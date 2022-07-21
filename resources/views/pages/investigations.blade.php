@extends('layouts.app', ['activePage' => 'typography', 'titlePage' => __('Typography')])
  <style>
        /* generate serial no */
     body
    {
        counter-reset: Serial;           /* Set the Serial counter to 0 */
    }

    table
    {
        border-collapse: separate;
    }

    tr td:first-child:before
    {
    counter-increment: Serial;      /* Increment the Serial counter */
    content: counter(Serial); /* Display the counter */
    }

    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number]{
        -moz-appearance: textfield;
    }
    .main-panel>.content {
        margin-top: 30px !important;
        padding: 30px 15px;
        min-height: calc(100vh - 123px);
    }
     .button{
    float: right;
    margin-left: -50%;
    margin-top: 2em;
    }

    .error {
        color: red;
        font-size: 15px;
    }
 </style>


@section('content')
<div class="content">

        {{-- <div class="container-fluid col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card col-sm-12">
            <div class="card-header ">
                <h2 class="card-title"> Enter Core Investigations</h2>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{ url('masters/investigation') }}" method="post" >
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label >Core Investigations</label>
                                <select type="select" class="form-control" name="core">
                                    <option value="ns">-SELECT-</option>
                                    <option value="LAB">LAB</option>
                                    <option value="Outsource Lab">OUTSOURCE LAB</option>
                                    <option value="ECG">ECG</option>
                                </select>
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label >Name of Investigations</label>
                            <input type="text" class="form-control" name="investname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Code of Investigations</label>
                                <input type="text" class="form-control" name="code">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label >Price of Investigations</label>
                            <input type="number" class="form-control" name="price" >
                            </div>
                        </div>

                        <div class="col-md-6 offset-4">
                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div> --}}

        <div class="container-fluid col-md-12 col-lg-12">
                <div class="card col-sm-12">
                    <div class="card-header card-header-primary d-flex justify-content-between">
                        <h3 class="card-title">Core Investigations</h3>
                        <a href="" class="btn btn-info btn-sm button" data-toggle="modal" data-target="#myModal" >Add Investigation</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status') }}</span>
                                </div>
                                </div>
                            </div>
                         @endif
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class=" text-primary">
                            <th>SL</th>
                            <th>Investigation</th>
                            {{-- <th>Test Name</th> --}}
                            <th>Code</th>
                            <th>Price</th>
                            <th>Action</th>

                            </thead>
                            <tbody>
                            @foreach ($data as $key=>$datas)
                                <tr>
                                    <td> </td>
                                    {{-- <td>{{$datas->core}}</td> --}}
                                    <td>{{$datas->investname}}</td>
                                    <td>{{$datas->code}}</td>
                                    <td>{{$datas->price}}</td>
                                    <td style="display: flex;">
                                        <a href="{{url('masters/edit-investigation/'.$datas->id)}}" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                          style="margin-right:.6rem;"  data-target="#editinvestigations{{$datas->id}}"> Edit</a>
                                        {{-- edit modal --}}
                                            <div class="modal fade" id="editinvestigations{{$datas->id}}" role="dialog">
                                                <div class="modal-dialog modal-sm-10">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Edit Core Investigations</h2>
                                                            <div>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="container-fluid">
                                                                <form action="{{url('masters/update-investigation/'.$datas->id)}}" method="post">
                                                                     {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            {{-- <label>Edit Core Investigations</label> --}}
                                                                            <input type="hidden" class="form-control" name="core" value="LAB">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label> Edit Name of Investigations</label>
                                                                            <input type="text" class="form-control" name="investname" value="{{$datas->investname}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label> Edit Code of Investigations</label>
                                                                            <input type="text" class="form-control" name="code" value="{{$datas->code}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label> Edit Price of Investigations</label>
                                                                            <input type="number" class="form-control" name="price" value="{{$datas->price}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 offset-4">
                                                                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                        {{-- <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                                                        </div> --}}
                                                    </div>

                                                </div>
                                            </div>

                                      <form action="{{url('masters/investigation/'.$datas->id)}}" method="post">
                                           @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure ?')">Delete</button>
                                      </form>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm-10">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                <h2 class="modal-title">Add Core Investigations</h2>
                    <div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">

                <div class="container-fluid">
                     <form action="{{ url('masters/investigation') }}" method="post" >
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="container">
                            <div class="form-row">
                            <div class="form-group col-md-12">
                            {{-- <label >Core Investigations</label> --}}
                            <input type="hidden" class="form-control" name="core" value="LAB">
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label >Name of Investigations</label>
                            <input type="text" class="form-control" name="investname">
                            @error('investname')
                              <div class="error">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Code of Investigations</label>
                                <input type="text" class="form-control" name="code">
                                @error('code')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label >Price of Investigations</label>
                                <input type="number" class="form-control" name="price" >
                                @error('price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 offset-4">
                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
                        </div>
                        </div>
                    </form>
                </div>

                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                </div> --}}
            </div>

            </div>
        </div>

@endsection

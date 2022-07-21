@extends('layouts.app', ['activePage' => 'map', 'titlePage' => __('Map')])
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

    .main-panel>.content {
        margin-top: 30px !important;
        padding: 30px 15px;
        min-height: calc(100vh - 123px);
    }

    .error {
        color: red;
        font-size: 15px;
    }
 </style>

@section('content')

<div class="content">

        {{-- table --}}
        <div class="container-fluid col-md-12 col-lg-12">
                <div class="card">
                     <div class="card-header card-header-primary d-flex justify-content-between">
                        <h3 class="card-title">Referrer</h3>
                        <a href="" class="btn btn-info btn-sm button" data-toggle="modal" data-target="#myModal" >Add Referrer</a>
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
                        <table class="table">
                            <thead class=" text-primary">
                            <th>SL</th>
                            <th>Doctor's Name</th>
                            <th>Specialization</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach ($ref as $key=>$value)
                                <tr>
                                    <td> </td>
                                    <td>{{$value->doctorname}}</td>
                                    <td>{{$value->specialin}}</td>
                                    <td style="display:flex;">
                                      <a href="{{url('masters/edit-referrer/'.$value->id)}}" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                        style="margin-right:.6rem;" data-target="#editReferrer{{$value->id}}"> Edit</a>
                                            {{-- editmodal --}}
                                            <div class="modal fade" id="editReferrer{{$value->id}}" role="dialog">
                                                <div class="modal-dialog modal-sm-10">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Edit Referrer</h2>
                                                            <div>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="container-fluid">
                                                                <form action="{{url('masters/update-referrer/'.$value->id)}}" method="POST">

                                                                    {{ csrf_field() }}
                                                                    {{ method_field('PUT') }}
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="inputPassword4">Edit Doctor's Name</label>
                                                                            <input type="text" class="form-control" name="doctorname" value="{{$value->doctorname}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="inputAddress">Edit Specializations</label>
                                                                            <input type="text" class="form-control" name="specialin" value="{{$value->specialin}}">
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-md-6 offset-4">
                                                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        <form action="{{url('masters/referrer/'.$value->id)}}" method="post">
                                             @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure ?')">Delete</button>
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

         {{-- MODAL --}}

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm-10">
                    <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                    <h2 class="modal-title">Add Referrer</h2>
                        <div>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                            <form action="{{ url('masters/referrer') }}" method="post">

                                 {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="inputPassword4">Doctor's Name</label>
                                    <input type="text" class="form-control" name="doctorname">
                                    @error('doctorname')
                                        <div class="error">{{ $message }}</div>

                                    @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Specializations</label>
                                        <input type="text" class="form-control" name="specialin">
                                        @error('specialin')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6 offset-4">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>

</div>
@endsection


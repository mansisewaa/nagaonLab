@extends('layouts.app', [ 'titlePage' => __('Add Item')])


@section('content')
<div class="content">
    <div class="container-fluid  col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header card-header-primary d-flex justify-content-between">
                <h3 class="card-title">Price List</h3>
                <a href="" class="btn btn-info btn-sm button" data-toggle="modal" data-target="#myModal">Add Items</a>
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
                <div class="table-responsive ">
                    <table class="table table-hover ">
                        <thead class="text-primary">
                            <th>SL</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

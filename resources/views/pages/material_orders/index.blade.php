@extends('layouts.app', ['activePage' => 'materialorders', 'titlePage' => __('Price List')])
@section('css')
<style>
    .plus-minus-input {
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    }

    .plus-minus-input .input-group-field {
    text-align: center;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
    padding: 1rem;
    }

    .plus-minus-input .input-group-field::-webkit-inner-spin-button,
    .plus-minus-input .input-group-field ::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
    }

    .plus-minus-input .input-group-button .circle {
    border-radius: 50%;
    padding: 0.25em 0.8em;
    }
</style>
@endsection

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
                                <th>Name</th>
                                {{-- <th>Picture</th> --}}
                                <th>Price</th>
                                {{-- <th>Stock</th> --}}
                                <th>Action</th>
                            </thead>
                            <tbody>
                                {{-- @dump(auth()->user()) --}}
                                @forelse ($items as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            @if (auth()->user()->type == 'CC')
                                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#order_modal"> Order Item</a>
                                            @endif
                                        </td>

                                    </tr>
                                @empty

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Items</h2>
                    <div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="container-fluid" style="padding:inherit;">
                        <form action="{{route('price.list.store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Enter Name</label>
                                    <input type="text" class="form-control" name="name">
                                    @error('name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label> Enter Price</label>
                                    <input type="text" class="form-control" name="price">
                                    @error('address')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Add Image</label>
                                    <input type="file" class="from-control" name="file">
                                    @error('name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div> --}}


                            <div class="col-md-6 offset-5">
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Submit</button>
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
    <div class="modal fade" id="order_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Order Items</h3>
                    <div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" style="padding:inherit;">
                        <form action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{-- <label for="inputPassword4">Select Item</label> --}}
                                    <select name="item" id="" class="form-control">
                                        <option value="">Select Item</option>
                                        @foreach ($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    {{-- <label>Quantity</label>
                                    <input type="number" class="form-control" name="quantity" >
                                    @error('address')
                                    <div class="error">{{ $message }}</div>
                                    @enderror --}}
                                    <div class="input-group plus-minus-input">
                                        <div class="input-group-button">
                                            <button type="button" class="button hollow circle btn-sm " data-quantity="minus" data-field="quantity">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <input class="input-group-field form-control" type="number" name="quantity" value="0">
                                        <div class="input-group-button">
                                            <button type="button" class="button hollow circle  btn-sm" data-quantity="plus" data-field="quantity">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 offset-5">
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px">Place Order</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        jQuery(document).ready(function(){
        // This button will increment the value
        $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
        // Increment
        $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
        // Otherwise put a 0 there
        $('input[name='+fieldName+']').val(0);
        }
        });
        // This button will decrement the value till 0
        $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
        // Decrement one
        $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
        // Otherwise put a 0 there
        $('input[name='+fieldName+']').val(0);
        }
        });
        });
    </script>
@endpush

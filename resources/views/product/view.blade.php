@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header bg-success text-light">
                    Product
                </div>
                <div class="card-body">
                    @if (session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete')}}
                    </div>
                    @endif
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Description</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Alert Quantity</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->product_name}}</td>
                                    <td>{{ str_limit($product->product_description,20)}}</td>
                                    <td>{{ $product->product_price}}</td>
                                    <td>{{ $product->product_quantity}}</td>
                                    <td>{{ $product->alert_quantity}}</td>
                                    <td>
                                        <img src="{{ asset('uploads/product_photos')}}/{{ $product->product_image}}" alt="not found" width="50">
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($product->created_at)->format('d-M-Y h:i A') }} <br>
                                        <span class="text-info"> {{ ($product->created_at)->diffForHumans()}} </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('edit/product') }}/{{ $product->id }}" class="btn btn-info text-light">Edit</a>
                                            <a href="{{ url('delete/product') }}/{{ $product->id }}" class="btn btn-warning text-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center text-danger">
                                    <td colspan="8">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links()}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger text-light">Deleted Product</div>
                    <div class="card-body">
                        @if (session('success1'))
                        <div class="alert alert-danger">
                            {{ session('success1')}}
                        </div>
                        @endif
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Description</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Alert Quantity</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($deletedProducts as $dproduct)
                                    <tr>
                                        <td>{{ $dproduct->product_name}}</td>
                                        <td>{{ str_limit($dproduct->product_description,20)}}</td>
                                        <td>{{ $dproduct->product_price}}</td>
                                        <td>{{ $dproduct->product_quantity}}</td>
                                        <td>{{ $dproduct->alert_quantity}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/product_photos')}}/{{ $dproduct->product_image}}" alt="not found" width="50">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('restore/product') }}/{{ $dproduct->id }}" class="btn btn-success">Restore</a>
                                                <a href="{{ url('force/delete/product') }}/{{ $dproduct->id }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="7">No data available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $products->links()}}
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        
        <div class="col-3">
            <div class="card">
                <div class="card-header bg-success text-light">
                    Add Product
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status')}}
                    </div>
                    @endif
                    
                    @if($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{url('add/product/insert')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" placeholder="Enter your product name" name="product_name" value="{{ old('product_name')}}">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea class="form-control" rows="3" name="product_description" >{{ old('product_description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" placeholder="Enter your product price" name="product_price" value="{{ old('product_price')}}">
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter your product quantity" name="product_quantity" value="{{ old('product_quantity')}}">
                        </div>
                        <div class="form-group">
                            <label>Alert Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter your product Alert quantity " name="alert_quantity" value="{{ old('alert_quantity')}}">
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="product_image">
                        </div>
                        <div >
                            <button  type="submit" class="btn btn-primary offset-4">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
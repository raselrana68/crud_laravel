@extends('layouts/app')

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-8">
                <div class="card">
                    <div class="card-header bg-success">
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
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                <td>{{ $product->product_name}}</td>
                                <td>{{ $product->product_description}}</td>
                                <td>{{ $product->product_price}}</td>
                                <td>{{ $product->product_quantity}}</td>
                                <td>{{ $product->alert_quantity}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('edit/product') }}/{{ $product->id }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('delete/product') }}/{{ $product->id }}" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                                </tr>
                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="6">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
              <div class="card">
                  <div class="card-header bg-success">
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
                  <form action="{{url('add/product/insert')}}" method="post">
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
                            <div align="center">
                              <button  type="submit" class="btn btn-primary">Add Product</button>
                            </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
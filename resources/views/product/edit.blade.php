@extends('layouts/app')

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-6 offset-3">
              <div class="card">
                  <div class="card-header bg-success">
                    Edit Product
                  </div>
                  <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status')}}
                        </div>
                      @endif
                  <form action="{{url('edit/product/insert')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" value="{{ $product_info -> id}}">
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="product_name" value="{{ $product_info -> product_name}}">
                            </div>
                            <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea class="form-control" rows="3" name="product_description" >{{ $product_info -> product_description }}</textarea>
                            </div>
                            <div class="form-group">
                                    <label>Product Price</label>
                                    <input type="text" class="form-control" name="product_price" value="{{ $product_info -> product_price}}">
                            </div>
                            <div class="form-group">
                                    <label>Product Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity" value="{{ $product_info -> product_quantity}}">
                            </div>
                            <div class="form-group">
                                    <label>Alert Quantity</label>
                                    <input type="text" class="form-control" name="alert_quantity" value="{{ $product_info -> alert_quantity}}">
                            </div>
                            <div align="center">
                              <button  type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
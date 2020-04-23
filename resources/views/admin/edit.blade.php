@extends('admin.app')

@section('title') Edit Order @endsection

@section('styles')
    <style>
        .app-content {
            margin-left: 0px;
            margin: 50px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.report') }}"> Back</a>
            </div>
        </div>
    </div>

    @include('admin.message')

    <form action="{{ route('admin.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Client:</strong>
                    <select name="client" id="client" class="form-control">
                        @foreach($clients as $client)
                            @if ($product->client_id == $client->id)
                                <option value="{{ $client->id }}" selected>{{ $client->client }}</option>
                            @else
                                <option value="{{ $client->id }}">{{ $client->client }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product:</strong>
                    <input type="text" name="product" value="{{ $product->product }}" class="form-control"
                           placeholder="Product"
                           required>
                    <input type="hidden" name="client_id" value="{{ $product->client_id }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total:</strong>
                    <input type="text" name="total" class="form-control" placeholder="Total"
                           value="{{ str_replace(" ","",number_format($product->total, 2, '.', ' ')) }}"
                           required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="text" name="date" value="{{ date('m/d/Y', strtotime($product->date)) }}"
                           class="form-control" placeholder="MM/DD/YYYY"
                           required
                           class="date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

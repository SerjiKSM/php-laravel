@extends('admin.app')

@section('title') Orders @endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/styles.css') }}"/>
@endsection

@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h1 class="title-page">Orders</h1>
        </div>
    </section>

    @include('admin.message')

    {{--search--}}
    <div class="container">
        <div class="row">
            <div class="form-inline">
                <form class="form-inline" action="{{ route('admin.search') }}" method="GET">
                    <div class="form-group mb-2">
                        <input type="search" class="form-control" placeholder="Keyword"
                               name="search" id="search">
                    </div>

                    <div class="form-group mx-sm-3 mb-2">
                        @php $types = ['all' => 'All', 'client' => 'Client',
                            'product' => 'Product', 'total' => 'Total', 'date' => 'Date']; @endphp
                        <select class="form-control" id="" name="searchParam">
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary ">Search</button>
                    </div>
                </form>
                <div class="form-group mb-3">
                    <a href="{{ route('admin.report') }}" class="btn btn-primary button-send-report">
                        Show all data
                    </a>
                </div>
            </div>

        </div>
    </div>

    @if(isset($products))
        {{--graphic--}}
        <div class="container">
            <div class="row">
                {!! $chartData->container() !!}
            </div>
        </div>

        <div class="container">
            <form class="form-inline" action="{{ route('admin.sendemail.send') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <button type="submit" id="confirm-send-email" class="btn btn-primary ">Email this report</button>
                </div>
            </form>
        </div>

        <section class="section-content bg padding-y border-top">
            <div class="container">
                <div class="row">
                    <main class="col-sm-12">
                        <div class="tile">
                            <div class="tile-body">
                                <table class="table table-hover table-bordered rwd-table" id="sampleTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Client</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr>
                                            <td data-th="Client">
                                                {{ $item->client->client }}
                                            </td>
                                            <td data-th="Product">
                                                <var class="price">{{ $item->product }}</var>
                                            </td>
                                            <td data-th="Total">
                                                {{ str_replace(" ","",number_format($item->total, 2, '.', ' ')) }}
                                            </td>
                                            <td data-th="Date">
                                                {{ \Carbon\Carbon::parse($item->date)->format('m/d/Y') }}
                                            </td>
                                            <td class="text-center" data-th="Action">
                                                <form id="delete" action="{{ route('admin.destroy',$item->id) }}"
                                                      method="POST">
                                                    <a class="btn btn-primary"
                                                       href="{{ route('admin.edit',$item->id) }}">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger deleteSubmit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="center-pagination">
                                {{ $products->render() }}
                            </div>

                        </div>
                    </main>
                </div>
            </div>
        </section>
    @else
        <br>
        <p class="alert alert-warning">
            {{ $message }}
        </p>
    @endif

@endsection

@push('scripts')
    {{--filter--}}
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

    <script type="text/javascript" src="{{ asset('backend/js/script.js') }}"></script>
@endpush

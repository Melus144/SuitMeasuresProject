@extends('admin.layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@endpush

@section('content-header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div>
            <h1 class="mt-4 h3">Measures</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Measures</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table id="measuresTable" class="table">
                <thead class="card-header">
                <tr>
                    <th>Customer ID</th>
                    <th>Language</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Updated At</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('admin.measures.partials._index_js')

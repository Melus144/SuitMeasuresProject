@extends('admin.layouts.app')


@section('content-header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div>
            <h1 class="mt-4 h3">Edit Measure</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.measures.index')}}">measures</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Measure</div>
                <div class="card-body">
                   <form method="post" action="{{route('admin.measures.update', ['measure' => $measures])}}">
                        @csrf
                        @method('PATCH')
                        @include('admin.measures.partials._fields')
                       <div class="d-flex justify-content-between align-items-center mt-3">
                           <div class="d-inline-block">
                               <x-submit-button/>
                           </div>
                           <div class="form-check form-switch ms-3">
                               <input class="form-check-input" type="checkbox" name="reviewed" id="reviewed" value="1" @if($measures->reviewed == 1) checked @endif>
                               <label class="form-check-label" for="reviewed">
                                   Reviewed
                               </label>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

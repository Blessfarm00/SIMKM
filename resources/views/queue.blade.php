<!-- resources/views/queue.blade.php -->
@extends('admin.front.main')

@section('container')
@if(Session::has('error'))
        <div class="alert alert-danger">
               {{ Session::get('error') }}
    </div>
@endif



<div class="pagetitle">
        <h1>No Antrian</h1>
        <nav>
            <ol class="breadcrumb">
                 <h1>Nomor Anntrian Anda: {{ $queueNumber }}</h1>
            </ol>
        </nav>
    </div>

    @endsection



@extends('adminlte::page')
@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-12 col-lg-5 border mt-5 p-3">        
            @include('auth.passwords.change-form')
        </div>
    </div>
@endsection
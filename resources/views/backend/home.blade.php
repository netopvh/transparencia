@extends('backend.layouts.master')
@section('scripts-before')
    <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@stop



@section('content')
    {!! Breadcrumbs::render('admin.home') !!}
    <br>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

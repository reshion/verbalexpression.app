@extends('ve.master')


@section('content')

    <div class="container docs">
        <div class="row article">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {!! $content !!}
            </div>
        </div>
    </div>

@stop


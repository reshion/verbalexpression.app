@extends('ve.master')

@section('content')

    <div class="container docs">
        <div class="row">

            <section class="sidebar col-lg-3 col-md-2 col-sm-3 col-xs-12">
                {!! $navigation !!}
            </section>

            <article class="col-lg-8 col-lg-offset-1 col-md-10 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {!! $content !!}
                    </div>
                </div>
            </article>
        </div>
    </div>


@stop

@section('scripts_after')

    <script type="text/javascript">
        var fixLinks = function() {

            var links = document.querySelectorAll('.docs .sidebar a');

            for (var index = 0; index < links.length; ++index) {
                var singleLink = links[index];
                var currentHref = singleLink.href;

                if(currentHref.indexOf("documentation/documentation/") > -1) {

                    var find = 'documentation/documentation/';
                    var re = new RegExp(find, 'g');

                    currentHref = currentHref.replace(re, 'documentation/');
                }

                singleLink.href = currentHref;
            }
        };

        fixLinks();
    </script>

@stop



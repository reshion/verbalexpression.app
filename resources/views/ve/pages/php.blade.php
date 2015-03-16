@extends('ve.master')

@section('scripts_before')
    {{-- Scripts are locally stored due to phantomjs / ghostdriver cross domain loading--}}
    {{--<script src="https://code.angularjs.org/1.3.9/angular.min.js"></script>--}}
    {{--<script src="https://code.angularjs.org/1.3.9/angular-route.min.js"></script>--}}
    <script src="{{asset('/js/libs/angular-1.3.9/angular.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/libs/angular-1.3.9/angular-route.min.js')}}"></script>
    <script src="{{asset('/js/ve/app.js')}}"></script>
    <script src="{{asset('/js/ve/keyword/keywordService.js')}}"></script>
    <script src="{{asset('/js/ve/creator/creatorService.js')}}"></script>
    <script src="{{asset('/js/ve/tester/testerService.js')}}"></script>
    <script src="{{asset('/js/ve/creator/creatorCtrl.js')}}"></script>
    <script src="{{asset('/js/ve/tester/testerCtrl.js')}}"></script>
@stop

@section('content')
    <div class="row" data-ng-controller="creatorController as creator">
        <div class="col-md-6 col-sm-8 col-lg-6 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="page-header">
                        <h2>Verbalise expression</h2>
                    </div>
                </div>
            </div>
            <form class="form" data-ng-submit="creator.getRegex()">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="row keyvalue" data-ng-repeat="keyValue in creator.pairs">
                            <div class="form-group input-group-sm col-lg-4 col-md-4 col-xs-3 col-sm-3">
                                <label for="key<%$index%>" data-ng-show="$index%5 == 0">Keyword</label>
                                <select class="form-control select-key" data-ng-model="::creator.pairs[$index].keyword"
                                        id="key<%$index%>"
                                        data-ng-init="::creator.pairs[$index].keyword = creator.pairs[$index].keyword || creator.keywords[0].key"
                                        data-ng-options="keyword.key as keyword.key for keyword in creator.keywords">
                                </select>
                            </div>
                            <div class="form-group input-group-sm col-lg-6 col-md-6 col-xs-7 col-sm-6">
                                <label for="value<%$index%>" data-ng-show="$index%5 == 0">Value</label>
                                <input type="text" id="value<%$index%>" data-ng-trim="false"
                                       data-ng-model="::creator.pairs[$index].value"
                                       class="form-control input-value" placeholder="value"/>
                            </div>
                            <div class="form-group input-group-sm col-lg-2 col-md-2 col-xs-2 col-sm-3">
                                <label for="addkey" data-ng-show="$index%5 == 0">&nbsp;</label>
                                <div class="btn-group btn-group-sm btn-block" role="group" aria-label="...">
                                    <button type="button" class="btn btn-danger btn-remove-pair col-gl-6 col-md-6 col-sm-6 col-xs-6" data-ng-click="creator.removePair($index)" id="btnRemove<%$index%>">-</button>
                                    <button type="button" class="btn btn-success btn-add-pair col-gl-6 col-md-6 col-sm-6 col-xs-6" data-ng-click="creator.addPair('', '', $index+1)" id="btnAdd<%$index%>">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row creator-splash" data-ng-cloak="">
                    <div class="col-md-12 col-sm12 col-lg-12 col-xs-12">
                        <div class="alert alert-info">
                            Loading ...
                        </div>
                    </div>
                </div>
                <div class="row creator-error" data-ng-if="creator.error">
                    <div class="col-md-12 col-sm12 col-lg-12 col-xs-12">
                        <div class="alert"
                             data-ng-class="{
                            'alert-info': creator.error.type=='info',
                            'alert-danger': creator.error.type=='danger'
                        }">

                            <% creator.error.message %>
                        </div>
                    </div>
                </div>

                <div class="row top-buffer">
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xs-6">
                        <input type="reset" class="btn btn-warning btn-block" value="Reset"
                               data-ng-click="creator.reset()" id="btn-reset"/>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-6 col-md-offset-5 col-sm-offset-5 col-lg-offset-5">
                        <input type="submit" id='btn-generate' class="btn btn-primary btn-block" value="Generate"/>
                    </div>

                </div>
            </form>
        </div>
        <div class="col-md-6 col-sm-4 col-lg-6 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="page-header">
                        <h2>Generated expression</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <label for="regex">Regular Expression</label>
                    <input type="text" id="regex" class="form-control" data-ng-model="creator.regex.combined" readonly
                           placeholder="Verbalise your expression at first...">

                </div>
            </div>

            @include('ve.pages.php.tester')


            <div class="row" data-ng-if="creator.regex.combined.length > 0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>
                        Test your expression at
                        <a target="_blank" href="https://regex101.com/?regex=<%creator.regex.expression%>&options=<%creator.regex.modifiers%>">regex101.com</a>
                        .
                    </p>
                </div>
            </div>

        </div>
    </div>

@stop


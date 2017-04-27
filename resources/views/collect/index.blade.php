@extends('layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
<div id="page-wrapper">
    <div class="row">
        <h3 class="page-header" style="margin-left: 2%;">Thu nhập</h3>

        <div class="col-lg-12">
            <h4 class="col-md-9">
                <a href="#" data-toggle="modal" 
                    data-target="#collect-create"
                    class="add">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Thêm
                </a>
            </h4>
        </div>

        <div id="collect-filter">
            @include('collect.filter')
        </div>

        <div class="col-lg-12" id="collect-all">
            @include('collect.list')
        </div>
    </div>
</div>

@include('collect.create')


<script src="{{ asset('js/collect.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}">
</script>
<script src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/locale/vi.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
    var picker = new datepicker;
    picker.init();
    var url = {
        'add': '{{ route('collect.addAjax') }}',
        'delete': '{{ route('collect.deleteAjax') }}',
        'filter': '{{ route('collect.filterDate') }}'
    }
    var collect = new collect;
    collect.init(url);
</script>
@stop

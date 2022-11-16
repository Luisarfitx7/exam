@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover"  id="booksDatatableAjax">
                        <thead>
                            <tr role="row" class="filter">
                                <td></td>
                                <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="{{__('Title')}}"></td>
                                <td><input type="text" class="form-control" name="category" id="category" autocomplete="off" placeholder="{{__('Category')}}"></td>
                                <td><input type="text" class="form-control" name="author" id="author" autocomplete="off" placeholder="{{__('Author')}}"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr role="row" class="heading">
                                <th>{{__('Id')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Author')}}</th>
                                <th>{{__('Release Date')}}</th>
                                <th>{{__('Publish Date')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>    
<script>
    $(function () {
        var oTable = $('#booksDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            responsive:true,
            autoWidth:false,
            ajax: {
                url: '{!! route('api.books') !!}',
                data: function (d) {
                    d.title = $('#title').val();
                    d.category = $('#category').val();
                    d.author = $('#author').val();
                }
            }, columns: [
                {data: 'id', id: 'id'},
                {data: 'title', title: 'title'},
                {data: 'category', name: 'category'},
                {data: 'author', name: 'author'},
                {data: 'release_date1', release_date: 'release_date'},
                {data: 'publish_date1', publish_date: 'publish_date'},
            ],});
        $('#datatable-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#title').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#category').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#author').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
</script> 
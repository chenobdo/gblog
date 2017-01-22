@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>Messages
                    <small>» Listing</small>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="message-table"
                       class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th name="mid">Mid</th>
                        <th name="from_username">FromUser</th>
                        <th name="to_username">ToUser</th>
                        <th name="message">Message</th>
                        <th name="created_at" class="col-sm-1">Time</th>
                        <th name="actions" data-sortable="false">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $("#message-table").DataTable({
                "order": [[0, "desc"]],
                "processing": true,
                "serverSide": true,
                "search": false,
                "ajax": {
                    "url": "/admin/message/paginate",
                    "dataSrc": function (json) {
                        $.each(json.data, function (k, v) {
                            v.actions = '<a href="/admin/message/' + v.mid +
                                    '" class="btn btn-xs btn-warning">' +
                                    '<i class="fa fa-eye"></i> View</a>';
                        });
                        return json.data;
                    }
                },
                "columns": [
                    {"data": "mid"},
                    {"data": "from_username"},
                    {"data": "to_username"},
                    {"data": "message"},
                    {"data": "created_at"},
                    {"data": "actions"}
                ]
            });
        });
    </script>
@stop
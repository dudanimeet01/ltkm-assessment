@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">All txt files</h4>
                <p class="card-category">Here is a list of all txt files to get sum</p>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($txt_files_list as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item}}</td>
                            <td>
                                <a href="{{route('delete.file',Crypt::encryptString($item))}}">Delete file</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $("body").on("change", "#txt_files_list", function (e) {
            $.ajax({
                url: '{{route("get.the.count")}}',
                type: "POST",
                data: JSON.stringify({
                    _token : '{{csrf_token()}}',
                    filename : $(this).val(),
                }),
                processData: true,
                contentType: 'application/json',
                success: function (data) {
                    if (data.status == 200) {
                        demo.showNotification(data.msg,'success');
                        var html = ``;
                        $.each(data.data, function( index, value ) {
                            html = html + `<tr><td>${index} : ${value} </td></tr>`;
                        });
                        html = `<table class="result-table">${html}</table>`;
                        $('#result').html(html);
                    } else {
                        demo.showNotification(data.msg,'danger');
                    }
                },
                error: function () {
                    alert("Something went wrong. Please try again.");
                },
            });
        });
    });
</script>
@endpush

@endsection
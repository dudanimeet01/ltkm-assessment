@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Upload new file</h4>
                <p class="card-category">Please select the file from local system to upload</p>
            </div>
            <div class="card-body">
                <form action="{{route('upload.file.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>.txt File <em>*</em></label>
                        <input name="file" class="form-control" type="file">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-fill pull-right">Upload File</button>
                    </div>
                </form>
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
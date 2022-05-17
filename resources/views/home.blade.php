@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Get The Count</h4>
                <p class="card-category">Please select the file from below dropdown to get count</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Files <em>*</em></label>
                    <select name="txt_files_list" id="txt_files_list" class="form-control">
                        <option value="">-- Please select one file --</option>
                        @foreach ($txt_files_list as $item)
                        <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>

                    <div class="row" id="result">
                        <table class="result-table">
                            <tr><td class="text-muted">Please select file to fetch counts</td></tr>
                        </table>
                    </div>
                </div>

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
                        var html = `<table class="result-table">
                            <tr><td class="text-muted">Please select file to fetch counts</td></tr>
                        </table>`
                        $('#result').html(html);
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
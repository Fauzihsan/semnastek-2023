@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header gradient text-white ">{{ __('Tambah Artikel') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['url' => route('author.store') ]) !!}
                        @include('author.form')
                        <a href="{{ route('author.index') }}" class="btn btn-danger">{{ __('Batal') }}</a>
                       {{ Form::submit('Kirim', ['class' => 'btn btn-primary']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script>
        function getScope(id) {
            $('#scope').empty();

            let prodi = $(id).val();

            if (prodi === '') {
                $('#scope').empty();
            } else {
                $.ajax({
                    type: "get",
                    url: "{{ url('/') }}/author/ajax/getDataScope/"+prodi,
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (i) {
                            $('#scope').append($('<option></option>').val(data[i].id).text(data[i].scope));
                        });
                    }
                })
            }
        }
    </script>
@endsection

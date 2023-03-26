@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Tambah Author Artikel #{{$article->id}}</div>

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

                    {!! Form::open(['url' => route('author.add.store') ]) !!}
                        @include('author.form-author')
                        <a href="{{ route('author.show', $article->id) }}" class="btn btn-danger">{{ __('Batal') }}</a>
                       {{ Form::submit('Kirim', ['class' => 'btn btn-primary']) }}
                       <a href="{{ route('author.detail', $article->id) }}" class="btn btn-link">Tampilkan Semua Author</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

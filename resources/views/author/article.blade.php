@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Artikel #{{ auth()->user()->name }}</div>

                <div class="card-body">
                    <a href="{{ route('author.create') }}" class="btn btn-primary">Tambah Artikel</a>

                    <br/><hr/>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="text-center table-primary">
                            <th>NO</th>
                            <th>ID ARTIKEL</th>
                            <th>JUDUL</th>
                            <th>TANGGAL DIBUAT</th>
                            <th>TANGGAL SUBMIT</th>
                            <th>AKSI</th>
                        </tr>
                        @php $no = 1; @endphp
                        @foreach ($articles as $article)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td><a href="{{ route('author.show', $article->id) }}" class="btn btn-link">{{ $article->id }}</a></td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->submitted_at }}</td>
                            <td>
                                @if($article->submitted_at == null)
                                    {!! Form::open(['url' => route('author.destroy', $article->id), 'method' => 'DELETE', 'id' => 'form-hapus']) !!}
                                        <button class="btn btn-link text-danger text-small show_confirm" data-name="{{$article->id}}" title="hapus draft">[hapus draft]</button>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

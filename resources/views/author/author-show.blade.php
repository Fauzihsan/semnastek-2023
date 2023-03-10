@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Semua Author untuk Artikel #{{$article->id}}</div>

                <div class="card-body">
                    <a href="{{ route('author.add', $article->id) }}" class="btn btn-primary">Tambah Author</a>

                    <br/><hr/>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="text-center table-primary">
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>AFILIASI</th>
                            <th>AKSI</th>
                        </tr>
                        @php $no = 1; @endphp
                        @foreach ($authors as $author)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $author->firstname.' '.$author->lastname}}</td>
                            <td>{{ $author->email }}</td>
                            <td>{{ $author->affiliation }}</td>
                            <td>
                                {!! Form::open(['url' => route('author.ubah.delete', $author->id), 'method' => 'DELETE', 'id' => 'form-hapus']) !!}
                                        <a href="{{ route('author.ubah', $author->id) }}" class="btn btn-link" title="Edit Author"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-link text-danger show_confirm" data-name="{{$author->firstname.' '.$author->lastname}}"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                    <hr/>
                    {{-- <a href="{{ route('author.index') }}" class="btn btn-link">[Semua Artikel]</a> --}}
                    <a href="{{ route('author.show', $article->id) }}" class="btn btn-link">[Detail Artikel #{{$article->id}}]</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

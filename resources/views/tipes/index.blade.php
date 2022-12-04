@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tipe</h2>
            </div>
            <div class="pull-right">
                @can('tipe-create')
                <a class="btn btn-success" href="/tipes/create"> Create New tipe</a>
                @endcan
                @can('tipe-delete')
                <a class="btn btn-info" href="tipes/trash"> Deleted tipe</a>
                @endcan
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="/tipes/search" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID tipe</th>
            <th>Nama tipe</th>
            <th>Tipe Serangan</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($tipes as $tipe)
        <tr>
            <td>{{ $tipe->id_tipe }}</td>
            <td>{{ $tipe->nama_tipe }}</td>
            <td>{{ $tipe->tipe_serangan }}</td>
            <td>
                <form action="/tipes/delete/{{$tipe->id_tipe}}" method="POST">
                    <a class="btn btn-info" href="/tipes/show/{{$tipe->id_tipe}}">Show</a>
                    @can('tipe-edit')
                    <a class="btn btn-primary" href="/tipes/edit/{{$tipe->id_tipe}}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('tipe-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
@endsection


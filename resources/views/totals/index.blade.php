@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Database Hero</h2>
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
            <th>Nama Hero</th>
            <th>Tipe</th>
            <th>Posisi</th>
        </tr>
        @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama_hero }}</td>
            <td>{{ $join->nama_tipe }}</td>
            <td>{{ $join->nama_posisi}} </td>
        </tr>
        @endforeach
    </table>
    {!! $joins->links() !!}
@endsection
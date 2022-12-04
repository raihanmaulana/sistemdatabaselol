@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Posisi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posisis.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID posisi:</strong>
                {{ $posisi->id_posisi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama posisi:</strong>
                {{ $posisi->nama_posisi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Spell:</strong>
                {{ $posisi->spell }}
            </div>
        </div>
    </div>
@endsection


@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Tipe</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tipes.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID tipe:</strong>
                {{ $tipe->id_tipe }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama tipe:</strong>
                {{ $tipe->nama_tipe }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipe Serangan:</strong>
                {{ $tipe->tipe_serangan }}
            </div>
        </div>
    </div>
@endsection


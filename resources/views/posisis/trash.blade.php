@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Posisi</h2>
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
            <th>ID posisi</th>
            <th>Nama posisi</th>
            <th>Spell</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($posisis as $posisi)
        <tr>
            <td>{{ $posisi->id_posisi }}</td>
            <td>{{ $posisi->nama_posisi }}</td>
            <td>{{ $posisi->spell }}</td>
            <td>
                <div class="d-flex gap-3">
                    <form class="m-0" id="restoreForm" action="/posisis/trash/restore/{{$posisi->id_posisi}}" method="POST">
                        @csrf
                         <button class="btn btn-info" type="submit">Restore</button>
                    </form>
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                        Hapus
                    </button>
                </div>
                    

                   
                <!-- Modal -->
                <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <form action="/posisis/trash/forcedelete/{{$posisi->id_posisi}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="trash/{{ $posisi->id_posisi }}/forcedelete">Delete</a> -->
            </td>
        </tr>
        @endforeach
    </table>

@endsection


@extends('layouts.admin.master')

@section('title', 'Edit Complaint')

@section('breadcrumb-title')
    <h3>Edit Complaint</h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Complaint</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.complaint.update', $id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Tambahkan ini untuk spoofing metode PUT -->
                            <div class="form-group">
                                <label for="TANGGAL_INPUT">Tanggal Input</label>
                                <input type="text" name="TANGGAL_INPUT" class="form-control" value="{{ $complaint->TANGGAL_INPUT }}">
                            </div>
                            <div class="form-group">
                                <label for="KETERANGAN_SHIFT">Keterangan Shift</label>
                                <input type="text" name="KETERANGAN_SHIFT" class="form-control" value="{{ $complaint->KETERANGAN_SHIFT }}">
                            </div>
                            <div class="form-group">
                                <label for="NAMA_PETUGAS">Nama Petugas</label>
                                <input type="text" name="NAMA_PETUGAS" class="form-control" value="{{ $complaint->NAMA_PETUGAS }}">
                            </div>
                            <div class="form-group">
                                <label for="IDENTITAS">Identitas Pasien</label>
                                <input type="text" name="IDENTITAS" class="form-control" value="{{ $complaint->IDENTITAS }}">
                            </div>
                            <div class="form-group">
                                <label for="KONDISI_IGD">Kondisi IGD</label>
                                <input type="text" name="KONDISI_IGD" class="form-control" value="{{ $complaint->KONDISI_IGD }}">
                            </div>
                            <!-- Tambahkan field lain yang ingin diupdate -->

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

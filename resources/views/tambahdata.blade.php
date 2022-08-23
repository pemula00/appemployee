@extends('layout.admin')

@section('content')
    <title>Data Pegawai</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="/insertdata" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        @error('name')
                                            <div class="alert alert-info">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin"
                                            aria-label="Default select example">
                                            <option selected>Pilih Jenis Kelamin</option>
                                            <option value="laki-laki">Laki - Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail" class="form-label">No. Telpon</label>
                                        <input type="number" name="notelp" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        @error('notelp')
                                            <div class="alert alert-info">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Masukkan Foto</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

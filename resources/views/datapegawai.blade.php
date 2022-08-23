@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pegawai</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="container">
                <a href="/tambahpegawai" class="btn btn-success mb-1">+ Tambah</a>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <form action="/pegawai" method="GET">
                            <input type="search" id="inputPassword6" name="search" class="form-control mb-1"
                                aria-describedby="passwordHelpInline" placeholder="Search">
                        </form>
                    </div>
                    <div class="col-auto">
                        <a href="/exportpdf" class="btn btn-danger mb-1">Export PDF</a>
                    </div>

                    <div class="col-auto">
                        <a href="/exportexcel" class="btn btn-success mb-1">Export Excel</a>
                    </div>

                    <div class="col-auto">
                        <button type="button" class="btn btn-info mb-1" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Import Data
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/importexcel" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="file" name="file" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import File</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $index => $d)
                                    <tr>
                                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                                        <td>{{ $d->name }}</td>
                                        <td>
                                            <img src="{{ asset('fotopegawai/' . $d->foto) }}" style="width: 40px"
                                                alt="">
                                        </td>
                                        <td>{{ $d->jenis_kelamin }}</td>
                                        <td>0{{ $d->notelp }}</td>
                                        <td>{{ $d->created_at->diffForhumans() }}</td>
                                        <td>
                                            <a href="/editdata/{{ $d->id }}" class="btn btn-primary">Edit</a>
                                            <a href="#" class="btn btn-danger delete" data-id="{{ $d->id }}"
                                                data-nama="{{ $d->name }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

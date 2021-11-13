@extends('layouts.menu')

@section('container-head')
<div class="container-fluid">
  @if(session()->has('prosesError'))
      <div class="alert alert-danger alert-dismissable fade show" role="alert">
        {{ session('prosesError') }}
      </div>
    @endif
    @if(session()->has('prosesBerhasil'))
      <div class="alert alert-success alert-dismissable fade show" role="alert">
        {{ session('prosesBerhasil') }}
      </div>
    @endif
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Pengaduan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
        <li class="breadcrumb-item active">Pengaduan</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('container-body')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Daftar Pengaduan</h3>

    <div class="card-tools">
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 13%">
                    ID Pengaduan
                </th>
                <th style="width: 12%">
                    ID Pengguna
                </th>
                <th style="width: 12%">
                  Nama Pengguna
              </th>
                <th style="width: 10%">
                    No Hak
                </th>
                <th style="width: 30%">
                    Pengaduan
                </th>
                <th style="width: 5%">
                    Status
                </th>
                <th style="width: 5%">
                  Lihat
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach ($pengaduan as $pengaduana)
            <tr>
              {{-- ->get(['id','nohak', 'noberkas', 'tahun_berkas', 'alamat', 'deskripsi', 'case_status']) --}}
                    <td>{{ $pengaduana->id}}</td>
                    <td>{{ $pengaduana->user_id}}</td>
                    <td>{{ $pengaduana->name}}</td>
                    <td>{{ $pengaduana->nohak}}</td>
                    <td>{{ $pengaduana->deskripsi}}</td>
                    <td>
                      @if ($pengaduana->case_status == 1)
                        <span class="badge badge-danger">Baru</span>
                      @endif 

                      @if ($pengaduana->case_status == 2)
                        <span class="badge badge-info">Proses</span>
                      @endif 

                      @if ($pengaduana->case_status == 3)
                        <span class="badge badge-success">Selesai</span>
                      @endif 
                      
                    </td>
                    <td>
                      <a href="/pengaduan/{{ $pengaduana->id }}" class="badge bg-info">
                      <i class="fas fa-eye"></i></a>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection
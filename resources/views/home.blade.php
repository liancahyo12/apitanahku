@extends('layouts.menu')

@section('container-head')
<div class="container-fluid">
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissable fade show" role="alert">
      {{ session('success') }}
    </div>
  @endif
  
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('container-body')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-question"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pengaduan Baru</span>
          <span class="info-box-number">{{ $countnew }}</span>
          <!-- <span class="info-box-number">
            10
            <small>%</small>
          </span> -->
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hands-helping"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Pengaduan</span>
          <span class="info-box-number">{{ $countall }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clipboard-check"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pengaduan Selesai</span>
          <span class="info-box-number">{{ $countdone }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Pengguna</span>
          <span class="info-box-number">{{ $countuser }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
</div><!-- /.container-fluid -->
@endsection
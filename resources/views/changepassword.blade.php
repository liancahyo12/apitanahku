@extends('layouts.menu')

@section('container-head')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Ubah Password</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
        <li class="breadcrumb-item active">Ganti Password</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('container-body')
<div class="card-body">
      {{-- <p class="login-box-msg">Ubah Password.</p> --}}
      <form action="/ubahpassword" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf         
        <div class="row ">
            <div class="col-md-12">
                <div class="main-card mb-3  card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{-- <h4>Ubah Password</h4> --}}
                        </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="current_password">Password lama</label>
                                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autofocus required
                                        placeholder="Enter current password">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                   
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="new_password ">Password baru</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                                        placeholder="Enter the new password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                   
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="confirm_password">Konfirmasi password</label>
                                    <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required placeholder="Enter same password">
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                   
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-first mt-4 ml-2">
                                <button type="submit" class="btn btn-primary"
                                    id="formSubmit">Ubah password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </form>

      {{-- <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
@endsection
@extends('layouts.menudetail')

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
      <h1 class="m-0">Detail Pengaduan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
        <li class="breadcrumb-item active">Detail Pengaduan</li>
      </ol>
    </div><!-- /.col -->
    
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('container-body')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-sm-8">
    <!-- DIRECT CHAT -->

    <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-comments"></i> Pesan Pengaduan</h3>
  
        <div class="card-tools">
        </div>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
          @foreach ($komen as $komena)
          @if (empty($komena->admin_id))
          <!-- Message. Default to the left -->
          <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-left">{{ $komena->name }}</span>
              <span class="direct-chat-timestamp float-right">{{ $komena->created_at }}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="message user image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              {{ $komena->komen }}
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
          @endif
          @if (empty($komena->user_id))
          <!-- Message to the right -->
          <div class="direct-chat-msg right">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-right">{{ $komena->admin_name }}</span>
              <span class="direct-chat-timestamp float-left">{{ $komena->created_at }}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="message user image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              {{ $komena->komen }}
            </div>
            <!-- /.direct-chat-text -->
          </div>
          @endif
          @endforeach
          <!-- /.direct-chat-msg -->
        </div>
        <!-- /.direct-chat-pane -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if ( $pengaduanb->case_status==1)
                  
              @endif
              @if ( $pengaduanb->case_status==2)
              
              <form action="/pengaduan/balas/{{ $pengaduanb->id }}" method="post">
                @csrf
                <div class="input-group">
                  <input type="text" name="komen" id="komen" placeholder="Type Message ..." class="form-control">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-primary">Send</button>
                  </span>
                </div>
              </form>
              @endif
              @if ( $pengaduanb->case_status==3)
                  
              @endif
        
      </div>
      <!-- /.card-footer-->
    </div>
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-clipboard-list"></i>
            Rincian
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <dl>
            {{-- ->get(['id','nohak', 'noberkas', 'tahun_berkas', 'alamat', 'deskripsi', 'case_status']) --}}
            <dt>Id Pengaduan</dt>
            <dd>{{ $pengaduanb->id }}</dd>
            <dt>Nama Pengguna</dt>
            <dd>{{ $pengaduanb->name }}</dd>
            <dt>Nomor Hak</dt>
            <dd>{{ $pengaduanb->nohak }}</dd>
            <dt>Nomor Berkas</dt>
            <dd>{{ $pengaduanb->noberkas }}</dd>
            <dt>Tahun Berkas</dt>
            <dd>{{ $pengaduanb->tahun_berkas }}</dd>
            <dt>Alamat Tanah</dt>
            <dd>{{ $pengaduanb->alamat }}</dd>
            <dt>Deskripsi</dt>
            <dd>{{ $pengaduanb->deskripsi }}</dd>
            <dt>Status</dt>
            <dd>
              @if ($pengaduanb->case_status == 1)
                        <span class="badge badge-danger">Baru</span>
                      @endif 

                      @if ($pengaduanb->case_status == 2)
                        <span class="badge badge-info">Proses</span>
                      @endif 

                      @if ($pengaduanb->case_status == 3)
                        <span class="badge badge-success">Selesai</span>
                      @endif 
            </dd>
          </dl>
          
          <div class="text-center mt-5 mb-3">
            @if ($pengaduanb->case_status == 1)
            <form action="/pengaduan/proses/{{ $pengaduanb->id }}" method="post">
              @method('put')
              @csrf
              <button type="submit" class="btn btn-primary btn-block">Proses</button>
            </form>
            @endif 

            @if ($pengaduanb->case_status == 2)
            <form action="/pengaduan/selesaikan/{{ $pengaduanb->id }}" method="post">
              @method('put')
              @csrf
              <button type="submit" class="btn btn-primary btn-block">Selesaikan</button>
            </form>
            @endif 

            @if ($pengaduanb->case_status == 3)
            @endif 
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>
  </div>
</div><!-- /.container-fluid -->

@endsection
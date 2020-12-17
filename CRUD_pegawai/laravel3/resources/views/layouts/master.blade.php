<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Template Laravel</title>

  <!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
<link rel="stylesheet" href="{{asset('/dashboard/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{url('/dashboard/dist/img/logo_baba.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{url('/dashboard/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pegawai</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col-6">
                <h3></h3>
            </div>
            <div class="col-6">
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data Pegawai
                </button>
                <br>
            </div>
            <table border = "0" class="table">
                <tr class="bg-info">
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Gambar</th>
                    <th colspan = "3">Aksi</th>
                <tr>
                    @php $no = 1; @endphp
                @foreach($pegawai as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p->pegawai_nama }}</td>
                    <td>{{ $p->pegawai_jabatan }}</td>
                    <td>{{ $p->pegawai_alamat }}</td>
                    <td><img src="gambar/{{ $p->pegawai_gambar}}" width="150px" height="100px"></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$p->pegawai_id}}">
                        Edit
                        </button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#hapusModal{{$p->pegawai_id}}">Hapus</button>

                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal Tambah-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="/pegawai/store" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pegawai</label>
                  <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Pegawai">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Masukkan gambar</label>
                    <input type="file" name="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan Pegawai</label>
                    <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Jabatan Pegawai">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat Pegawai</label>
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan Alamat Pegawai"></textarea>
                  </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Pegawai</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->
@foreach ($pegawai as $p)
<div class="modal fade" id="editModal{{ $p->pegawai_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="/pegawai/update" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type = "hidden" name = "id" value = "{{$p->pegawai_id}}"><br>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pegawai</label>
                  <input type="text" name="nama" value = "{{$p->pegawai_nama}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Pegawai">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan Pegawai</label>
                    <input type="text" name="jabatan" value = "{{$p->pegawai_jabatan}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Jabatan Pegawai">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gambar Pegawai</label><br>
                    <input type="hidden" name="file_old" value="{{$p->pegawai_gambar}}">
                    <img src="gambar/{{ $p->pegawai_gambar}}" alt="{{$p->pegawai_gambar}}" width="150px" height="100px"><br>
                    <input type="file" class="form-control" id="exampleFormControlfile1" rows="3" name="file" >
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat Pegawai</label>
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan Alamat Pegawai">{{$p->pegawai_alamat}}</textarea>
                  </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Pegawai</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Hapus-->
@foreach ($pegawai as $p)
<div class="modal fade" id="hapusModal{{$p->pegawai_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="/pegawai/hapus/{{$p->pegawai_id}}" method="GET">
                {{csrf_field()}}
                <input type = "hidden" name = "id" value = "{{$p->pegawai_id}}"><br>
                Hapus Data Pegawai?
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-primary">Hapus</button>
            </form>
            </div>
    </div>
    </div>
</div>
@endforeach


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <a href="https://babastudio.com">Babastudio </a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dashboard/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

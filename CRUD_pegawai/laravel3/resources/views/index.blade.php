<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Belajar Laravel</title>
</head>
<body>
    <div class="container">
        @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col-6">
                <h3>Data Pegawai</h3>
            </div>
            <div class="col-6">
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data Pegawai
                </button>
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
                    {{-- <a href = "/pegawai/hapus/{{$p->pegawai_id}}">Hapus</a></td> --}}
                </tr>
                @endforeach
            </table>
        </div>
    </div>


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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>

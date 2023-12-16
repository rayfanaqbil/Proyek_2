@include('layout/header')


<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Edit Produk</b></h2>

    <form action="{{ route('produk-update', ['kode' => $data['produk']->kode_produk]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputFile"><img src="{{ asset('Image/produk/' . optional($data['produk'])->image) }}" width="100"></label>
            <input type="file" id="exampleInputFile" name="files">
            <p class="help-block">Pilih Gambar untuk Produk</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Produk</label>
                    <<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="{{ $data['produk']['kode_produk'] ?? '' }}">
                    <input type="hidden" name="kode" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" value="{{ isset($data['kode_produk']) ? $data['kode_produk'] : '' }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" name="nama" value="{{ isset($data['nama']) ? $data['nama'] : '' }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="masukkan Harga" name="harga" value="{{ isset($data['harga']) ? $data['harga'] : '' }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Deskripsi</label>
            <textarea name="desk" class="form-control">{{ isset($data['deskripsi']) ? $data['deskripsi'] : '' }}</textarea>
        </div>
        <hr>
        <h3 style="width: 100%; border-bottom: 4px solid gray">BOM Produk</h3>

        <div class="row">
            <div class="col-md-6">
                <h4>Daftar Material</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Material</th>
                            <th scope="col">Nama Material</th>
                        </tr>
                    </thead>
                    @foreach ($data['inventory'] as $row2)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $row2['kode_bk'] }}</td>
                            <td>{{ $row2['nama'] }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>

            <div class="col-md-6">
                <h4>Pilih material yang hanya dibutuhkan untuk produk</h4>
                <div class="bg-danger" style="padding: 5px;">
                    <p style="color: red; font-weight: bold;">NB. Form dibawah tidak harus diisi semua</p>
                    <p style="color: red; font-weight: bold;">Kode Material tidak boleh sama</p>
                </div>
                <br>
                @foreach ($data['bom_produk'] as $row3)
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Kode Material</label>
                            <input type="text" name="material[]" class="form-control" placeholder="Masukkan Kode Material" value="{{ $row3['kode_bk'] }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kebutuhan Material</label>
                            <input type="text" class="form-control" placeholder="Contoh : 250 atau 0.2" name="keb[]" value="{{ $row3['kebutuhan'] }}" required>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-edit"></i> Edit</button>
            </div>
            <div class="col-md-6">
                <a href="{{ url('produk-index') }}" class="btn btn-danger btn-block">Cancel</a>
            </div>
        </div>

        <br>
    </form>

</div>
<br>
<br>
<br>
<br>


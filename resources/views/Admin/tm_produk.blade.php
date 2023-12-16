<!-- resources/views/create_produk.blade.php -->

@include('admin/header')

<div class="container">
    <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Produk</b></h2>

    <form action="{{ route('produk-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputFile">Pilih Gambar </label>
            <input type="file" id="exampleInputFile" name="files">
            <p class="help-block">Pilih Gambar untuk Produk</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Produk</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="{{ $format }}">
                    <input type="hidden" name="kode" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk"  value="{{ $format }}">
                </div>
            </div>
        </div>

        
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Produk</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" name="nama">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="number" class="form-control" id="exampleInputEmail1" placeholder="Contoh : 12000" name="harga">
					<p class="help-block">Isi Harga tanpa menggunakan Titik(.) atau Koma (,)</p>
				</div>
			</div>
		</div>

        <div class="form-group">
            <label for="exampleInputPassword1">Deskripsi</label>
            <textarea name="desk" class="form-control" rows="4"></textarea>
        </div>

        <hr>

        <h3 style="width: 100%; border-bottom: 4px solid gray">BOM Produk</h3>

        <div class="row">
            <div class="col-md-6">
                <h4>Daftar Material yang ada di Gudang/Inventory</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Material</th>
                            <th scope="col">Nama Material</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $material->kode_bk }}</td>
                            <td>{{ $material->nama }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h4>Pilih material yang hanya dibutuhkan untuk produk</h4>
                <div class="bg-danger" style="padding: 5px;">
                    <p style="color: red; font-weight: bold;">NB. Form dibawah tidak harus diisi semua</p>
                    <p style="color: red; font-weight: bold;">Kode Material tidak boleh sama</p>
                </div>
                <br>

                @for($i = 1; $i <= $jml; $i++)
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputPassword1">Kode Material</label>
                <input type="text" name="material[]" class="form-control" placeholder="Masukkan Kode Material">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Kebutuhan Material</label>
                <input type="text" class="form-control" placeholder="Contoh: 250 atau 0.2" name="keb[]">
            </div>
        </div>
    </div>
@endfor
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-plus-sign"></i> Tambah</button>
            </div>
            <div class="col-md-6">
                <a href="{{ route('produk-index') }}" class="btn btn-danger btn-block">Cancel</a>
            </div>
        </div>
    </form>
</div>
<br>
<br>
<br>
<br>
<br>

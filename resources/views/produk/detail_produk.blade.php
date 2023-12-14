@include ('header')

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Detail produk</b></h2>

    <div class="row">
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="image/produk/{{ $produk->image }}" width="400">
            </div>
        </div>

        <div class="col-md-8">
            <form action="{{ route('keranjang.tambah', ['produk' => $produk->kode_produk, 'kd_cs' => session('kd_cs'), 'hal' => 2]) }}" method="GET">
                <input type="hidden" name="kd_cs" value="{{ $kode_cs }}">
                <input type="hidden" name="produk" value="{{ $produk->kode_produk }}">
                <input type="hidden" name="hal" value="2">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><b>Nama</b></td>
                            <td>{{ $produk->nama }}</td>
                        </tr>
                        <tr>
                            <td><b>Harga</b></td>
                            <td>Rp.{{ number_format($produk->harga) }}</td>
                        </tr>
                        <tr>
                            <td><b>Deskripsi</b></td>
                            <td>{{ $produk->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah</b></td>
                            <td><input class="form-control" type="number" min="1" name="jml" value="1" style="width: 155px;"></td>
                        </tr>
                    </tbody>
                </table>
                @if(session('user'))
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang</button>
                @else
                    <a href="{{ route('keranjang.index') }}" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang</a>
                @endif
                <a href="{{ route('produk.index') }}" class="btn btn-warning"> Kembali Belanja</a>
            </form>
        </div>
    </div>
</div>

@include ('footer')

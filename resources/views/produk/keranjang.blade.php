@include('layout/header')

<div class="container" style="padding-bottom: 300px;">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Keranjang</b></h2>

    @if(session('user'))
        @php
            $kode_cs = session('kd_cs');
            $cek = \DB::table('keranjang')->where('kode_customer', $kode_cs)->count();
        @endphp

        @if($cek > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $result = \DB::table('keranjang')
                            ->join('produk', 'keranjang.kode_produk', '=', 'produk.kode_produk')
                            ->select('keranjang.id_keranjang as keranjang', 'keranjang.kode_produk as kd', 'keranjang.nama_produk as nama', 'keranjang.qty as jml', 'produk.image as gambar', 'produk.harga as hrg')
                            ->where('kode_customer', $kode_cs)
                            ->get();

                        $no = 1;
                        $hasil = 0;
                    @endphp

                        <form action="{{ route('keranjang-update') }}" method="POST">
                        @csrf
                        @method('POST')
                        @foreach($result as $row)
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td><img src="{{ asset('Image/produk/' . $row->gambar) }}" width="100"></td>
                                <td>{{ $row->nama }}</td>
                                <td>Rp.{{ number_format($row->hrg) }}</td>
                                <td><input type="number" name="qty[{{ $row->keranjang }}]" class="form-control" style="text-align: center;" value="{{ $row->jml }}"></td>
                                <td>Rp.{{ number_format($row->hrg * $row->jml) }}</td>
                                <td>
                                    <button type="submit" name="submit1" class="btn btn-warning">Update</button> |
                                    <form action="{{ route('keranjang-delete', ['id_keranjang' => $row->keranjang]) }}" method="post" onsubmit="return confirm('Yakin ingin dihapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $sub = $row->hrg * $row->jml;
                                $hasil += $sub;
                                $no++;
                            @endphp
                        @endforeach
                    </form>

                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: bold;">Grand Total = Rp.{{ number_format($hasil) }}</td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: bold;">
                            <a href="{{ url('home') }}" class="btn btn-success">Lanjutkan Belanja</a>
                            <a href="{{ url('checkout') }}?kode_cs={{ $kode_cs }}" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center bg-warning">
                            <h5><b>KERANJANG BELANJA ANDA KOSONG</b></h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Qty</th>
                    <th scope="col">SubTotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="text-center bg-danger">
                        <h5><b>SILAHKAN LOGIN TERLEBIH DAHULU SEBELUM BERBELANJA</b></h5>
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
</div>

@include('layout/footer')

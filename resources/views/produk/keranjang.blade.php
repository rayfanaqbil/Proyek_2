<!-- resources/views/keranjang/index.blade.php -->

@include('layout/header')


<div class="container" style="padding-bottom: 300px;">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Keranjang</b></h2>
    <table class="table table-striped">
        @if(count($keranjangItems) > 0)
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
            @php $no = 1; $grandTotal = 0; @endphp
            @foreach($keranjangItems as $item)
            <form action="{{ route('tambah-keranjang') }}" method="post">
                @csrf
                @method('put')
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td><img src="{{ asset('Image/produk/' . $item->produk->image) }}" width="100"></td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td>Rp.{{ number_format($item->produk->harga) }}</td>
                    <td><input type="number" name="qty" class="form-control" style="text-align: center;" value="{{ $item->qty }}"></td>
                    <td>Rp.{{ number_format($item->produk->harga * $item->qty) }}</td>
                    <td>
                        <button type="submit">Tambah ke Keranjang</button> | 
                        <a href="{{ route('keranjang.delete', $item->id_keranjang) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus ?')">Delete</a>
                    </td>
                </tr>
            </form>
            @php $grandTotal += $item->produk->harga * $item->qty; @endphp
            @endforeach
        </tbody>
        <tr>
            <td colspan="7" style="text-align: right; font-weight: bold;">Grand Total = Rp.{{ number_format($grandTotal) }}</td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: right; font-weight: bold;">
                <a href="{{ route('index') }}" class="btn btn-success">Lanjutkan Belanja</a> 
                <a href="{{ route('checkout', ['kode_cs' => auth()->guard('customer')->user()->kode_customer]) }}" class="btn btn-primary">Checkout</a>
            </td>
        </tr>
        @else
        <tr>
            <th scope='col'>No</th>
            <th scope='col'>Image</th>
            <th scope='col'>Nama</th>
            <th scope='col'>Harga</th>
            <th scope='col'>Qty</th>
            <th scope='col'>SubTotal</th>
            <th scope='col'>Action</th>
        </tr>
        <tr>
            <td colspan='7' class='text-center bg-warning'><h5><b>KERANJANG BELANJA ANDA KOSONG </b></h5></td>
        </tr>
        @endif
    </table>
</div>


@include('footer')
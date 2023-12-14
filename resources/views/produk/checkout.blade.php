<!-- resources/views/checkout.blade.php -->

@extends('layout.header')

<div class="container" style="padding-bottom: 200px">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Daftar Pesanan</h4>
            <table class="table table-stripped">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                </tr>
                @php $no = 1; $grandTotal = 0; @endphp
                @forelse($keranjangItems as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>Rp.{{ number_format($item->harga) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp.{{ number_format($item->harga * $item->qty) }}</td>
                    </tr>
                    @php $grandTotal += $item->harga * $item->qty; @endphp
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada pesanan.</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = Rp.{{ number_format($grandTotal) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 bg-success">
            <h5>Pastikan Pesanan Anda Sudah Benar</h5>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 bg-warning">
            <h5>Isi Form di Bawah Ini</h5>
        </div>
    </div>
    <br>
    <form action="{{ route('checkout-process') }}" method="POST">
        @csrf
        <input type="hidden" name="kode_cs" value="{{ $kd }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" style="width: 557px;" value="{{ $rows['nama'] }}" readonly>
        </div>
        <!-- ... (form input lainnya) ... -->
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
        <a href="{{ route('keranjang') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>

@include('layout.footer')

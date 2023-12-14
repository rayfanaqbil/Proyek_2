@include ('layout/header')

<div class="container">    
    <h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Produk Kami</b></h2>

    <div class="row">
        @foreach($produk as $row)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="image/produk/{{ $row->image }}" >
                    <div class="caption">
                        <h3>{{ $row->nama }}</h3>
                        <h4>Rp.{{ number_format($row->harga) }}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('produkdetail', ['produk' => $row->kode_produk]) }}" class="btn btn-warning btn-block">Detail</a>
                            </div>
                            @if(session('kd_cs'))
                                <div class="col-md-6">
                                    <a href="{{ route('keranjang.tambah', ['produk' => $row->kode_produk, 'kd_cs' => session('kd_cs'), 'hal' => 1]) }}" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <a href="{{ route('keranjang.index') }}" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

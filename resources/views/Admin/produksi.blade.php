@extends('admin/header')

    <div class="container">
        <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
        <br>
        <h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;">
            <marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee>
        </h5>
        <a href="{{ route('produksi-index') }}" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Kode Customer</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produksis as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->invoice }}</td>
                        <td>{{ $row->kode_customer }}</td>
                        @if ($row->terima == 1)
                            <td style="color: green;font-weight: bold;">Pesanan Diterima (Siap Kirim)</td>
                        @elseif ($row->tolak == 1)
                            <td style="color: red;font-weight: bold;">Pesanan Ditolak</td>
                        @elseif ($row->terima == 0 && $row->tolak == 0)
                            <td style="color: orange;font-weight: bold;">{{ $row->status }}</td>
                        @endif
                        <td>2020/26-01</td>
                        <td>
                            @if ($row->tolak == 0 && $row->cek == 1 && $row->terima == 0)
                                <a href="{{ route('inventory.request', ['cek' => 0]) }}" id="rq" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-warning-sign"></i> Request Material Shortage
                                </a>
                                <a href="{{ route('proses.tolak', ['inv' => $row->invoice]) }}" class="btn btn-danger"
                                    onclick="return confirm('Yakin Ingin Menolak ?')">
                                    <i class="glyphicon glyphicon-remove-sign"></i> Tolak
                                </a>
                            @elseif ($row->terima == 0 && $row->cek == 0)
                                <a href="{{ route('proses.terima', ['inv' => $row->invoice, 'kdp' => $row->kode_produk]) }}"
                                    class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Terima</a>
                                <a href="{{ route('proses.tolak', ['inv' => $row->invoice]) }}" class="btn btn-danger"
                                    onclick="return confirm('Yakin Ingin Menolak ?')">
                                    <i class="glyphicon glyphicon-remove-sign"></i> Tolak
                                </a>
                            @endif
                            <a href="{{ route('detailorder', ['inv' => $row->invoice, 'cs' => $row->kode_customer]) }}"
                                type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detail
                                Pesanan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($cek_sor > 0)
            <br>
            <br>
            <div class="row">
                <div class="col-md-4 bg-danger" style="padding:10px;">
                    <h4>Kekurangan Material </h4>
                    <h5 style="color: red;font-weight: bold;">Silahkan Tambah Stok Material dibawah ini : </h5>
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Material</th>
                        </tr>
                        @foreach ($nama_material as $index => $material)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $material }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endif

    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

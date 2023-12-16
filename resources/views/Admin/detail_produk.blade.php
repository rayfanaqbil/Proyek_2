<!-- resources/views/production/index.blade.php -->

@include('admin/header')


<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
    <br>
    <!-- Sisipkan konten HTML yang lain sesuai kebutuhan -->
    <!-- Gunakan sintaks Blade untuk menampilkan data dinamis -->
    <h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;">
        <marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee>
    </h5>
    <a href="{{ route('produksi-index') }}" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Kode Customer</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->invoice }}</td>
                <td>{{ $row->kode_customer }}</td>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                <td>
                    <!-- Tampilkan tombol-tombol atau link sesuai kebutuhan -->
                    <a href="{{ route('detail-order', ['inv' => $row->invoice]) }}" class="btn btn-primary">
                        <i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tambahkan modal dan konten lainnya sesuai kebutuhan -->

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

<!-- Tambahkan skrip JavaScript sesuai kebutuhan -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#btn").click();
    });
</script>

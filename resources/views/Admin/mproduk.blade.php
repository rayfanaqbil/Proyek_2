@include('admin/header')

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Master Produk</b></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Image</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['kode_produk'] }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td><img src="{{ asset('Image/produk/'.$row['image']) }}" width="100"></td>
                    <td>Rp.{{ number_format($row['harga']) }}</td>
                    <td>
                        <a href="{{ route('produk-edit', ['kode' => $row['kode_produk']]) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="{{ route('produk-delete', ['kode' => $row['kode_produk']]) }}" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <a href="{{ route('produk-bom', ['kode' => $row['kode_produk']]) }}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i> Lihat BOM
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('produk-create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Tambah Produk
    </a>
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

@include('admin/header')

    <div class="container">
        <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Inventory Material</b></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Matrial</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory as $row)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $row->kode_bk }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ $row->satuan }}</td>
                        <td>{{ number_format($row->harga) . '/' . $row->satuan }}</td>
                        <td>
                            <a href="{{ route('inventory-edit', ['kode' => $row->kode_bk]) }}"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> </a>
                            <form action="{{ route('inventory-destroy', ['kode' => $row->kode_bk]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="fa-solid fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('inventory-create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Tambah Material</a>
    </div>
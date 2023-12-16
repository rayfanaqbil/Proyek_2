@include('admin/header')

<div class="container">
    @isset($produk)
        <h2 style="width: 100%; border-bottom: 4px solid gray"><b>BOM PRODUK {{ strtoupper($produk[0]->nama) }}</b></h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Material</th>
                    <th>Kebutuhan Material</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bom_produk as $key => $bom)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $bom->nama }}</td>
                        <td>{{ $bom->jml }} {{ $bom->satu }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Produk tidak ditemukan.</p>
    @endisset
</div>

<!-- resources/views/admin/customer/index.blade.php -->

@include('admin/header')

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Data Customer</b></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Customer</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $customer->kode_customer }}</td>
                    <td>{{ $customer->nama }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <a href="{{ route('customer-destroy', ['kode' => $customer->kode_customer]) }}" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
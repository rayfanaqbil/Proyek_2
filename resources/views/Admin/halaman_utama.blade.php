@include('admin/header')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
                <h4>PESANAN BARU</h4>
                <h4 style="font-size: 56pt;"><b>{{ $jml1 }}</b></h4>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
                <h4>PESANAN DIBATALKAN</h4>
                <h4 style="font-size: 56pt;"><b>{{ $jml2 }}</b></h4>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
                <h4>PESANAN DITERIMA</h4>
                <h4 style="font-size: 56pt;"><b>{{ $jml3 }}</b></h4>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<!-- Add any additional content as needed -->
<br>
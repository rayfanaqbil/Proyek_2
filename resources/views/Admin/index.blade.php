<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rafy Backery</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <script type="text/javascript">
        alert('SEKEDAR MEMBERI INFORMASI KEPADA PAK BAMABANG UNTUK LOGIN ADMIN \n \n Username = admin \n Password = admin');
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#target").click();
        });
    </script>

    <input type="hidden" class="btn btn-primary" id="target" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">LOGIN ADMIN</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('login-admin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username" autofocus autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
    body{

    margin:0;
    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    font-family:Arial, Helvetica, sans-serif;

    background:
    linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
    url("sekolah.jpg");
    
    background-size:cover;
    background-position:center;

    }

    .login-box{

        width:360px;
        background:#24262f;
        padding:35px;
        border-radius:35px;

    }

    .login-box h1{
        color:white;
        text-align:center;
        margin-top:0px;
        margin-bottom:25px;
        font-size:42px;
        font-weight:bold;

    }

    .form-control{
        background:#3a3d4a;
        border:1px solid #555;
        color:white;
        padding: 10px;
        margin-bottom:15px;
        width: 93%;
        height:48px;
        border-radius: 15px;

    }

    .form-control::placeholder{
        color:#bcbcbc;
    }

    .btn-login{
        width:100%;
        height:48px;
        border-radius: 15px;
        border:1px solid white;
        background:transparent;
        color:white;
        font-weight:bold;

    }

    .btn-login:hover{
        background:white;
        color:black;
    }

    hr{
        border:1px solid #444;
        margin:25px 0;
    }

    p{
        color:white;
        text-align:center;
    }

    a{
        color:white;
        text-decoration:none;
        font-weight:bold;
    }

    a:hover{
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <div class="login-box">

    <h1>Masuk Akun</h1>

    <form action="masuk.php" method="POST">

        <input
            type="text"
            name="username"
            class="form-control"
            placeholder="Username/Email/Phone"
            required>
        <br>
        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"
            required>

        <button class="btn btn-login" type="submit">
            Log In
        </button>

    </form>

    <hr>

    <p>
        Gak punya akun?
        <a href="daftar.php">Daftar</a>
    </p>

</div>
</body>
</html>
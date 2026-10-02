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
    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    font-family:Arial, Helvetica, sans-serif;

    background:
    linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
    url("sekolah.jpg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

}

.login-box{

    width:420px;
    background:#24262f;
    padding:35px;
    border-radius:12px;

}

.login-box h2{

    color:white;
    text-align:center;
    margin:0 0 25px;
    font-size:34px;
    font-weight:bold;

}

label{

    color:white;
    display:block;
    font-size:14px;
    margin-bottom:8px;
    margin-top:15px;

}

.form-control{

    width:100%;
    height:48px;

    background:#3a3d4a;
    border:1px solid #555;

    color:white;

    padding:10px;

    border-radius:8px;

    box-sizing:border-box;

    margin-bottom:15px;

    font-size:15px;

}

.form-control::placeholder{

    color:#bcbcbc;

}

.birthday{

    display:flex;
    gap:10px;
    margin-bottom:15px;

}

.birthday .form-control{

    flex:1;
    margin-bottom:0;

}

.gender{

    display:flex;
    gap:10px;
    margin-top:10px;
    margin-bottom:25px;

}

.gender label{

    flex:1;

    border:1px solid #666;

    border-radius:8px;

    text-align:center;

    padding:12px;

    cursor:pointer;

    background:#2f313b;

    margin:0;

}

.gender input{

    margin-right:5px;

}

.btn-login{

    width:100%;
    height:50px;

    border:none;

    border-radius:8px;

    background:#b7b7b7;

    color:#222;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    transition:.3s;

}

.btn-login:hover{

    background:white;

}

hr{

    border:1px solid #444;

    margin:25px 0;

}

p{

    color:white;
    text-align:center;
    font-size:15px;

}

a{

    color:white;
    text-decoration:none;
    font-weight:bold;

}

a:hover{

    text-decoration:underline;

}
    </style>
</head>
<body>

<div class="login-box">

    <h2>Daftar akun!</h2>

    <form action="register.php" method="POST">

        <label>Birthday</label>

        <div class="birthday">
            <select class="form-control" name="month">
                <option>Month</option>
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>

            <select class="form-control" name="day">
                <option>Day</option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option><?= $i ?></option>
                <?php } ?>
            </select>

            <select class="form-control" name="year">
                <option>Year</option>
                <?php for($i=date("Y");$i>=1950;$i--){ ?>
                    <option><?= $i ?></option>
                <?php } ?>
            </select>
        </div>

        <label>Username</label>

        <input
            type="text"
            name="username"
            class="form-control"
            placeholder="Don't use your real name"
            required>

        <label>Password</label>

        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="At least 8 characters"
            required>

        <label>Gender (Optional)</label>

        <div class="gender">

            <label>
                <input type="radio" name="gender" value="Laki-laki">
                👨 Male
            </label>

            <label>
                <input type="radio" name="gender" value="Perempuan">
                👩 Female
            </label>

        </div>

        <button class="btn-login">
            Sign Up
        </button>

    </form>

    <hr>

    <p>
        Sudah punya akun?
        <a href="index.php">Masuk</a>
    </p>

</div>

</body>
</html>
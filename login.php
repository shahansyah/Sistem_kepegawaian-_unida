<?php
session_start();
if (isset($_POST['login'])) {
    if ($_POST['username'] == "adminunida" && $_POST['password'] == "unida2026") {
        $_SESSION['login'] = true;
        header("Location: home.php");
        exit;
    } else {
        $error = "Username atau Password Salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | UNIDA Gontor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Mengambil foto unida.jpg sebagai background full layar */
            background: linear-gradient(rgba(2, 47, 88, 0.7), rgba(1, 19, 38, 0.7)), 
                        url('asset/unida.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo-unida {
            width: 100px;
            margin-bottom: 20px;
        }
        .btn-unida {
            background-color: #003366;
            color: white;
            font-weight: bold;
        }
        .btn-unida:hover { background-color: #002244; color: white; }
    </style>
</head>
<body>

<div class="login-card">

    <img src="asset/logo-unida-fyd-gontor-indonesia.webp" alt="Logo UNIDA" class="logo-unida">
    <h4 class="fw-bold mb-1">Selamat Datang</h4>
    <p class="text-muted mb-4">Laman Admin UNIDA Gontor</p>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2" style="font-size: 14px;"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3 text-start">
            <label class="form-label small">Username</label>
            <input type="text" name="username" class="form-control" placeholder="adminunida" required>
        </div>
        <div class="mb-4 text-start">
            <label class="form-label small">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" name="login" class="btn btn-unida w-100 py-2">MASUK</button>
    </form>
    
    
</div>

</body>
</html>
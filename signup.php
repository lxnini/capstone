<?php
include 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM staff WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        $error = "Email already exists. Please use another email.";
    } else {
        $stmt = $conn->prepare("INSERT INTO staff (name,email,password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();

        header("Location: index.php");
        exit;
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            background: linear-gradient(to bottom, #f5f1e6, #e8dcc7);
            color: #4b2e2e;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 80px auto;
        }

        .card {
            background: #fffaf0;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        h2 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #8b5e3c;
            border-radius: 6px;
            margin-bottom: 12px;
            background: #fffaf0;
        }

        input:focus {
            outline: none;
            border-color: #a0522d;
            box-shadow: 0 0 5px rgba(160,82,45,0.5);
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        button {
            flex: 1;
            padding: 10px;
            background: linear-gradient(to right, #8b5e3c, #6b3e26);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.05);
            background: linear-gradient(to right, #a0522d, #7b4a2f);
        }

        .login-btn {
            flex: 1;
            display: inline-block;
            text-align: center;
            padding: 10px;
            background: #a0522d;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #7b4a2f;
            transform: scale(1.05);
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Sign Up</h2>

        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            Name:
            <input type="text" name="name" required>

            Email:
            <input type="email" name="email" required>

            Password:
            <input type="password" name="password" required>

            <div class="btn-group">
                <button type="submit">Sign Up</button>
                <a href="index.php" class="login-btn">Login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
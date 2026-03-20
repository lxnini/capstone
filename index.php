<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM staff WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['staff_id'] = $user['id'];
        $_SESSION['staff_name'] = $user['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials! Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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

        .signup-btn {
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

        .signup-btn:hover {
            background: #7b4a2f;
            transform: scale(1.05);
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Login</h2>

        <?php if($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            Email:
            <input type="email" name="email" required>

            Password:
            <input type="password" name="password" required>

            <div class="btn-group">
                <button type="submit">Login</button>
                <a href="signup.php" class="signup-btn">Sign Up</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
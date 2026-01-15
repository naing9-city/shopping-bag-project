<?php
session_start();
error_reporting(0);
include("include/config.php");
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' and password='$password'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $extra = "dashboard.php";
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        header("location:dashboard.php");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
        header("location:index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherry Store | Admin Login</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- FontAwesome -->
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">

    <style>
        /* ================== PREMIUM DARK LOGIN ================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f5;
            /* Light Grey */
            /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); Optional Soft Gradient */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: #333;
            /* Dark text for light mode */
        }

        /* Ambient Background Elements - Subtle for light mode */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
            animation: rotate 60s linear infinite;
            z-index: -1;
        }

        /* Login Card - Light Glass */
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            /* Softer shadow */
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
            z-index: 10;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        /* Card Hover Glow */
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            border-color: #fff;
        }

        /* Logo Area */
        .logo-section {
            margin-bottom: 30px;
        }

        .logo-section img {
            height: 50px;
            margin-bottom: 15px;
            /* Filter removed to show original colors */
            transition: transform 0.3s;
        }

        .logo-section img:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            /* Dark Title */
            letter-spacing: 1px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .login-subtitle {
            font-size: 13px;
            color: #777;
            font-weight: 500;
        }

        /* Form Controls */
        .input-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #fcb045;
            /* Cherry Gold/Orange Accent */
            font-size: 16px;
            z-index: 2;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .form-control {
            width: 100%;
            background: #f8f9fa;
            /* Light Input bg */
            border: 1px solid #e1e4e8;
            border-radius: 10px;
            padding: 15px 15px 15px 45px;
            /* Space for icon */
            color: #333;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
            position: relative;
            z-index: 1;
        }

        /* Input Hover Effect */
        .form-control:hover {
            background: #fff;
            border-color: #bbb;
            transform: translateY(-1px);
        }

        .form-control:focus {
            background: #fff;
            border-color: #fcb045;
            box-shadow: 0 5px 20px rgba(252, 176, 69, 0.15);
            transform: translateY(-2px);
        }

        .form-control:focus+i {
            color: #fd1d1d;
            transform: translateY(-50%) scale(1.2);
            /* Pop icon */
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 14px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(to right, #fcb045, #fd1d1d, #833ab4);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-top: 10px;
            position: relative;
            z-index: 5;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(253, 29, 29, 0.3);
        }

        /* Wave Effect */
        .wave-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .wave-svg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            /* For animation */
            height: 100%;
            animation: waveMove 10s linear infinite;
        }

        @keyframes waveMove {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .error-message {
            color: #ff4d4d;
            font-size: 13px;
            margin-bottom: 20px;
            display: block;
            background: rgba(255, 77, 77, 0.1);
            padding: 10px;
            border-radius: 8px;
        }

        /* Back Link */
        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: #8898aa;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
            z-index: 10;
        }

        .back-link:hover {
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="logo-section">
            <img src="../assets/images/logo.svg" alt="Cherry Store">
            <div class="login-title">Admin Panel</div>
            <div class="login-subtitle">Control panel login</div>
        </div>

        <?php if (isset($_SESSION['errmsg']) && $_SESSION['errmsg'] != "") { ?>
            <div class="error-message">
                <?php echo htmlentities($_SESSION['errmsg']); ?>     <?php echo htmlentities($_SESSION['errmsg'] = ""); ?>
            </div>
        <?php } ?>

        <form method="post">
            <div class="input-group">
                <i class="icon-user"></i>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="input-group">
                <i class="icon-key"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" name="submit" class="btn-login">Login</button>
        </form>

        <a href="../index.php" class="back-link">
            <i class="icon-arrow-left"></i> Back to Portal
        </a>

        <!-- Wave Effect -->
        <div class="wave-container">
            <svg class="wave-svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="rgba(255, 255, 255, 0.05)" fill-opacity="1"
                    d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
                <path fill="url(#grad1)" fill-opacity="0.2"
                    d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,224C672,213,768,171,864,149.3C960,128,1056,128,1152,149.3C1248,171,1344,213,1392,234.7L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#fcb045;stop-opacity:1" />
                        <stop offset="50%" style="stop-color:#fd1d1d;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#833ab4;stop-opacity:1" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>

    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>
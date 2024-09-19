<?php
session_start();

require_once('functions.php');

$error_message = '';
$success_message = '';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        $db = db_connect();

        $sql = "SELECT * FROM admins WHERE name = :name";
        $req = $db->prepare($sql);
        $req->bindParam(':name', $username);
        $req->execute();
        
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if ($user && $password === $user['password']) {
            // Stockez les données correctes dans la session
            $_SESSION["name"] = $user['name'];
            $_SESSION["email"] = $user['email'];
            $_SESSION["token"] = $user['token'];
            $_SESSION["role"] = $user['role'];
            header("Location: home.php");
            exit();
        } else {
            $error_message = "Nom d'utilisateur ou mot de passe incorrect";
        }
    } else {
        $error_message = "Veuillez entrer un nom d'utilisateur et un mot de passe";
    }
}

if (isset($_POST["register"])) {
    $new_username = $_POST["new_username"];
    $new_email = $_POST["new_email"];
    $new_password = $_POST["new_password"];
    
    if (!empty($new_username) && !empty($new_email) && !empty($new_password)) {
        $db = db_connect();
        $token = bin2hex(random_bytes(16));
        $role = 'admin'; // ou 'user' selon vos besoins

        $sql = "INSERT INTO admins (name, email, password, role, token) VALUES (:name, :email, :password, :role, :token)";
        $req = $db->prepare($sql);
        $req->bindParam(':name', $new_username);
        $req->bindParam(':email', $new_email);
        $req->bindParam(':password', $new_password); // Idéalement, vous devriez hacher le mot de passe
        $req->bindParam(':role', $role);
        $req->bindParam(':token', $token);

        if ($req->execute()) {
            $success_message = "Nouvel utilisateur créé avec succès. Vous pouvez maintenant vous connecter.";
        } else {
            $error_message = "Erreur lors de la création de l'utilisateur";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs pour l'inscription";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background: linear-gradient(45deg, #1a0000, #330000);
        color: #fff;
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        height: 95vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1, h3 {
        text-align: center;
        color: #ff4d4d;
        text-shadow: 0 0 10px #800000;
        font-size: 2em;
        margin-bottom: 30px;
    }

    .login-card {
        background: rgba(51, 0, 0, 0.7);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        max-width: 400px;
        margin: 0 auto;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(255, 77, 77, 0.8);
    }

    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-header {
        background: linear-gradient(45deg, #800000, #ff4d4d);
        color: #fff;
        padding: 15px;
    }

    .card-body {
        padding: 20px;
    }

    .form-label {
        color: #ff9999;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
        padding: 10px;
        margin-bottom: 15px;
    }

    .btn {
        background: linear-gradient(45deg, #800000, #ff4d4d);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        text-transform: uppercase;
        font-weight: bold;
        transition: all 0.3s ease;
        display: inline-block;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn:hover {
        background: linear-gradient(45deg, #ff4d4d, #800000);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 77, 77, 0.8);
    }

    .alert {
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.8);
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.8);
    }

    .modal-content {
        background: rgba(51, 0, 0, 0.9);
        color: #fff;
        border-radius: 15px;
    }

    .modal-header {
        border-bottom: 1px solid #ff4d4d;
    }

    .modal-title {
        color: #ff4d4d;
    }

    .flame-effect {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        background: 
            radial-gradient(ellipse at top, rgba(255, 77, 77, 0.3), transparent 70%),
            radial-gradient(ellipse at bottom, rgba(128, 0, 0, 0.3), transparent 70%);
        animation: flicker 5s infinite alternate;
    }

    @keyframes flicker {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
</style>

<div class="flame-effect"></div>

<div class="container mt-5">
    <div class="login-card">
        <img src="diable.png" class="card-img-top" alt="Image de connexion">
        
        <div class="card-header">
            <h3>Connexion</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <form action="index.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn">Connexion</button>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Créer un nouvel utilisateur
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour l'inscription -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Créer un nouvel utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="new_username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="new_username" name="new_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="new_email" name="new_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <button type="submit" name="register" class="btn">Créer l'utilisateur</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
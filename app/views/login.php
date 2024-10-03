<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-5">Iniciar Sesión</h2>

    <form class="mt-3">
        <div class="form-group">
            <label for="username"><i class="fas fa-user"></i> Usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
    </form>
</div>
</body>
</html>
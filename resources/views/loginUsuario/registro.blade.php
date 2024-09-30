<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login</title>

    <style>
        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .input-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .input-group input:focus {
            border-color: #66afe9;
            outline: none;
        }

        .input-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .input-row .input-group {
            flex: 1;
        }

        .btn-register {
            width: 50%;
            padding: 0.7rem;
            background-color: #c90000;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            
        }

        .btn-register:hover {
            background-color: #810808;
        }

        @media (max-width: 768px){
        .input-row {
            display: block;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .input-row .input-group {
            flex: 1;
        }   
        }
    </style>
</head>
<body>
<div class="container-fluid d-flex flex-column justify-content-center align-items-center min-vh-100">
    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-login">
    </div>
    <div class="card p-4 shadow-lg login-card registrar">
        <h2 class="text-center mb-4">Heladeria Sarita Plaza Quetzal</h2>
        <label class="form-label text-center">Registro de Usuario</label>
        
        <form method="POST" action="{{ route('registro') }}">
            @csrf
                <div class="input-row">
                    <div class="input-group">
                        <label for="nombres" class="form-label">Nombres:</label>
                        <input type="text" name="nombres" id="nombres" placeholder="Ingresa tus nombres" required>
                    </div>

                    <div class="input-group">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Ingresa tus apellidos" required>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono" placeholder="Ingresa tu teléfono" required>
                    </div>

                    <div class="input-group">
                        <label for="telefono2" class="form-label">Teléfono 2 (opcional):</label>
                        <input type="tel" name="telefono2" id="telefono2" placeholder="Ingresa tu segundo teléfono">
                    </div>
                </div>

                <div class="input-group">
                    <label for="correo" class="form-label">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo" placeholder="Ingresa tu correo" required>
                </div>

                <div class="input-group">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Ingresa tu dirección" required>
                </div>

                <div class="input-group">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required>
                </div>

                <div class="input-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirma tu contraseña" required>
                </div>

                <center><button type="submit" class="btn-register">Registrar</button></center>
        </form>
        <div class="mt-3 text-center">
            <a href="{{ route('login')}}" class="text-light">¿Estoy Registrado?</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
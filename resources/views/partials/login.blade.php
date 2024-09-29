<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid d-flex flex-column justify-content-center align-items-center min-vh-100">
    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-login">
    </div>
    <div class="card p-4 shadow-lg login-card">
        <h2 class="text-center mb-4">Heladeria Sarita Plaza Quetzal</h2>
        <label class="form-label text-center">Inicio de Sesión</label>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="usuario" id="usuario" class="form-control" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                <a href="" class="btn btn-outline-light">Registrarse</a>
            </div>
        </form>
        <div class="mt-3 text-center">
            <a href="#" class="text-light">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
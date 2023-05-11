<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'?>

    <a href="/perfil" class="enlace">Volver Perfil</a>
    <form method="POST" class="formularios" action="/cambiar-password">
        <div class="campo">
            <label for="password">Password Actual</label>
            <input 
                type="password"
                id="password"
                name="passwordActual"
                placeholder="Tu Password Actual"
            >
        </div>
        <div class="campo">
            <label for="password">Password Nueva</label>
            <input 
                type="password"
                id="password"
                name="passwordNueva"
                placeholder="Tu Password Nueva"
            >
        </div>

        <input type="submit" class="boton" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
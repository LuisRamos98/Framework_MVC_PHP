<div class="contenedor restablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu acceso a UpTask</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        <?php if($mostrar): ?>
                <form method='POST' class="formularios">
                    <div class="campo">
                        <label for="password">Password:</label>
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Tu Password"
                        >
                    </div>
                    <input type="submit" class="boton" value="Guarda tu Password">
                </form>
        <?php endif; ?>
        <div class="acciones">
            <a href="/">Recordaste tu contraseña. Inicia Sesión</a>
            <a href="/crear">¿Aún no tienes una cuenta? Obtener una</a>
        </div>
    </div>
</div>
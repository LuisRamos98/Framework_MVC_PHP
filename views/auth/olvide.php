<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu acceso a UpTask</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        <form action="/olvide" method='POST' class="formularios">
            <div class="campo">
                <label for="email">Email:</label>
                <input 
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Tu Email"
                >
            </div>
            <input type="submit" class="boton" value="Resetea Contraseña">
        </form>
        <div class="acciones">
            <a href="/">Recordaste tu contraseña. Inicia Sesión</a>
            <a href="/crear">¿Aún no tienes una cuenta? Obtener una</a>
        </div>
    </div>
</div>
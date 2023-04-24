<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>
        <form class="formularios" action="/">
        <div class="campo">
                <label for="nombre">Nombre:</label>
                <input 
                    type="text"
                    id="nombre"
                    name="nombre"
                    placeholder="Tu Nombre"
                >
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input 
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Tu Email"
                >
            </div>
            <div class="campo">
                <label for="password">Password:</label>
                <input 
                    type="text"
                    id="password"
                    name="password"
                    placeholder="Tu Password"
                >
            </div>
            <div class="campo">
                <label for="password2">Confirma tu Password:</label>
                <input 
                    type="text"
                    id="password2"
                    name="password2"
                    placeholder="Confirma tu Password"
                >
            </div>
            <input type="submit" class="boton" value="Crear Cuenta">

            <div class="acciones">
                <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
                <a href="/olvide">Olvidaste tu password</a>
            </div>
        </form>
    </div> <!-- contenedor-sm -->
</div>
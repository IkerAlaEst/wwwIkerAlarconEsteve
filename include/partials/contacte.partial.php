<main class="contenidor-principal">
    <div class="contenidor-secundari">
        <div class="contenidor-titol">
            <h2>Contacte</h2>
        </div>
        <form action="include/processaContacte.php" method="post">
            <div class="contenidor-secundari">
                <label>Correu Electrònic: </label><input class="campo-formulario" type="email" required name="correuElectronic">
            </div>
            <div class="contenidor-secundari">
                <label>Assumpte: </label><input class="campo-formulario" type="text" required name="assumpte">
            </div>
            <div class="contenidor-secundari">
                <label>Missatge: </label><textarea class="campo-formulario" required name="missatge"></textarea>
            </div>
            <div class="contenidor-secundari">
                <input class="button" type="submit" value="Envia">
                <input class="button" type="reset" value="Reset">
            </div>
        </form>
    </div>
</main>
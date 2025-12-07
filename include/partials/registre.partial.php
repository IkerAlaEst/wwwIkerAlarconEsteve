<main class="contenidor-principal">
    <div class="contenidor-secundari">
        <div class="contenidor-titol">
            <h2>Registre</h2>
        </div>
        <form action="include/processaRegistre.php" method="post">
            <div class="contenidor-secundari">
                <label>Nom: </label><input class="campo-formulario" type="text" required name="nom">
            </div>
            <div class="contenidor-secundari">
                <label>Cognom: </label><input class="campo-formulario" type="text" name="cognoms">
            </div>
            <div class="contenidor-secundari">
                <label>Adreça: </label><input class="campo-formulario" type="text" name="adreça">
            </div>
            <div class="contenidor-secundari">
                <label>Correu Electrònic: </label><input class="campo-formulario" type="email" required name="correuElectronic">
            </div>
            <div class="contenidor-secundari">
                <label>Contrasenya: </label><input class="campo-formulario" type="password" required name="contrasenya">
            </div>
            <div class="contenidor-secundari">
                <label>Telèfon: </label><input class="campo-formulario" type="tel" name="telefon">
            </div>
            <div class="contenidor-secundari">
                <label>Donació: </label>
                <select class="campo-formulario" name="donacio">
                    <option value="" selected>-- Tria una opció --</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Anual">Anual</option>
                </select>
            </div>
            <div class="contenidor-secundari">
                <label>Animal a apadrinar: </label>
                <select class="campo-formulario" name="animal">
                    <option value="" selected>-- Tria una opció --</option>
                    <option value="goril·la">Goril·la</option>
                    <option value="tortuga">Tortuga</option>
                    <option value="tigre">Tigre</option>
                    <option value="rinoceront">Rinoceront</option>
                    <option value="orangutan">Orangutan</option>
                </select>
            </div>
            <div class="contenidor-secundari">
                    <label>Continent: </label>
                    <div class="campo-formulario">
                    <div>
                        <label>Europa: </label>
                        <input type="radio" name="continent" value="Europa">
                    </div>
                    <div>
                        <label>Àsia: </label>
                        <input type="radio" name="continent" value="Àsia">
                    </div>
                    <div>
                        <label>Àfrica: </label>
                        <input type="radio" name="continent" value="Àfrica">
                    </div>
                    <div>
                        <label>Amèrica: </label>
                        <input type="radio" name="continent" value="Amèrica">
                    </div>
                    <div>
                        <label>Oceania: </label>
                        <input type="radio" name="continent" value="Oceania">
                    </div>
                </div>
            </div>
            <div class="contenidor-secundari">
                    <label>Estils Registre: </label>
                    <div class="campo-formulario">
                    <div>
                        <input type="radio" name="color" value="roig" checked>
                        <label> Roig</label>
                    </div>
                    <div>
                        <input type="radio" name="color" value="marro">
                        <label> Marró</label>
                    </div>
                </div>
            </div>
            <div class="contenidor-secundari">
                <label>Puntúa la pàgina: </label>
                <div class="campo-formulario">
                    <input type="number" min="1" max="5" name="puntuacio" required>
                    <input type="range" min="1" max="100" name="multiplicador">
                </div>
            </div>
            <div class="contenidor-secundari">
                <input class="button" type="submit" value="Envia">
                <input class="button" type="reset" value="Reset">
            </div>
        </form>
    </div>
</main>
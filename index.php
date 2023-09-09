<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Calculadora IMC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/style.css" />
</head>

<body>
  <h1>Calculadora Índice de Masa Corporal</h1>

  <div>
    <section class="section-left">
      <h2>Fórmula IMC</h2>
      <div class="div_image">
        <img src="./assets/images/imc.png" class="img-thumbnail" alt="img_imc" width="250px" />
      </div>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
          <label for="InputText" class="form-label">Nombre completo</label>
          <input type="text" class="form-control" name="nombre" id="InputText" aria-describedby="emailHelp" placeholder="Ingresa tu nombre" required />
        </div>

        <div class="mb-3">
          <label for="InputText2" class="form-label">Apellidos completo</label>
          <input type="text" class="form-control" name="apellido" id="InputText2" aria-describedby="emailHelp" placeholder="Ingresa tu apellido" required />
        </div>

        <div class="mb-3">
          <label for="InputDate" class="form-label">Fecha de nacimiento</label>
          <input type="date" class="form-control" name="nacimiento" id="InputDate" aria-describedby="emailHelp" />
        </div>

        <div class="mb-3">
          <label for="InputText2" class="form-label">Género</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="genero" id="flexRadioDefault1" value="hombre" checked />
            <label class="form-check-label" for="flexRadioDefault1">
              Hombre
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="genero" id="flexRadioDefault2" value="mujer" />
            <label class="form-check-label" for="flexRadioDefault2">
              Mujer
            </label>
          </div>
        </div>

        <div class="input-group mb-3">
          <label for="InputDate" class="form-label">Peso </label>
          <input type="number" class="form-control" name="peso" aria-label="Peso en kilogramos (con decimales)" placeholder="Ej. 70.5" step="0.1" required />
          <span class="input-group-text"> kg</span>
        </div>

        <div class="input-group mb-3">
          <label for="InputDate" class="form-label">Talla </label>
          <input type="number" class="form-control" name="talla" aria-label="Talla en centímetros (con decimales)" placeholder="Ej. 170" step="1" required />
          <span class="input-group-text"> cm</span>
        </div>

        <div class="div_button">
          <button type="submit" class="btn btn-primary">Calcular</button>
        </div>
      </form>
    </section>

    <section class="section-right">
      <h2>Tabla IMC</h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">IMC - HOMBRES</th>
            <th scope="col">IMC - MUJERES</th>
            <th scope="col">INTERPRETACIÓN IMC</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>&lt; 20</td>
            <td>&lt; 20</td>
            <td>Bajo peso</td>
          </tr>
          <tr>
            <td>20 - 24.9</td>
            <td>20 - 23.9</td>
            <td>Normal</td>
          </tr>
          <tr>
            <td>25 - 29.9</td>
            <td>24 - 28.9</td>
            <td>Obesidad leve</td>
          </tr>
          <tr>
            <td>30 - 40.0</td>
            <td>29 - 37.0</td>
            <td>Obesidad severa</td>
          </tr>
          <tr>
            <td>40 &gt;</td>
            <td>37 &gt;</td>
            <td>Obesidad muy severa</td>
          </tr>
        </tbody>
      </table>

      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $nacimiento = $_POST["nacimiento"];
        $genero = $_POST["genero"];
        $peso = floatval($_POST["peso"]);
        $talla = floatval($_POST["talla"]) / 100; // Convertir de cm a m

        // Calcular el IMC
        $imc = $peso / ($talla * $talla);

        // Determinar la categoría
        $categoria = "";
        if ($genero === "hombre") {
          if ($imc < 20) {
            $categoria = "Bajo peso";
          } elseif ($imc >= 20 && $imc <= 24.9) {
            $categoria = "Normal";
          } elseif ($imc >= 25 && $imc <= 29.9) {
            $categoria = "Obesidad leve";
          } elseif ($imc >= 30 && $imc <= 40) {
            $categoria = "Obesidad severa";
          } else {
            $categoria = "Obesidad muy severa";
          }
        } else {
          if ($imc < 20) {
            $categoria = "Bajo peso";
          } elseif ($imc >= 20 && $imc <= 23.9) {
            $categoria = "Normal";
          } elseif ($imc >= 24 && $imc <= 28.9) {
            $categoria = "Obesidad leve";
          } elseif ($imc >= 29 && $imc <= 37) {
            $categoria = "Obesidad severa";
          } else {
            $categoria = "Obesidad muy severa";
          }
        }

        // Mostrar resultados
        echo '<h2>Resultado</h2>';
        echo '<div class="alert alert-primary" role="alert">';
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Apellidos:</strong> $apellido</p>";
        echo "<p><strong>Fecha de nacimiento:</strong> $nacimiento</p>";
        echo "<p><strong>Género:</strong> $genero</p>";
        echo "<p><strong>Peso:</strong> $peso kg</p>";
        echo "<p><strong>Talla:</strong> " . ($talla * 100) . " cm</p>";
        echo "<p><strong>IMC:</strong> " . number_format($imc, 2) . "</p>";
        echo "<p><strong>Interpretación:</strong> $categoria</p>";
        echo '</div>';
      }
      ?>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
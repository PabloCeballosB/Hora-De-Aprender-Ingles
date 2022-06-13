<!--Pablo Ceballos Benitez
  Mockup Hacer Ejercicio -->
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hacer Ejercicio</title>
    <link rel="stylesheet" type="text/css" href="../../css/HacerEjercicio.css">
  </head>
  <body>
    <!-- Cabecera -->
    <header>
      <!-- Imagen logo con texto de bienvenida y enlace de login / logout -->
      <img src="../../imagenes/logo.png" id="logo">
      <p id="mensajeBienvenida">
        Bienvenido de nuevo, Usuario
        <a href="#" id="loginout">
          Logout
        </a>
      </p>
    </header>
    <!-- Barra de navegacion -->
    <nav>
      <div>
        <a href="#">Ejercicios</a>
        <a href="../Controlador/controlador.php?click=altaFrase">Crear Ejercicios</a>
      </div>
    </nav>
    <!-- Cuerpo de la Pagina -->
    <aside>
      <!-- Div que contendrá el enunciado del ejercicio -->
      <div id="enunciado">
        <p>
          1. Completa los huecos de las siguientes frases en las casillas mostradas al final de la pagina.
        </p>
      </div>
      <!-- div que contendra las preguntas del ejercicio -->
      <div id="frases">
        <?php
          require_once('../Controlador/controlador.php');
          $controlador = new Controlador;
          $controlador->insertarDatos();
          $filas = $controlador->filas;
          
        ?>
        <p>
          <img src="../../imagenes/flecha.png" class="FlechaFrases">
          Lorem ipsum dolor <span id="1" class="palabras">1</span> sit amet, consectetur adipiscing elit,
          sed do eiusmod tempor incididunt.
        </p>
        <p>
          <img src="../../imagenes/flecha.png" class="FlechaFrases">
          Lorem ipsum dolor sit amet, <span id="2" class="palabras">2</span> adipiscing elit,
          sed do eiusmod tempor incididunt.
        </p>
        <p>
          <img src="../../imagenes/flecha.png" class="FlechaFrases">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit,
          sed do <span id="3" class="palabras">3</span> tempor incididunt.
        </p>
        <p>
          <img src="../../imagenes/flecha.png" class="FlechaFrases">
          Lorem <span id="4" class="palabras">4</span> dolor sit amet, consectetur adipiscing elit,
          sed do eiusmod tempor incididunt.
        </p>
      </div>
      <hr>
      <!-- Div que contendra la lista de cuadros de texto para añadir las respuestas -->
      <div id="respuestas">
        <form action="#">
          <label>1<img src="../../imagenes/flecha-respuesta.png"></label>
          <input type="text"/><br>
          <label>2<img src="../../imagenes/flecha-respuesta.png"></label>
          <input type="text"/><br>
          <label>3<img src="../../imagenes/flecha-respuesta.png"></label>
          <input type="text"/><br>
          <label>4<img src="../../imagenes/flecha-respuesta.png"></label>
          <input type="text"/>

          <input type="submit" value="Siguiente" id="BotonSiguiente"/>
        </form>
      </div>
    </aside>
  </body>
</html>

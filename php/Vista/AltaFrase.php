<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Alta de Frase</title>
    <link rel="stylesheet" type="text/css" href="../../css/AltaFrase.css">
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
        <a href="../Controlador/controlador.php?click=hacerEjercicio">Ejercicios</a>
        <a href="#">Crear Ejercicios</a>
      </div>
    </nav>
    <!-- Cuerpo de la Pagina -->
    <aside>
      <form method="post" enctype="multipart/form-data" id="formulario">
        <fieldset>
          <legend> Crear Nueva Frase </legend>
          <label for="frase" id="Frase1">Frase: </label>
          <input type="text" name="frase" id="Frase2"/>
          <?php
            //Si se ha pulsado el boton submit asegura que han sido rellenada la frase, sino da error
            if(isset($_POST["enviarfrase"]) && !empty($_POST["enviarfrase"]))
            {
                //Si está vacio el cuadro de texto de la clase, muestro error
                if(empty($_POST['frase'])){
                  echo '<br><div class="divError">ERROR, tienes que insertar al menos una frase</div>';
                }
                else
                {
                  //$cadenanumeros -> array que contiene los numeros introducidos en la frase
                  //$fraseArray -> contendra la frase pasada de String a Array para identificar cada elemento
                  $frase = $_POST['frase'];
                  $fraseArray = explode(" ",$frase);
                  echo filter_var($fraseArray, FILTER_SANITIZE_NUMBER_INT);
                  $cadenanumeros = array();
                  //Obtengo los numeros encerradas en Parentesis
                  preg_match_all('/\(+[0-9]+\)/', $_POST['frase'], $numeros);
                  //recorro los parentesis
                  for($i=0; $i<count($numeros[0]);$i++){
                      $b = str_replace(["(",")"],"",$numeros[0][$i]);//Elimino los caracteres no deseados ()
                      $cadenanumeros[$i] = $b;//Agrego al array de salida
                  }

                  $sw = 0;

                  //IF que se encarga de comprobar si hay numeros introducidos en la frase
                  if(!empty($cadenanumeros))
                    $sw = 1;


                  //si $c no ha encontrado ningun numero, muestra error
                  if($sw == 0)
                  {
                    echo '<br><div class="divError">ERROR, tienes que insertar numeros en la frase para identificar el hueco a rellenar <br>
                      Por ejemplo (The house (1) is very (2) and the dog is (3))
                    </div>';
                  }
                  else{
                    //Si no hay numeros identificadores
                    if(count($cadenanumeros) > count(array_unique($cadenanumeros))){
                        echo '<br><div class="divError">ERROR, ¡¡¡NO puedes repetir los numeros identificadores!!!</div>';
                    }
                    else{
                      //Si hay numeros identificadores mostramos la frase y un aviso de lo que se debe hacer
                      echo "
                        <p id='frase'>---------- ↓↓↓ Frase introducida ↓↓↓ ----------</p>
                        <p>".$frase."</p>
                        <p id='avisoIntroducir'>(Introduce las palabras que faltan de la frase en los siguientes campos)</p>
                      ";

                      //Bucle que se encarga de crear las casillas para completar los huecos de la frase
                      for($i=0;$i<=count($cadenanumeros)-1;$i++)
                      {
                        echo "
                          <input type='number' name='posicion[]' value=".$cadenanumeros[$i]." class='inputNumeros' readonly/>
                            <img src='../../imagenes/flecha-respuesta.png'></label>
                          <input type='text' id='".$cadenanumeros[$i]."' name='palabra[]' class='rellenarHuecos' required/><br>
                        ";
                      }
                    }
                  }
                }
              }
          ?>

          <input type="submit" name="enviarfrase" value="Crear" id="enviarfrase">

          <?php
            //Si se ha presionado el boton "Crear" . . .
            if(isset($_POST["enviarfrase"]) && !empty($_POST["enviarfrase"]))
            {
              //Si todos los datos estan introducidos correctamente
              if(!empty($frase) && (!empty($cadenanumeros)) && (count($fraseArray) == count(array_unique($fraseArray))))
              {

                //Script que mantiene la frase y cambia los atributos al boton "Crear" para que se convierta en "terminar"
                echo "
                  <script type='text/javascript'>

                  document.getElementById('Frase2').setAttribute('value', '".$frase."')
                  document.getElementById('Frase1').style.display = 'none';
                  document.getElementById('Frase2').style.display = 'none';


                  let boton = document.getElementById('enviarfrase')
                  boton.setAttribute('name', 'btnterminar');
                  boton.setAttribute('value', 'Terminar');
                  boton.setAttribute('id', 'btnTerminar');

                </script>";
              }
            }
          ?>
        </fieldset>
      </form>
    </aside>
  </body>
</html>

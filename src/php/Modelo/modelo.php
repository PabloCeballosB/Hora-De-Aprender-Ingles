<?php
  require_once('../config.php');

  class Modelo{
    private $conexion;



    /*Funcion que se encarga de poder conectar con el servidor de base de datos*/
    function __construct(){
      $this -> conexion = new mysqli(servidorbd, usuario, contrasena, basedatos);
    }

    /*Funcion que se encarga de insertar todos los datos introducidos en AltaFrase.php*/
    function altaDatos(){
      if(isset($_POST["btnterminar"]) && !empty($_POST["btnterminar"]))
      {
        $frase = $_POST["frase"];
        $arrayPalabrasHuecos = array();
        $arrayPosicionHuecos = array();

        //Foreach que se encarga de meter todas las palabras introducidas en $arrayPalabrasHuecos
        foreach($_POST['palabra'] as $palabra)
          array_push($arrayPalabrasHuecos, $palabra);

        //Foreach que se encarga de meter todas las palabras introducidas en $arrayPosicionHuecos
        foreach($_POST['posicion'] as $posicion)
          array_push($arrayPosicionHuecos, $posicion);

        //Consulta que introduce el id por defecto y la frase introducida
        $consultaFrase = "INSERT INTO frases(idFrase, Texto) VALUES (default, '".$frase."');";

        //Conectamos con el servidor y ejecutamos $consultaFrase
        $this-> conexion -> query($consultaFrase);

        //Pasaremos a la variable $idFrase el idFrase de la ultima fila añadida
        $idFrase = mysqli_insert_id($this -> conexion);

        //Buble que se encarga de añadir las posiciones y las palabras en el servidor de BBDD
        for($i=0;$i<=count($arrayPosicionHuecos)-1;$i++)
        {
          $consultaPosicionyPalabra = "INSERT INTO frases_palabras(idFrase, Posicion, Palabra) VALUES ('".$idFrase."', '".$arrayPosicionHuecos[$i]."', '".$arrayPalabrasHuecos[$i]."');";
          $this-> conexion -> query($consultaPosicionyPalabra);
        }
      }

      //Llamamos a la funcion "insertarDatos" enviando como parametro $idFrase
      $this -> insertarDatos($idFrase);
    }


    function insertarDatos($idFrase){
      //Consulta que captura todos los datos introducidos en el formulario de la ultima frase agregada
      $consultaCogerDatos = "SELECT F.IdFrase, F.Texto, FP.Posicion, FP.Palabra
      FROM frases F
      INNER JOIN frases_palabras FP
      ON F.idFrase = FP.idFrase
      WHERE F.IdFrase = ".$idFrase."";

      //Ejecutar consulta y pasar el resultado a la variable $resultado
      $resultado = $this -> conexion -> query($consultaCogerDatos);

      //Bucle que se encarga de organizar todos los datos del $resultado a la variable $fila
      while($fila = $resultado->fetch_array()){
          $this -> filas[] = $fila;
      }

      $posicion = array();
      $palabra = array();

      //Foreach que recorre la variable filas donde se almacena todo los datos introducidos
      foreach ($this -> filas as $indice)
      {
        $texto = $indice['Texto'];
        array_push($posicion, $indice['Posicion']);
        array_push($palabra, $indice['Palabra']);
      }



/*
      echo $texto."<br>";
      print_r($posicion);
	  echo "<br>";
      print_r($palabra);
*/

    }

    function subirResultados(){

  }
}

?>

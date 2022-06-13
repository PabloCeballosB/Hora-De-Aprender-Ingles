<?php

    class Controlador{
      private $modelo;
      public $filas;
      public $idFrase;

      function __construct(){
          require_once('../Modelo/modelo.php');
          $this -> modelo = new Modelo;
      }

      /*Funcion que se encarga de mostrar la pagina de AltaFrase.php y comprobar
      si se ha introducido datos correctamente asi enviando a la funcion
      "insertar" de modelo.php*/
      function altaFrase(){
          require('../Vista/AltaFrase.php');
          if(isset($_POST["btnterminar"]) && !empty($_POST["btnterminar"])){
              $this -> modelo -> altaDatos();
          }
      }


      /*function insertarDatos(){
          require('../Vista/HacerEjercicio.php');
            $this->modelo->insertarDatos($idFrase);
            $this->filas = $this -> modelo -> filas;
      }*/

      function hacerEjercicio(){
        require('../Vista/HacerEjercicio.php');
        $this -> modelo -> subirResultados();
      }
  }

  $controlador = new Controlador;

  /*Switch que se encarga de mandar a una funcion u otra depende del click donde se haya realizado*/
  switch ($_GET['click']) {
      case 'altaFrase':
          $controlador->altaFrase();
          break;
      case 'hacerEjercicio':
          $controlador->hacerEjercicio();
          break;
      /*case 'listafrase':
          $controlador -> listarVista();
          break;
      case 'modificarfrase':
          $controlador -> modificarVista();
          break;
      case 'borrarfrase':
          $controlador -> borrar();
          break;*/
      default:
          echo "<h1>Pagina no Encontrada</h1>";
          break;
  }

?>

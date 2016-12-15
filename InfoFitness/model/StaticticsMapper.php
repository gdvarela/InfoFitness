<?php
// file: model/StaticticsMapper.php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__."/../model/StaticticsActivity.php");
require_once(__DIR__."/../model/StaticticsTable.php");

class StaticticsMapper{

  private $db;

  public function __construct()
  {
      $this->db = PDOConnection::getInstance();
  }

      public function getAssistanceStatictics() {

  	    $stmt = $this->db->query("SELECT Actividad.nombre, count(Sesion.id_actividad) as num
                                   FROM Sesion,Actividad,Usuario
                                   WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                         Usuario.id_usuario = Sesion.id_usuario
                                   GROUP BY Actividad.nombre");

          $stmt1 = $this->db->query("SELECT distinct(Actividad.nombre), count(Sesion.id_actividad) as num, AVG(YEAR(CURDATE())-YEAR(Usuario.fecha_nacimiento))  AS media_edad
                                     FROM Sesion,Actividad,Usuario
                                     WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                           Usuario.id_usuario = Sesion.id_usuario AND
                                           Usuario.sexo='mujer' AND Sesion.id_actividad >= 0 or Sesion.id_actividad is null
                                     GROUP BY Actividad.nombre");

        $total_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  		  $total_num_women = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $women_percent = array();
        $men_percentage = array();
        $statictics = array();

        foreach ($total_users as $keyu) {
          foreach($total_num_women as $keyw){
            if($keyu['nombre'] == $keyw['nombre'])
              if($keyw['num'] > 0){
                $women_percent['wa'][$keyu['nombre']] = round(($keyw['num']/$keyu['num'])*100) . "%";
                $men_percentage['ma'][$keyu['nombre']] = round((100-($keyw['num']/$keyu['num'])*100)) . "%";
              }else{
                $women_percent['wa'][$keyu['nombre']] = 0 ."%";
                $men_percentage['ma'][$keyu['nombre']] = 100-0 ."%";
              }
          }

        }

        foreach ($women_percent as $key => $value) {
            foreach ($value as $key1 => $value1) {
              foreach ($men_percentage as $key2 => $value2) {
                  foreach ($value2 as $key3 => $value3) {
                    if($key1 == $key3){
                    array_push($statictics, new StaticticsActivity($activity = $key1, $women_percent=$value1,$men_percent=$value3));
                    }
                  }

              }
           }

        }
          return $statictics;
      }

      public function getAgeStatictics() {

      $stmt = $this->db->query("SELECT distinct(Actividad.nombre), AVG(YEAR(CURDATE())-YEAR(Usuario.fecha_nacimiento))  AS media_edad
                                 FROM Sesion,Actividad,Usuario
                                 WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                       Usuario.id_usuario = Sesion.id_usuario AND
                                       Usuario.sexo='mujer'
                                 GROUP BY Actividad.nombre");
     $stmt1 = $this->db->query("SELECT distinct(Actividad.nombre), AVG(YEAR(CURDATE())-YEAR(Usuario.fecha_nacimiento))  AS media_edad
                                FROM Sesion,Actividad,Usuario
                                WHERE Actividad.id_actividad = Sesion.id_actividad AND
                                      Usuario.id_usuario = Sesion.id_usuario AND
                                      Usuario.sexo='hombre'
                                GROUP BY Actividad.nombre");

    $avg_women_age = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $avg_men_age = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    $age_statictics_men = array();
    $age_statictics_women = array();
    $age_statictics = array();

    foreach ($avg_women_age as $key => $value) {
        foreach ($avg_men_age as $key2 => $value2) {
          if ($value['nombre'] == $value2['nombre']){
            $age_statictics_men['ma'][$value['nombre']] =round($value2['media_edad']);
            $age_statictics_women['wa'][$value['nombre']] =round($value['media_edad']);
          }
      }
   }

   foreach ($age_statictics_men as $key => $value) {
       foreach ($value as $key1 => $value1) {
         foreach ($age_statictics_women as $key2 => $value2) {
             foreach ($value2 as $key3 => $value3) {
               if($key1 == $key3){
               array_push($age_statictics, new StaticticsActivity($activity = $key1, $women_percent=null,$men_percent=null,$avg_women_age = $value3, $avg_men_age = $value1));
               }
             }

         }
      }

   }

      return $age_statictics;
}



  public function getTableStatictics() {
  $stmt = $this->db->query("SELECT (Tabla_Ejercicios.nombre), count(Tabla_Ejercicios_Deportista.id_tabla) as num
                  FROM tabla_ejercicios, tabla_ejercicios_deportista
                  WHERE Tabla_Ejercicios.id_tabla= Tabla_Ejercicios_Deportista.id_tabla GROUP BY Tabla_Ejercicios.nombre");
  $stmt1 = $this->db->query("SELECT count(id_tabla) FROM Tabla_Ejercicios_Deportista");

  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $total_tables = $stmt1->fetchColumn();
  $table_statictics = array();

  foreach ($tables as $key => $value) {
    array_push($table_statictics, new StaticticsTable($table = $value['nombre'],$table_percent = round(($value['num']/$total_tables)*100) . "%" ));
  }
  return $table_statictics;
  }
}
?>

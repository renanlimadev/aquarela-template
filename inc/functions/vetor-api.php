<?php 
/**
 * 
 * Arquivamento de tratamento da requisição da api do ERP Vetor
 * 
 * @package aquarela-template
 * 
 * @since 1.0.0
 * 
 */

// Variável para a hora atual
$actualy_time = false;

// Variável para hora salva no banco de dados
$db_my_time = false;

// Variável para salvar a diferença entre as horas
$the_time_diferent = false;

// Laço que determina o momento da operação
if ($db_my_time == false){

    $db_my_time = $actualy_time;

} else {

    $the_time_diferent = ($actualy_time - $db_my_time);

    if ($the_time_diferent >= 5){



    }

}

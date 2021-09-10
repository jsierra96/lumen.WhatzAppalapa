<?php
    namespace App\Http\Controllers;

    class ModulesController extends Controller {

        public function getAllModules() {
            $results = app('db')->select( "SELECT * FROM `modules` WHERE `status` = 1 ORDER BY `order`;" );
            $code = 200;
            if( is_array( $results ) ) {
                $modulos = array();
                foreach( $results as $modulo ) {
                    array_push( $modulos, array( 'id' => $modulo->id, 'emoji' => $modulo->emoji, 'name' => $modulo->name, 'orden' => $modulo->order ) );
                }
                $data = array( 'error' => false, 'data' => $modulos );
            } else {
                $code = 404;
                $data = array( 'error' => true, 'data' => array( 'No hay módulos disponibles para el bot.' ) );
            }

            return response()->json( $data, $code);
        }
    }
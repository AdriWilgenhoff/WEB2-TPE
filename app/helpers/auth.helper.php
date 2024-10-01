<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {//nos evita que se inicien 2 veces las mismas sessiones
            session_start();//funcion estatica que se puede consultar desde cualquier seccion
        }
    }

    public static function login($user) {
        AuthHelper::init();//se ejecuta el metodo para chequear si ya esta iniciada o no
        $_SESSION['USER_ID'] = $user->id;//session toma los valores para poder consultar cada vez que se necesite 
        $_SESSION['USER_USERNAME'] = $user->username; //dar las autorizaciones
        
    }

    public static function logout() {
        AuthHelper::init();//lo mismo para el logout
        session_destroy();
    }

    public static function verify() {//verifica que el usuario este logueado para cualquier acceso a secciones que intente
        AuthHelper::init();//ingresa si se conceden permisos
        if (!isset($_SESSION['USER_ID'])) {//si no hay usuario significa que hay que redirigirlo a login
            header('Location: ' . BASE_URL . 'iniciar-sesion');
            die();
        }
    }

    
}
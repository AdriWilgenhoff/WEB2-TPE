<?php

class UserView {
    public function showLogIn(){
        require './templates/layout/header.phtml';
        require './templates/users/form-login.phtml';
        require './templates/layout/footer.phtml';
    }
}
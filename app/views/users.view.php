<?php

class UserView {
    public function showLogIn($message = null) {
        require './templates/layout/header.phtml';
        require './templates/users/formLogin.phtml';
        require './templates/layout/footer.phtml';
    }
}

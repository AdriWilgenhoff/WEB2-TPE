<?php

class LayoutView {
    private $countriesModel;

    public function showError($error)    {
		require './templates/layout/header.phtml';
        require './templates/layout/error.phtml';
		require './templates/layout/footer.phtml';
    }
	
    public function showError404(){
        require './templates/layout/header.phtml';
        require './templates/layout/404.phtml';
        require './templates/layout/footer.phtml';
    }

    public function showCountryMenu(){
        require './templates/layout/menuCountries.phtml';
    }
}
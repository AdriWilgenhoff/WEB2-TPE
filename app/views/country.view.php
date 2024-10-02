<?php
class CountryView{

    public function showCountries($countries, $message = null) {
		require './templates/layout/header.phtml';        
		require './templates/countries/showCountries.phtml';
		require './templates/layout/footer.phtml';
	}

    public function showCountry($country){
        require './templates/layout/header.phtml'; 
        require './templates/countries/showCountryDetail.phtml';
        require './templates/layout/footer.phtml';
    }
	
    public function showFormUpdateCountry($country){
        require './templates/layout/header.phtml'; 
        require './templates/countries/form-updateCountry.phtml';
        require './templates/layout/footer.phtml';    
    } 
    
    public function showFormAddCountry(){
        require './templates/layout/header.phtml'; 
        require './templates/countries/form-addCountry.phtml';
        require './templates/layout/footer.phtml';
    }
}
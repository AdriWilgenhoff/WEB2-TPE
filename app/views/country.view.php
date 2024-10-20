<?php
class CountryView{

    public function showCountries($countries) {
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
        require './templates/countries/formUpdateCountry.phtml';
        require './templates/layout/footer.phtml';    
    } 
    
    public function showFormAddCountry(){
        require './templates/layout/header.phtml'; 
        require './templates/countries/formAddCountry.phtml';
        require './templates/layout/footer.phtml';
    }
}
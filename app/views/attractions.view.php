<?php

class AttractionsView {

    public function showAllAtractions($attractions,$countries,$selectedCountry,$error){
        require './templates/layout/header.phtml';
        require './templates/layout/menuCountries.phtml';
        if($error)
            include_once './templates/layout/boxError.phtml';
        require './templates/attractions/showAtractions.phtml';
        require './templates/layout/footer.phtml';
    }

    public function showAttractionsByCountry($attraction,$error){
        require './templates/layout/header.phtml';       
        require './templates/attractions/showAtractions.phtml';
        require './templates/layout/footer.phtml';
    }

    public function showAttraction($attraction){
        require './templates/layout/header.phtml';
        require './templates/attractions/showAttractionDetail.phtml';
        require './templates/layout/footer.phtml';
    }

    public function showFormUpdate($attraction,$countries){
        require './templates/layout/header.phtml';
        require './templates/attractions/formUpdateAttraction.phtml';
        require './templates/layout/footer.phtml'; 
    } 
    
    public function showFormAddAttraction($countries){
        require './templates/layout/header.phtml';
        require './templates/attractions/formAddAttraction.phtml';
        require './templates/layout/footer.phtml';
    }
}

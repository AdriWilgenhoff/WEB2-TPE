<?php

class AttractionsView {

    public function showAllAtractions($attractions,$countries){
        require './templates/layout/header.phtml';
        require './templates/layout/menuCountries.phtml'       ;
        require './templates/attractions/showAtractions.phtml';
        require './templates/layout/footer.phtml';
    }

    public function showAttractionsByCountry($attraction){
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
        require './templates/attractions/form-updateAttraction.phtml';
        require './templates/layout/footer.phtml';
        
    } 
    
    public function showFormAddAttraction($countries){
        require './templates/layout/header.phtml';
        require './templates/attractions/form-addAttraction.phtml';
        require './templates/layout/footer.phtml';
    }
}

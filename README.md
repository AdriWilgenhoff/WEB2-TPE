# Trabajo Práctico Especial - Web 2 - 2024

## Integrantes
- Florencia Alarcos (36608008)
- Adrian Ezequiel Wilgenhoff (33356953)
 
## Temática
Atracciones Turistícas

## Descripcion
Este sitio web ofrece una guía informativa sobre las principales atracciones turísticas del mundo, organizadas por países. Los usuarios pueden explorar diversos destinos, descubrir lugares emblemáticos, y obtener información detallada sobre cada atracción, como su ubicación, descripción, horarios y precios de entrada.

## Diagrama Entidad-Relación
El diagrama tiene una relación de forma tal que una atraccion pertenece solo a un pais, mientras que un pais puede contener N cantidad de atracciones.

![Diagrama de Entidad-Relacion](databse/Diagrama-Entidad-Relacion.png)

/project-root
    /app
        /controllers
            attractions.controller.php       
            auth.controller.php
            country.controller.php
                
        /helpers
        /models
            attractions.model.php         
            country.model.php         
            db.model.php            
            user.model.php
                
        /views
			attractions.view.php
			country.view.php
			layout.view.php
			users.view.php
    /images     
    /config
        config.php
    /database
        destinos_turisticos.sql
    /templates
        /attractions
            form-addAttraction.phtml
            form-updateAttraction.phtml
            showAttractions.phtml
            showAttractionDetail.phtml
        /countries
            form-addCountry.phtml
            form-updateCountry.phtml
            showCountries.phtml
            showCountryDetail.phtml
        /layout
            error.phtml
            footer.phtml
            header.phtml
            succes.phtml
        /users
            form-login.phtml        
    /router.php

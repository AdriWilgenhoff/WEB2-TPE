-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 10:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `destinos_turisticos`
--

-- --------------------------------------------------------

--
-- Table structure for table `atracciones_turisticas`
--

CREATE TABLE `atracciones_turisticas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `hora_apertura` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `pagina_oficial` varchar(255) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atracciones_turisticas`
--

INSERT INTO `atracciones_turisticas` (`id`, `nombre`, `direccion`, `precio`, `ruta_imagen`, `descripcion`, `hora_apertura`, `hora_cierre`, `pagina_oficial`, `pais_id`) VALUES
(1, 'Torre Eiffel', 'Av. Gustave Eiffel, 75007 Paris', 25.00, 'https://imagenes.com/torre_eiffel.jpg', 'La Torre Eiffel es el monumento más visitado de todo el mundo con más de 7 millones de visitantes anuales, por lo que se convierte en uno imprescindible que ver en París. Esta gran torre de hierro mide 300 metros de altura, lo que hace que se puede ver desde varios puntos de la ciudad. Para disfrutar de su silueta inconfundible cuatro lugares perfectos son Campo de Marte, la Pasarela Debilly, los Jardines del Trocadero y desde la rue de l’Université.', '09:00:00', '23:00:00', 'https://www.toureiffel.paris', 2),
(2, 'Chichén Itzá', 'Chichén Itzá, 97751 Yucatán', 20.00, 'https://imagenes.com/chichen_itza.jpg', 'Un importante sitio arqueológico maya conocido por su pirámide.', '08:00:00', '17:00:00', 'https://www.inah.gob.mx/zonas/146-zona-arqueologica-de-chichen-itza', 3),
(3, 'Big Ben', 'London SW1A 0AA', 0.00, 'https://imagenes.com/big-ben.jpg', 'El Big Ben es uno de los símbolos de Inglaterra y uno de los relojes más famosos de todo el mundo. Si visitas Londres no puedes perderte hacerte una foto con este monumento que forma parte del Palacio de Westminster que es la actual sede del Parlamento del Reino Unido. En el tour de Londres al completo está incluida esta parada que sin duda te va a sorprender, ya que el Big Ben realmente es una enorme campana de 14 toneladas que se encuentra en el interior de la torre, y el reloj mide nada más y nada menos que 7 metros de diámetro en cada una de sus caras.', '00:00:00', '00:00:00', '', 1),
(4, 'Coliseo de Roma', 'Piazza del Colosseo, 1, 00184 Roma RM', 35.00, 'https://imagenes.com/coliseo_roma.jpg', 'El Coliseo de Roma es el monumento más importante de la ciudad y está considerado como el monumento más visitado de Italia, recibiendo más de 6 millones de visitantes cada año. Es precisamente por ello, que este monumento también es uno de los lugares más visitados de toda Europa, por lo que si quieres conocerlo por dentro si o si tendrás que comprar tus entradas con antelación porque se agotan rápidamente y las colas de acceso siempre son muy largas.', '08:00:00', '18:30:00', 'https://colosseo.it/', 4),
(5, 'Torre de Londres', 'London EC3N 4AB', 34.80, 'https://imagenes.com/torre_londres.jpg', 'La Torre de Londres es uno de los monumentos históricos más destacados e intrigantes que ver en Londres. Este castillo medieval se encuentra ubicado en la ribera norte del río Támesis y cuenta con una larga historia de casi mil años. En tu visita a la Torre de Londres es importante que sepas que ha tenido diversos usos desde residencia real, arsenal hasta fortaleza y prisión.\r\nLa verdad es que esta torre está envuelta de enigmas por lo que la mejor forma para descubrirlos es realizar el tour de los misterios y leyendas de Londres. Te advertimos que quizás se te pongan los pelos de punta.', '09:00:00', '17:30:00', 'https://www.hrp.org.uk/tower-of-london/', 1),
(6, 'Abadía de Westminster', 'Deans, Yard London SW1P 3PA', 34.80, 'https://imagenes.com/abadia_westminster.jpg', 'Si quieres realizar un tour completo de Londres no puede faltar en tu itinerario visitar la Abadía de Westminster que su nombre completo es colegiata de San Pedro en Westminster. Este impresionante edificio de estilo gótico es uno de los edificios religiosos más importantes de todo Reino Unido y lugar de sepultura de numerosos monarcas ingleses a lo largo de la historia. Recuerda que con la London Pass tienes el acceso gratuito a la abadía.', '09:00:00', '17:00:00', 'https://tickets.westminster-abbey.org/', 1),
(7, 'Jardines de Luxemburgo', '75006 Paris', 0.00, 'https://imagenes.com/jardines_luxemburgo.jpg', 'Los Jardines de Luxemburgo se encuentran ubicados en el distrito XVI de París y para nosotros es una de las zonas verdes más bonitas de la capital francesa. Estos jardines fueron diseñados a principios del siglo XVII por órdenes de María de Médicis. Cuentan con una parte diseñada al estilo inglés y otra parte de estilo francés.', '00:00:00', '00:00:00', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atracciones_turisticas`
--
ALTER TABLE `atracciones_turisticas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atracciones_turisticas`
--
ALTER TABLE `atracciones_turisticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atracciones_turisticas`
--
ALTER TABLE `atracciones_turisticas`
  ADD CONSTRAINT `atracciones_turisticas_ibfk_1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

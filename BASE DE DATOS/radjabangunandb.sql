-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-01-2016 a las 18:58:11
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `radjabangunandb`
--
CREATE DATABASE IF NOT EXISTS `radjabangunandb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `radjabangunandb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e00cf25ad42683b3df678c61f42c6bda'),
(2, 'admin1', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` char(5) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `harga_modal` int(12) NOT NULL,
  `harga_jual` int(12) NOT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `brand` varchar(200) NOT NULL,
  `model` varchar(100) NOT NULL,
  `dimension` varchar(100) NOT NULL,
  `realeased` varchar(100) NOT NULL,
  `display` varchar(100) NOT NULL,
  `file_gambar` varchar(100) NOT NULL,
  `kd_kategori` char(4) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_modal`, `harga_jual`, `stok`, `keterangan`, `brand`, `model`, `dimension`, `realeased`, `display`, `file_gambar`, `kd_kategori`) VALUES
('B0001', 'Antena Wifi 2.4-2.4835ghz Wireless Adapter Alfa Pannel Chipset 3070', 140, 150, 7, 'Especificaciones:\n\nChipset: Ralink 3070 antena: 58dbi direccional de potencia de salida: 26dBm (ofdm), 32dBm (cck)\n\nRango de frecuencia: 2.4 GHz (banda ism) interfaz de host: Mini USB de montaje en pared: sí\n\nCantidad: 1 unids Tamaño del paquete: 29.5x19.5x12 (cm)\n\nPeso bruto/paquete: 1 (kg)\n\n \n\nCaracterísticas:\n\nEstándar industrial, estable y duradera\n\n58dbi antena de alta ganancia direccional\n\nRango de más de 3 km con conexión estable\n\n5800 mW alta potencia de salida\n\nRalink 3070 chipset\n\nCable blindado USB Premium 5 metros\n\nIEEE 802.11 b/g/n (hasta 150 mbps)\n\nCompatible con BackTrack12 (beini)', 'HCA', 'Networking Card Alfa', '802.11b,802.11g,802.11n', '2015/12/16', 'USB', 'B0001.antena.jpg', 'K002'),
('B0003', 'Antena Nanostation M5 Loco 5,8 Ghz', 240, 250, 10, '<p>Ubiquiti NanoStation M5 loco Wireless CPE</p>\r\n<p>Performance Breakthrough</p>\r\n<p>150 Mbps real outdoor throughput and up to 15km range. Featuring 2x2 MIMO technology, the new LocoStation M links significantly faster and farther than ever before.</p>\r\n<p>Next-Gen Antenna Design</p>\r\n<p>New antenna array designs featuring 13dBi dual-polarity gain at 5GHz with optimized cross-polarity isolation in a compact form-factor.</p>\r\n<p>Intelligent POE</p>\r\n<p>Remote hardware reset circuitry of LocoStation M allows for device to be reset remotely from power supply location. In addition, any LocoStation can easily become 802.3af 48V compliant through use of Ubiquiti&acute;s Instant 802.3af adapter.</p>\r\n<p>Super Efficient Antenna Performance&nbsp;</p>\r\n<p>Although approximately half the design of the original Ubiquiti Nanostation, NanoStation Loco still exhibits outstanding antenna performance. NanoStation5 Loco was able to maintain 13dBi of dual-polarity antenna gain in a compact form-factor using a highly efficient and innovative patch array antenna design.</p>\r\n<p>&nbsp;</p>\r\n<p>Featuring Powerful AirOS Software and Linux SDK&nbsp;</p>\r\n<p>NanoStation Loco ships standard with the powerful and intuitive AirOS by Ubiquiti Networks. It also is supported by a Linux SDK to encourage open source development.</p>\r\n<p>Reliable System Performance&nbsp;</p>\r\n<p>NanoStation Loco has been proven in extreme temperature and weather conditions. Additionally, it has advanced ESD/EMP immunity design to protect against common outdoor radio and ethernet failures and eliminate truck-rolls for carriers.</p>', 'Ubiquiti', 'Nano Loco M5', '150 mbps', '2015/12/28', '5,8 ghz', 'B0003.B0003.loco.jpg', 'K002'),
('B0002', 'Tarjetas De Video Sin Marca', 80, 100, 4, 'Especificaciones:\n \nChipset: Ralink 3070 antena: 58dbi direccional de potencia de salida: 26dBm (ofdm), 32dBm (cck)\nRango de frecuencia: 2.4 GHz (banda ism) interfaz de host: Mini USB de montaje en pared: sí\nCantidad: 1 unids Tamaño del paquete: 29.5x19.5x12 (cm)\nPeso bruto/paquete: 1 (kg)\n \nCaracterísticas:\n\n\n \nEstándar industrial, estable y duradera\n58dbi antena de alta ganancia direccional\nRango de más de 3 km con conexión estable\n5800 mW alta potencia de salida\nRalink 3070 chipset\nCable blindado USB Premium 5 metros\nIEEE 802.11 b/g/n (hasta 150 mbps)\nCompatible con BackTrack12 (beini)', 'HCA', 'HD6670', '128 Bit', '2015/12/16', 'DirectX 11', 'B0002.video.jpg', 'K003'),
('B0004', 'Celular Sony Z3 Koreano', 250, 300, 1, '<p>Cleuar Sony z3 en buen estado</p>', 'Sony', 'z3', '5 pulgadas', '2015/12/31', '5', 'B0004.374621-sony-xperia-z3-t-mobile-angle.jpg', 'K001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kabkot`
--

CREATE TABLE IF NOT EXISTS `kabkot` (
  `id_prov` int(2) NOT NULL,
  `id_kabkot` int(4) NOT NULL,
  `nama_kabkot` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kabkot`
--

INSERT INTO `kabkot` (`id_prov`, `id_kabkot`, `nama_kabkot`) VALUES
(1, 1, 'Tacna'),
(1, 2, 'Candarave'),
(1, 3, 'Jorge Basadre'),
(1, 4, 'Tarata'),
(2, 5, 'Arequipa'),
(2, 6, 'Camana'),
(2, 7, 'Caravelli'),
(2, 8, 'Castilla'),
(2, 9, 'Caylloma'),
(2, 10, 'Condesuyos'),
(2, 11, 'Islay'),
(2, 12, 'La Union'),
(4, 13, 'Juliaca'),
(4, 14, 'Melgar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kd_kategori` char(4) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K001', 'Computadoras'),
('K002', 'Antenas'),
('K003', 'Tarjetas de Video'),
('K004', 'Audio y Video'),
('K005', 'Electronicos'),
('K006', 'Cables'),
('K007', 'Telefonos Celulares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kec`
--

CREATE TABLE IF NOT EXISTS `kec` (
  `id_prov` int(2) NOT NULL,
  `id_kabkot` int(4) NOT NULL,
  `id_kec` int(4) NOT NULL,
  `nama_kec` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kec`
--

INSERT INTO `kec` (`id_prov`, `id_kabkot`, `id_kec`, `nama_kec`) VALUES
(1, 1, 1, 'Tacna'),
(1, 1, 2, 'Alto del Alianza'),
(1, 1, 3, 'Calana'),
(1, 1, 4, 'Inclan'),
(1, 1, 5, 'Pachia'),
(1, 1, 6, 'Palca'),
(1, 1, 7, 'Pocollay'),
(1, 1, 8, 'Sama'),
(1, 1, 9, 'Ciudad Nueva'),
(1, 1, 10, 'Crnl.Gregorio Albarracin'),
(1, 2, 11, 'Candarave'),
(1, 2, 12, 'Cairani'),
(1, 2, 13, 'Camilaca'),
(1, 2, 14, 'Curibaya'),
(1, 2, 15, 'Huanuara'),
(1, 2, 16, 'Quilahuani'),
(4, 14, 17, 'Ayaviri');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `no_pemesanan` varchar(8) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `nm_bank` varchar(12) NOT NULL,
  `jumlah_transfer` int(12) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kd_pelanggan` char(6) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `nm_belakang` varchar(100) NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `info_tambahan` text NOT NULL,
  `id_kabkot` int(4) NOT NULL,
  `id_prov` int(4) NOT NULL,
  `kode_pos` varchar(30) NOT NULL,
  `id_kec` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(5) NOT NULL,
  `kode_aktivasi` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `nm_pelanggan`, `nm_belakang`, `kelamin`, `email`, `no_telepon`, `mobile`, `alamat`, `info_tambahan`, `id_kabkot`, `id_prov`, `kode_pos`, `id_kec`, `username`, `password`, `status`, `kode_aktivasi`, `tgl_daftar`) VALUES
('P00001', 'Platea', '21', '', 'gorchor@gmail.com', '995530374', '995530374', 'GAL Tacna, Peru ', '', 1, 1, '00051', 10, 'platea21', '827ccb0eea8a706c4c34a16891f84e7b', 'N', 'FdOtv9Lk8M', '2016-01-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `no_pemesanan` char(8) NOT NULL,
  `kd_pelanggan` char(6) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `tgl_pemesanan` date NOT NULL DEFAULT '0000-00-00',
  `nama_penerima` varchar(60) NOT NULL,
  `alamat_lengkap` varchar(200) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `id_prov` int(2) NOT NULL,
  `id_kabkot` int(2) NOT NULL,
  `id_kec` int(4) NOT NULL,
  `kode_pos` varchar(6) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_bayar` enum('Pendiente','Completo','Nulo') NOT NULL DEFAULT 'Pendiente',
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`no_pemesanan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pemesanan_item`
--

CREATE TABLE IF NOT EXISTS `pemesanan_item` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `no_pemesanan` char(8) NOT NULL,
  `kd_barang` char(5) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prov`
--

CREATE TABLE IF NOT EXISTS `prov` (
  `id_prov` int(2) NOT NULL,
  `nama_prov` char(30) NOT NULL,
  `biaya_kirim` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prov`
--

INSERT INTO `prov` (`id_prov`, `nama_prov`, `biaya_kirim`) VALUES
(1, 'Tacna', 0),
(2, 'Arequipa', 0),
(3, 'Moquegua', 0),
(4, 'Puno', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `kd_provinsi` char(3) NOT NULL,
  `nm_provinsi` varchar(100) NOT NULL,
  `biaya_kirim` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_provinsi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrasi`
--

CREATE TABLE IF NOT EXISTS `registrasi` (
  `id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id_slide` int(12) NOT NULL AUTO_INCREMENT,
  `nm_slide` varchar(20) NOT NULL,
  `foto_slide` varchar(255) NOT NULL,
  PRIMARY KEY (`id_slide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiki`
--

CREATE TABLE IF NOT EXISTS `tiki` (
  `kd_kota` char(8) NOT NULL,
  `nm_kota` varchar(200) NOT NULL,
  `ons` varchar(30) NOT NULL,
  `reg` varchar(30) NOT NULL,
  `eco` varchar(30) NOT NULL,
  `administrasi` varchar(200) NOT NULL,
  PRIMARY KEY (`kd_kota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_keranjang`
--

CREATE TABLE IF NOT EXISTS `tmp_keranjang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kd_barang` char(5) NOT NULL,
  `harga` int(12) NOT NULL,
  `jumlah` int(3) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `kd_pelanggan` char(6) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tmp_keranjang`
--

INSERT INTO `tmp_keranjang` (`id`, `kd_barang`, `harga`, `jumlah`, `tanggal`, `kd_pelanggan`, `nm_pelanggan`) VALUES
(4, 'B0001', 150, 2, '2015-12-27', 'P00001', 'admin'),
(5, 'B0004', 300, 1, '2016-01-22', 'P00001', 'platea21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

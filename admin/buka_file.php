<?php
if(isset($_GET['open'])) {
	switch($_GET['open']){
		case '' :
			if(!file_exists ("main.php")) die ("Empty Main Page!");
			include "main.php"; break;

		case 'Login' :
			if(!file_exists ("login.php")) die ("Sorry Empty Page!");
			include "login.php"; break;
		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!");
			include "login_validasi.php"; break;

		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("Sorry Empty Page!");
			include "login_out.php"; break;

		case 'Halaman-Utama' :
			if(!file_exists ("main.php")) die ("Sorry Empty Page!");
			include "main.php";	 break;

		# DATA PASSWORD
		case 'Password-Admin' :
			if(!file_exists ("password_admin.php")) die ("Sorry Empty Page!");
			include "password_admin.php"; break;

		# DATA PROVINSI
		case 'Provinsi-Data' :
			if(!file_exists ("provinsi_data.php")) die ("Sorry Empty Page!");
			include "provinsi_data.php"; break;
		case 'Provinsi-Add' :
			if(!file_exists ("provinsi_add.php")) die ("Sorry Empty Page!");
			include "provinsi_add.php"; break;
		case 'Provinsi-Delete' :
			if(!file_exists ("provinsi_delete.php")) die ("Sorry Empty Page!");
			include "provinsi_delete.php"; break;
		case 'Provinsi-Edit' :
			if(!file_exists ("provinsi_edit.php")) die ("Sorry Empty Page!");
			include "provinsi_edit.php"; break;

		#DATA TIKI
		case 'Tiki-Add' : if (! file_exists("tiki_add.php")) die("Sorry Empty Page !");
				include "tiki_add.php"; break;
		case 'Tiki-Data' : if(! file_exists("tiki_data.php")) die("Sorry Empty Page !");
				include "tiki_data.php"; break;
		case 'Tiki-Edit':if (! file_exists("tiki_edit.php")) die("Sorry Empty page");
				include "tiki_edit.php";	break;
		case 'Tiki-Delete':if (! file_exists("tiki_delete.php")) die("Sorry Empty Page");
				include "tiki_delete.php"; break;

	#DATA BRAND
	case 'Brand-Add':
		if (!file_exists("brand_add.php")) die("Sorry Empty Page !");
		include "brand_add.php"; break;
		break;
	case 'Brand-Data':
		if(!file_exists("brand_data.php")) die("Sorry Empty Page !");
		include "brand_data.php";  break;

	case 'Brand-Delete':
		if (!file_exists("brand_delete.php")) die("Sorry Empty Page");
			include "brand_delete.php"; break;

        #DATA PROV
        case 'Prov-Data': if(!file_exists("prov_data.php")) die ("Sorry Empty Page");
                include "prov_data.php"; break;
        case'Prov-Add':if(!file_exists("prov_add.php"))die ("Sorry Empty page");
                include "prov_add.php"; break;
        case 'Prov-Edit':if(!file_exists("prov_edit.php")) die ("Sorry Empty Page");
                include "prov_edit.php"; break;
        case 'Prov-Delete':if(!file_exists("prov_delete.php"))die("Sorry Empty Page");
                include "prov_delete.php"; break;

		#DATA KOTA
		case 'Kota-Data':
				if(!file_exists("kota_data.php")) die("Sorry Empty Page");
				include "kota_data.php"; 	break;

		case 'Kota-Add':
				if (!file_exists("kota_add.php")) die("Sorry Empty Page");
				include "kota_add.php";
				break;

		case 'Kota-Edit':
				if (!file_exists("kota_edit.php")) die("Sorry Empty Page");
				include "kota_edit.php";	break;

		case 'Kota-Delete':
			if (!file_exists("kota_delete.php")) die("Sorry Empty Page");
				include "kota_delete.php"; break;
        
      #DATA PERUSAHAAN
        case 'Perusahaan-Add':
            if(!file_exists("perusahaan_add.php")) die ("Sorry Halaman Tidak ada ");
                include "perusahaan_add.php"; break;
        
        
    #DATA SLIDE
        case 'Slide-Add' :
            if(!file_exists("slide_add.php")) die("Sorry Empty Page");
                include "slide_add.php"; break;
        case 'Slide-Data' :
            if(!file_exists("slide_data.php")) die("Empty data slide");
                include "slide_data.php"; break;

		#DATA KECAMATAN
		case 'Kecamatan-Data':
			if (!file_exists("kecamatan_data.php")) die ("Sorry Empty Page");
				include "kecamatan_data.php";	break;

		case 'Kecamatan-Add':
			if (!file_exists("kecamatan_add.php")) die("Sorry Empty Page");
			include "kecamatan_add.php"; break;

		case 'kecamatan-edit':
			if (!file_exists("kecamatan_edit.php")) die("Sorry Empty Page");
			include "kecamatan_edit.php"; 	break;

		case 'Kecamatan-Delete':
			if (!file_exists("kecamatan_delete.php")) die("Sorry Empty Page");
			include "kecamatan_delete.php";
			break;



		# DATA KATEGORI
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("Sorry Empty Page!");
			include "kategori_data.php"; break;
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die ("Sorry Empty Page!");
			include "kategori_add.php";	 break;
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die ("Sorry Empty Page!");
			include "kategori_delete.php"; break;
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die ("Sorry Empty Page!");
			include "kategori_edit.php"; break;

		# DATA BARANG
		case 'Barang-Data':
			if(!file_exists ("barang_data.php")) die ("Sorry Empty Page!");
			include "barang_data.php"; break;
		case 'Barang-Add':
			if(!file_exists ("barang_add.php")) die ("Sorry Empty Page!");
			include "barang_add.php"; break;
		case 'Barang-Delete':
			if(!file_exists ("barang_delete.php")) die ("Sorry Empty Page!");
			include "barang_delete.php"; break;
		case 'Barang-Edit':
			if(!file_exists ("barang_edit.php")) die ("Sorry Empty Page!");
			include "barang_edit.php"; break;


		# PELANGGAN
		case 'Pelanggan-Data' :
			if(!file_exists ("pelanggan_data.php")) die ("Sorry Empty Page!");
			include "pelanggan_data.php"; break;
		case 'Pelanggan-Delete' :
			if(!file_exists ("pelanggan_delete.php")) die ("Sorry Empty Page!");
			include "pelanggan_delete.php"; break;

		# DATA
		case 'Konfirmasi-Transfer' :
			if(!file_exists ("konfirmasi_transfer.php")) die ("Sorry Empty Page!");
			include "konfirmasi_transfer.php"; break;
		case 'Konfirmasi-Delete' :
			if(!file_exists ("konfirmasi_delete.php")) die ("Sorry Empty Page!");
			include "konfirmasi_delete.php"; break;

		# ADMIN PEMESANAN
		case 'Pemesanan-Barang' :
			if(!file_exists ("pemesanan_tampil.php")) die ("Sorry Empty Page!");
			include "pemesanan_tampil.php"; break;
		case 'Pemesanan-Lihat' :
			if(!file_exists ("pemesanan_lihat.php")) die ("Sorry Empty Page!");
			include "pemesanan_lihat.php"; break;
		case 'Pemesanan-Bayar' :
			if(!file_exists ("pemesanan_bayar.php")) die ("Sorry Empty Page!");
			include "pemesanan_bayar.php"; break;

		# MASTER DATA
		case 'Laporan' :
			if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!");
				include "menu_laporan.php";	break;

			# INFORMASI DAN LAPORAN
			case 'Laporan-Provinsi' :
				if(!file_exists ("laporan_provinsi.php")) die ("Sorry Empty Page!");
				include "laporan_provinsi.php"; break;

			case 'Laporan-Kategori' :
				if(!file_exists ("laporan_kategori.php")) die ("Sorry Empty Page!");
				include "laporan_kategori.php"; break;

			case 'Laporan-Barang' :
				if(!file_exists ("laporan_barang.php")) die ("Sorry Empty Page!");
				include "laporan_barang.php"; break;

			case 'Laporan-Pelanggan' :
				if(!file_exists ("laporan_pelanggan.php")) die ("Sorry Empty Page!");
				include "laporan_pelanggan.php"; break;

			case 'Laporan-Pemesanan-Periode' :
				if(!file_exists ("laporan_pemesanan_periode.php")) die ("Sorry Empty Page!");
				include "laporan_pemesanan_periode.php"; break;

			case 'Laporan-Pemesanan-Lunas-Periode' :
				if(!file_exists ("laporan_pemesanan_lunas_periode.php")) die ("Sorry Empty Page!");
				include "laporan_pemesanan_lunas_periode.php"; break;

			case 'Laporan-Pemesanan-Lunas-Tanggal' :
				if(!file_exists ("laporan_pemesanan_lunas_tanggal.php")) die ("Sorry Empty Page!");
				include "laporan_pemesanan_lunas_tanggal.php"; break;

		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!");
			include "main.php";	 break;
	}
}
else {
	if(!file_exists ("main.php")) die ("Empty Main Page!");
			include "main.php";	 //break;
}
?>
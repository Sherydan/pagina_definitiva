Veritrans VT-Web in PHP
===========================

Un ejemplo sencillo de implementar VT - sitio con PHP .

### Modo de empleo
1. Descargar todos los archivos de este repositorio, colocarlo en el servidor (por ejemplo: la carpeta htdocs, si utiliza XAMPP o MAMP).
2. Cambiar la configuración de `` key` servidor de archivos de acuerdo con checkout_process.php` existente en el Portal de proveedores Administración (MAP) en la página Configuración >> Teclas de acceso.
3. Hecho. Checkout.html abierto del navegador.


### Alerta de manejar
Notification_handler.php` archivo es un script de ejemplo para manejar HTTP notificación (POST) enviado por el servidor a servidor Veritrans comerciante. Ajuste la dirección de punto final servidor del comerciante al que enviar la notificación HTTP (POST) en el Portal de la Administración mercante (MAPA) en la página web-VT Ajustes >> Preferencias.


### Production Environment
Si ha completado las pruebas y está listo para ir a vivir en el entorno de producción, hay una cosa que hay que garantizar:

Pase el ratón archivo de configuración `` $ endpoint` en checkout_process.php` a:

  ```
  https://api.veritrans.co.id/v2/charge
  ```
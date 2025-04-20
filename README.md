# Ambiente-Web-Cliente-Servidor
GUÍA RÁPIDA DE INSTALACIÓN - FINAL (XAMPP PUERTO 3315)
1. Cambiar el puerto de XAMPP a 3315:
Abre XAMPP, ve a Apache > Config > httpd.conf. Cambia:
Listen 80 → Listen 3315
ServerName localhost:80 → ServerName localhost:3315
Guarda y reinicia Apache.

2. Copiar el proyecto:
Copia la carpeta final en C:\xampp\htdocs\.

3. Importar la base de datos:
Abre http://localhost:3315/phpmyadmin, crea una base de datos llamada proyecto, ve a la pestaña "Importar" y sube el archivo .sql del proyecto.

4. Instalar PHPMailer:
Descarga PHPMailer desde GitHub y copia la carpeta PHPMailer dentro de C:\xampp\htdocs\final\includes\PHPMailer.
5. Acceder a la app:
Abre http://localhost:3315/final/ en tu navegador.

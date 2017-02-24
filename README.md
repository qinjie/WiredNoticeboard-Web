# WiredNoticeboard-Web

##Installation Instruction

1. If you use remote server, SSH to server;
2. Go to ```/var/www/html``` (Root directory of Apache);
  * For a local server go to the document root of XAMPP/MAMP/LAMP (Named ```htdocs```);
3. Run ```git clone https://github.com/qinjie/WiredNoticeboard-Web.git```;
5. Go to WiredNoticeboard-Web folder;
6. Run ```php init```;
7. Run ```chmod -R 777 api/runtime api/web/assets backend/runtime backend/web/assets frontend/runtime frontend/web/assets console/runtime```, to allow temporary folders be writable;
8. Config database in file in ```common/config/mail-local.php```;
9. Run ```composer install``` to install all the library;

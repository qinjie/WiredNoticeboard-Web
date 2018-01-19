# WiredNoticeboard-Web

##Installation Instruction

1. If you use remote server, SSH to server;
2. Go to ```/var/www/html``` (Root directory of Apache);
    * For a local server go to the document root of XAMPP/MAMP/LAMP (Named ```htdocs```);
3. Run ```git clone https://github.com/qinjie/WiredNoticeboard-Web.git```;
5. Go to WiredNoticeboard folder;
6. Database are configured in 
    * ```environments/dev/common/config/main-local.php```
    * ```environments/dev/common/config/params-local.php```
    * ```environments/prod/common/config/main-local.php```
    * ```environments/prod/common/config/params-local.php```    
7. Run ```php init``` to initialize environment
8. Run ```chmod -R 777 api/runtime api/web/assets``` to allow temporary folders be writable;
9. Run ```chmod -R 777 uploads``` to allow upload folders be writable;
10. Run ```composer install``` to install all the library;


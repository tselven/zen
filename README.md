***AstroSpark Framework***

AstroSpark is a PHP Framework for develop APIs and Web Applications.

**To Run This Application**
1. Use composser to create project
```
composer create-project tselven/astro-spark your-project
```
2. Run it by using inbuild cli
```
php cli serve
```
3. create controller
```
php cli -m -c [name]
```

```
Note : this project use routing that based on url so its require to be run as root project,
insted of usual xampp sub url format  

Wrong : http://localhost:8080/your-project 
Correct : http://localhost:8080/
```

```php
<?php
require_once "autoload.php";
use Core\Router;
$uri =  $_SERVER["REQUEST_URI"];
$router = new Router();
$router->load('web.json');
$router->load('api.json');
$router->route($uri);
```

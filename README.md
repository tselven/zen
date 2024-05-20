***AstroSpark Framework***

AstroSpark is a PHP Framework for develop APIs and Web Applications.

**To Run This Application**
1. First clone this repository.
2. Copy and paste the Files & Folders in the Project folder to in site your server(XAMPP) htdocs folder.
3. Create the database with tha name of snart_trips.
4. Import the database by using the .sql file in the project directory.
5. Start the Apache server & mysql server (if not already running).
6. Browse the root url of your localhost  
Ex: http://localhost  or  http://localhost:8080
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

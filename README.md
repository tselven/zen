***AstroSpark Framework***  

![Github Created At](https://img.shields.io/github/created-at/Syntax-Squad/AstroSpark) &nbsp;
![GitHub Release](https://img.shields.io/github/v/release/Syntax-Squad/AstroSpark) &nbsp;
![GitHub Release Date](https://img.shields.io/github/release-date/Syntax-Squad/AstroSpark)
&nbsp;
![GitHub Repo stars](https://img.shields.io/github/stars/Syntax-Squad/AstroSpark)
&nbsp;
![Packagist Downloads](https://img.shields.io/packagist/dt/syntax-squad/astro-spark)


Zen is a PHP Framework for develop APIs and Web Applications.

**To Run This Application**
1. Use composser to create project
```
composer create-project tselven/zen your-project
```

### Project Folder Structure.
```
├───.github
│   └───ISSUE_TEMPLATE
├───.vscode
├───assets
│   └───images
│       └───favicons
├───cache
├───controller
│   └───API
├───core
│   ├───Enums
│   ├───Interface
│   └───view
├───models
├───public
├───Routes
├───scripts
└───views
    └───Errors
```
2. Run it by using inbuild cli
```
php astro serve
```
3. create controller
```
php astro -m -c [name]
```

```
Note : this project use routing that based on url so its require to be run as root project,
insted of usual xampp sub url format  

Wrong : http://localhost:8080/your-project 
Correct : http://localhost:8080/
```

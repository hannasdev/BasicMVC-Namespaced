Basic MVC
=========

Based on the MVC in these tutorials: https://www.youtube.com/watch?v=-Vkl3spgDUM&list=PL8931096D81D44C4E

## Author ##
- Author: Hanna Söderström
- E-mail: info@hannasoderstrom.com

## Routing ##
*Controller* and *Method* is loaded automatically from the URI. By default (if
    the URI is at the root, "/") they are set to:
- IndexController{ }
- index( )

## Controllers ##
BaseController - Abstract class that loads the classes *Registry* and *Load*.
- **Registry** is a Singleton used for handling global variables within the application.
- **Load** is used to load Views and Models inside the Controller.

## Database ##
The class Database is written by the Author and it has several helper-methods to make the process of writing queries easier.

## PSR-4 compliant ##
The folder-structure and naming conventions with the namespace **BasicMVC** follows the PSR-4 specifications and its recommended to use the Composer autoloader (which is pre-configured in public/index.php).

Basic MVC
=========

Based on the MVC in these tutorials: https://www.youtube.com/watch?v=-Vkl3spgDUM&list=PL8931096D81D44C4E

## Author ##
- Author: Hanna Söderström
- E-mail: info@hannasoderstrom.com

## Usage ##
*Controller* and *Method* is loaded automatically from the URI. By default (if
    the URI is at the root) these are "IndexController" and the "index"-method.

## Controllers ##
BaseController - Abstract class that loads the classes Registry and Load.
**Registry** is a Singleton used for handling global variables within the application.
**Load** is used to load Views and Models inside the Controller.

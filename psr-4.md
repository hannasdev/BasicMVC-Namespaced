PSR-4 Autoloading
=================

## Source ##
Tutorial: https://www.youtube.com/watch?v=VGSerlMoIrY
Specification: http://www.php-fig.org/psr/psr-4/

## File Structure ##
```
project-root-folder/
  composer.json
  vendor/
    composer/
  application-name/
    models/
    controllers/
    public/
      css/
```

## Namespace ##
```php
namespace Application\Folder;
```

## Usage ##
Inside of the Class at the very top (but after Namespace)
```php
use Author\Application\Folder;
```

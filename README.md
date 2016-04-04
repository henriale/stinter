# stinter

A plan/resource auditor for Laravel.

### Installing

1 - Firstly, place the package into your project using composer:

```bash
$ composer require henriale/stinter
$ composer composer update
```

2 - Then, create a `/config/stinters.php` file or just publish it with the following command:

```bash
$ php artisan vendor:publish --provider="Henriale\Stinter\StintServiceProvider"
```

### Getting Started

1 - Create a restriction/stint class to control your resources:
```bash
$ php artisan make:stint CreateProduct
```

2 - Make some validation with it
```php
class CreateProduct extends Stinter
{
  protected $basicPlanLimitation = 10;
  
  public function check(Authenticatable $user)
  {
      if ($user->products()->count() >= $this->basicPlanLimitation) {
        // user has too many products
        return false;
      }
      
      //user still can have more products
      return true;
  }
}
```

3 - Now, register in `/config/stinters.php` so the auditor can check it when triggered
```php
return [
    \App\Stinters\CreateProduct::class
];
```


4 - Finally, use `\Gate` class passing the stint FQN to handle its permission:
```php
<!-- using User model -->
<?php
if ($user->can(\App\Stinters\CreateProduct::class)) {
  echo 'yes, he is able';
}
?>

<!-- using Gate -->
<?php
$userCan = \Gate::allows(\App\Stinters\CreateProduct::class);
if ($userCan) {
  echo "user can create more stuffs";
} else {
  echo "user cannot create more stuffs. he better upgrade his plan/subscription!";
} 
?>

<!-- using blade -->
@can(\App\Stinters\CreateProduct::class)
  // can
@else
  // cannot
@endcan
```




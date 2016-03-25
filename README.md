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
$ php artisan make:stint CreateSomething
```

2 - Make some validation with it
```php
class CreateSomething extends Stinter
{
  public function check(Authenticatable $user)
  {
      $basicPlanLimitation = 10;
      
      if ($user->something()->count() >= $basicPlanLimitation) {
        // user has too many
        return false;
      }
      
      //user still can have more
      return true;
  }
}
```

3 - Now, register in `/config/stinters.php` so the auditor can check it when triggered
```php
return [
    \App\Stinters\CreateSomething::class
];
```


4 - Finally, use `\Gate` class passing the stint FQN to handle its permission:
```php
<?php
$userCan = \Gate::allows(\App\Stinters\CreateSomething::class);
if ($userCan) {
  echo "user can create more stuffs";
} else {
  echo "user cannot create more stuffs. he better upgrade his plan/subscription!";
} 
?>

<!-- using blade -->
@can(\App\Stinters\CreateSomething::class)
  // can
@else
  // cannot
@endcan
```




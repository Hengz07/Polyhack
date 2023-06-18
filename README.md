# Minimum Requirement
 - PHP 7.4.x
 - Laravel 8.x

## Installation Guide

Enter to your webroot folder and run 
 - composer install
 - composer require apereo/phpcas:1.3.8

### Create new database

Create your database

### Environment Configuration
 - cp .env.example .env
 - php artisan key:generate
 - Edit .env file and change database configuration username, password and database name

## Artisan Migration

 - php artisan migrate --seed

## Dump autoload
 - composer dump-autoload

### Default user

Username : admin1@polyhack2023.com
Password : abcd1234

### model
```php
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
class Example extends Model
{
    use Uuid;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
```


# CODE

### create function 
```php
protected $baseView = '';

/**
 * Display a booking setup page.
 * 
 * @return Renderable
 */
public function functionname() {
    return $this->view([$this->baseView, 'viewfile'])->with('title', __('page.title'));
}
```

### Template when create new blade file
```php
@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>{{ $title }}</h1></div>
</div>
@stop

@section('content')
<div class="container-fluid"></div>
@endsection
```
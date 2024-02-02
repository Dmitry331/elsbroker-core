Общие классы проектов Статистика и ЛК
=====================================
Модельки, миграции, сервисы, модули

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dmitry331/elsbroker-core "*"
```

or add

```
"dmitry331/elsbroker-core": "*"
```

to the require section of your `composer.json` file.

##Миграции

```
php yii migrate --migrationPath=@core/migrations
```

##В классах указываем *namespace*
```
<?php

namespace core\models;
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \core\AutoloadExample::widget(); ?>```
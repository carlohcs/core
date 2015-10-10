#Models

Common models for common applications.

##Table of contents

- [Account](./Account) - You can create and manipulate users with this
- [Address](./Address) - You can create and manipulate users address with this 
- [Avatar](./Avatar) - You can set and save users avatars
- [Email](./Email) - You can create and manipulate users emails with this 

...You can create more Models and push to project. Please, collabore with it!


##Basic Usage

##Account - Create and manipulate a account

```php
<?php

//Get the container from this repository
require __DIR__.'/../../bootstrap/container.php';

//Uses
use Carlohcs\Core\Models\Account\AccountModel;
use Faker\Factory as FakerFactory;

//Create the Faker object and set the providers
$faker = FakerFactory::create();

$faker->addProvider(new \Faker\Provider\Lorem($faker));
$faker->addProvider(new \Faker\Provider\Person($faker));
$faker->addProvider(new \Faker\Provider\DateTime($faker));
$faker->addProvider(new \Faker\Provider\Internet($faker));

//Generate random data
$name = $faker->name;
$login = $faker->email;
$password = $faker->password;

//Create a AccountModel and set the data
$account = new AccountModel();
$account->setName($name);
$account->setLogin($login);
$account->setNickname($name);
$account->setPassword($password);

//Get the entityManager service from container
$entityManager = $container['entityManager'];

//Persist
$entityManager->persist($account);
$entityManager->flush();
```

You can see better executing the tests in this [file](../../tests/Models/AccountModelTest.php).

##Running tests

1. **Configure the file /var/www/folder-to-your-project/vendor/carlohcs/core/config/storage.php with the your custom settings.**
2. In terminal:

```
$ cd /var/www/folder-to-your-project/vendor/carlohcs/core/tests
$ phpunit -c phpunit.xml --testsuite Core
```

##Exporting models to schemas

If you has tired to create *tables* manually to your application, forget this! You can create the your own models and export to your database system with some steps.

Follow this steps:

1. **Configure the file /var/www/folder-to-your-project/vendor/carlohcs/core/config/storage.php with the your custom settings.**
2. In terminal:

```
$ cd /var/www/folder-to-your-project/
$ vendor/bin/doctrine orm:schema-tool:create --force
```

Done! All tables will be created in your sistem.

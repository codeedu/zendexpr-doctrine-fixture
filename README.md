[![Build Status](https://travis-ci.org/codeedu/zendexpr-doctrine-fixture.svg?branch=master)](https://travis-ci.org/codeedu/zendexpr-doctrine-fixture)

## About

This library provides integration with Zend Expressive and Doctrine Data Fixture. Also support PSR-11.


## Get started

##### Instalation
```sh
composer require codeedu/zendexpr-doctrine-fixture:0.0.1
```

##### Registering Fixtures

To register fixtures add the fixtures in your configuration.

```php
[
      'doctrine' => [
            'fixture' => [
                  'MyFixtures' => __DIR__ . '/../src/Fixture',
            ]
      ]
];
```

Register factory to create the command:

```php
[
      'factories' => [
         'doctrine:fixtures_cmd:load'   => \CodeEdu\FixtureFactory::class
      ]
];
```

We suggest to configure Doctrine ORM and commands with Zend Expressive using this [gist](https://gist.github.com/argentinaluiz/a14df7b1ef73cc111b280e417f84ba92).
This configuration uses [DoctrineModule](https://github.com/doctrine/DoctrineModule). DoctrineModule provides easily configuration to integration Doctrine ORM in
Zend Framework 2 Applications, so the approach is enjoy it.

Now in **doctrine.config.php**, so add **doctrine:fixtures_cmd:load** to:
 ```php
 $command = [
    //.....,
    'doctrine:fixtures_cmd:load'
 ];
 ```

## Usage

#### Command Line
Access the Doctrine command line as following

#### Import
```sh
./vendor/bin/doctrine-module data-fixture:import
```

## Dependency Injection with Fixtures

This library provides inject the service container in fixtures. So add interface **FixtureContainerInterface**, see below:

```php
class MyFixture implements FixtureInterface, FixtureContainerInterface
{
    private $container;

    public function load(ObjectManager $manager){
        $myService = $this->container->get(MyService::class);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
```

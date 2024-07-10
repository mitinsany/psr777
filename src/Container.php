<?php

declare(strict_types=1);

namespace App;

use App\Providers\ServiceProviderInterface;
use ReflectionClass;

class Container
{
    private array $objects = [];
    private array $binded = [];

    public function __construct(string $config = __DIR__ . '/../config/app.php')
    {
        $config = require_once $config;
        if (!is_array($config)) {
            return;
        }
        foreach ($config['providers'] as $providerClass) {
            /** @var ServiceProviderInterface $provider */
            $provider = $this->get($providerClass);
            $provider->register($this);
        }
    }

    public function has(string $id): bool
    {
        return isset($this->objects[$id]) || class_exists($id);
    }

    public function get(string $id)
    {
        //return isset($this->objects[$id]) ? $this->objects[$id]() : $this->prepareObject($id);
        if (empty($this->objects[$id])) {
            $this->objects[$id] = $this->prepareObject($id);
        }
        return $this->objects[$id];
    }

    private function prepareObject(string $class): object
    {
        if ($class === __CLASS__) {
            return $this;
        }
        if (!empty($this->binded[$class])) {
            return $this->binded[$class]();
        }

        $classReflector = new ReflectionClass($class);

        // Получаем рефлектор конструктора класса, проверяем - есть ли конструктор
        // Если конструктора нет - сразу возвращаем экземпляр класса
        $constructReflector = $classReflector->getConstructor();
        if (empty($constructReflector)) {
            return new $class();
        }

        // Получаем рефлекторы аргументов конструктора
        // Если аргументов нет - сразу возвращаем экземпляр класса
        $constructArguments = $constructReflector->getParameters();
        if (empty($constructArguments)) {
            return new $class();
        }

        // Перебираем все аргументы конструктора, собираем их значения
        $args = [];
        foreach ($constructArguments as $argument) {
            // Получаем тип аргумента
            $argumentType = $argument->getType()->getName();
            // Получаем сам аргумент по его типу из контейнера
            //$args[$argument->getName()] = $this->get($argumentType);
            if (in_array($argumentType, ['string', 'int'])) {
                var_dump($argument);
                $args[] = $argument->getDefaultValue();
            }/* elseif (interface_exists($argumentType)) {
                //$args[] = $argument->getDefaultValue();
                $args[] = $this->get($argumentType);
            }*/ else {
                $args[] = $this->get($argumentType);
}
        }

        // И возвращаем экземпляр класса со всеми зависимостями

        return new $class(...$args);
    }

    public function bind(string $abstract, callable $fn): void
    {
        $this->binded[$abstract] = $fn;
    }
}

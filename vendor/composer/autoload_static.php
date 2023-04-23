<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd188c509e4012c5bc27ef2abfbfc3269
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Dotenv\\' => 25,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dotenv',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Controller\\GenericController' => __DIR__ . '/../..' . '/src/Controller/GenericController.php',
        'App\\Crud\\GenericCrud' => __DIR__ . '/../..' . '/src/Crud/GenericCrud.php',
        'App\\config\\SinglePdo' => __DIR__ . '/../..' . '/src/config/SinglePdo.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Symfony\\Component\\Dotenv\\Command\\DebugCommand' => __DIR__ . '/..' . '/symfony/dotenv/Command/DebugCommand.php',
        'Symfony\\Component\\Dotenv\\Command\\DotenvDumpCommand' => __DIR__ . '/..' . '/symfony/dotenv/Command/DotenvDumpCommand.php',
        'Symfony\\Component\\Dotenv\\Dotenv' => __DIR__ . '/..' . '/symfony/dotenv/Dotenv.php',
        'Symfony\\Component\\Dotenv\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/symfony/dotenv/Exception/ExceptionInterface.php',
        'Symfony\\Component\\Dotenv\\Exception\\FormatException' => __DIR__ . '/..' . '/symfony/dotenv/Exception/FormatException.php',
        'Symfony\\Component\\Dotenv\\Exception\\FormatExceptionContext' => __DIR__ . '/..' . '/symfony/dotenv/Exception/FormatExceptionContext.php',
        'Symfony\\Component\\Dotenv\\Exception\\PathException' => __DIR__ . '/..' . '/symfony/dotenv/Exception/PathException.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd188c509e4012c5bc27ef2abfbfc3269::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd188c509e4012c5bc27ef2abfbfc3269::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd188c509e4012c5bc27ef2abfbfc3269::$classMap;

        }, null, ClassLoader::class);
    }
}

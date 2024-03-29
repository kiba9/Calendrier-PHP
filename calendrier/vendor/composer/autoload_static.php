<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaba4bfba8093cccffe91bb9b3182d657
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Date\\' => 9,
            'App\\App\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Date\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Date',
        ),
        'App\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaba4bfba8093cccffe91bb9b3182d657::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaba4bfba8093cccffe91bb9b3182d657::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

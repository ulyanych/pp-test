<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc5ca1cc53dfeccb4c103d969272af8a9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc5ca1cc53dfeccb4c103d969272af8a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc5ca1cc53dfeccb4c103d969272af8a9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

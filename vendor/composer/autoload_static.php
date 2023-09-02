<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita713a316fb10857c223fbb89ab26d200
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ruma\\CrudKit\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ruma\\CrudKit\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita713a316fb10857c223fbb89ab26d200::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita713a316fb10857c223fbb89ab26d200::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita713a316fb10857c223fbb89ab26d200::$classMap;

        }, null, ClassLoader::class);
    }
}

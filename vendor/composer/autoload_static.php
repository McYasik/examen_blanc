<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba7262f87ba86fee1020d9d8e0469e54
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitba7262f87ba86fee1020d9d8e0469e54::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba7262f87ba86fee1020d9d8e0469e54::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitba7262f87ba86fee1020d9d8e0469e54::$classMap;

        }, null, ClassLoader::class);
    }
}

<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteabc78ecc2f41e12582653ea5538f747
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Moment\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Moment\\' => 
        array (
            0 => __DIR__ . '/..' . '/fightbulc/moment/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteabc78ecc2f41e12582653ea5538f747::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteabc78ecc2f41e12582653ea5538f747::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

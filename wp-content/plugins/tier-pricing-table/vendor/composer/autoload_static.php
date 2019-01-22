<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit13156cd077b85c60f55232387c28ad0c
{
    public static $files = array (
        'd53b58ed9a9b116ebe1fc8612e04d090' => __DIR__ . '/../..' . '/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TierPricingTable\\' => 17,
        ),
        'P' => 
        array (
            'Premmerce\\SDK\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TierPricingTable\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Premmerce\\SDK\\' => 
        array (
            0 => __DIR__ . '/..' . '/premmerce/wordpress-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit13156cd077b85c60f55232387c28ad0c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit13156cd077b85c60f55232387c28ad0c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

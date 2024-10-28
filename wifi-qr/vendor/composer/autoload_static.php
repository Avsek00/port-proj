<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite3e994ce062b5f292380a438bf501d0a
{
    public static $files = array (
        'a9ed0d27b5a698798a89181429f162c5' => __DIR__ . '/..' . '/khanamiryan/qrcode-detector-decoder/lib/Common/customFunctions.php',
        '74f78b6b99713ff89d56028b614df71a' => __DIR__ . '/..' . '/libern/qr-code-reader/src/lib/common/customFunctions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zxing\\' => 6,
        ),
        'L' => 
        array (
            'Libern\\QRCodeReader\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zxing\\' => 
        array (
            0 => __DIR__ . '/..' . '/khanamiryan/qrcode-detector-decoder/lib',
            1 => __DIR__ . '/..' . '/libern/qr-code-reader/src/lib',
        ),
        'Libern\\QRCodeReader\\' => 
        array (
            0 => __DIR__ . '/..' . '/libern/qr-code-reader/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite3e994ce062b5f292380a438bf501d0a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite3e994ce062b5f292380a438bf501d0a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite3e994ce062b5f292380a438bf501d0a::$classMap;

        }, null, ClassLoader::class);
    }
}
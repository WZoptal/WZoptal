<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6fb48b692bd654adb3eba16efba353a2
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Cache\\' => 10,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
            'Grpc\\Gcp\\' => 9,
            'Grpc\\' => 5,
            'Google\\Protobuf\\' => 16,
            'Google\\Cloud\\PubSub\\' => 20,
            'Google\\Cloud\\Core\\' => 18,
            'Google\\Auth\\' => 12,
            'Google\\ApiCore\\' => 15,
            'Google\\' => 7,
            'GPBMetadata\\Google\\Pubsub\\' => 26,
            'GPBMetadata\\Google\\Protobuf\\' => 28,
            'GPBMetadata\\Google\\' => 19,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Grpc\\Gcp\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/grpc-gcp/src',
        ),
        'Grpc\\' => 
        array (
            0 => __DIR__ . '/..' . '/grpc/grpc/src/lib',
        ),
        'Google\\Protobuf\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/protobuf/src/Google/Protobuf',
        ),
        'Google\\Cloud\\PubSub\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/cloud-pubsub/src',
        ),
        'Google\\Cloud\\Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/cloud-core/src',
        ),
        'Google\\Auth\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/auth/src',
        ),
        'Google\\ApiCore\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/gax/src',
        ),
        'Google\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/common-protos/src',
        ),
        'GPBMetadata\\Google\\Pubsub\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/cloud-pubsub/metadata',
        ),
        'GPBMetadata\\Google\\Protobuf\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/protobuf/src/GPBMetadata/Google/Protobuf',
        ),
        'GPBMetadata\\Google\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/common-protos/metadata',
            1 => __DIR__ . '/..' . '/google/gax/metadata',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/google/grpc-gcp/src/generated',
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rize\\UriTemplate' => 
            array (
                0 => __DIR__ . '/..' . '/rize/uri-template/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6fb48b692bd654adb3eba16efba353a2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6fb48b692bd654adb3eba16efba353a2::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit6fb48b692bd654adb3eba16efba353a2::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6fb48b692bd654adb3eba16efba353a2::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}

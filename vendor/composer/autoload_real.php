<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd91fa33166ad7153ecfbb8e4f2d4f11c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitd91fa33166ad7153ecfbb8e4f2d4f11c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd91fa33166ad7153ecfbb8e4f2d4f11c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd91fa33166ad7153ecfbb8e4f2d4f11c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}

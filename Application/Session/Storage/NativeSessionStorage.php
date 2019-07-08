<?php
declare(strict_types=1);

namespace Application\Session\Storage;

use \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage as SymfonyNativeSessionStorage;

/**
 *  |-------------------------------------------------------------------
 *  |   ACCESS CONTROL
 *  |-------------------------------------------------------------------
 *  |
 *  |   We don't allow direct access to files other than "index.php".
 */
if(!defined('APP_START')) {
    exit("Access denied.");
}

/**
 *  NATIVE SESSION STORAGE CLASS
 *  @since v1.0.0
 *
 *  @see \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage
 */
final class NativeSessionStorage extends SymfonyNativeSessionStorage {

    /**
     *  Clean
     *  @since v1.0.0
     *
     *  @return void
     */
    public function clean() : void {
        $this->getSaveHandler()
            ->getHandler()
            ->clean();
    }

}
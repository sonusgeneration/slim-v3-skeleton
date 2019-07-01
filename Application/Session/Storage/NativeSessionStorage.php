<?php
declare(strict_types=1);

namespace Application\Session\Storage;

use \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage as SymfonyNativeSessionStorage;

# Verify access control...
if(!defined('APP_START')) {
    exit("Access denied.");
}

final class NativeSessionStorage extends SymfonyNativeSessionStorage {

    public function clean() {
        $this->getSaveHandler()
            ->getHandler()
            ->clean();
    }

}
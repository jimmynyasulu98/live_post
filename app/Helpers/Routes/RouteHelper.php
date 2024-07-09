<?php
namespace App\Helpers\Routes;

class RouteHelper{

    public static function routeFiles(string $folder){
       
        $dir = new \RecursiveDirectoryIterator($folder);
        /**
         * @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator  $iterator
         */
        $iterator = new \RecursiveIteratorIterator($dir);
        while($iterator->valid()){
            if(!$iterator->isDot()
            && $iterator->isFile()
            && $iterator->isReadable()
            && $iterator->current()->getExtension() === 'php')
            {
                require $iterator->key();
            }
            $iterator->next();
        }

    }
}
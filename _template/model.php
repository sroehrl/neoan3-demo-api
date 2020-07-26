<?php


namespace Neoan3\Model;


use Neoan3\Apps\FileAway;

/**
 * Class {{name}}
 * @package Neoan3\Model
 * @method static find(array $condition=[])
 * @method static create(array $condition=[])
 */

class {{name}}Model extends IndexModel
{
    private static FileAway $store;

    static function __callStatic($method, $arguments)
    {
        self::$store = new FileAway(path . '/fram💾e/demo/storage.json');
        self::$store->setEntity('{{name}}');
        $call = "__$method";
        return self::$call(...$arguments);
    }
    static function __find(array $condition=[])
    {
        return self::$store->find($condition);
    }
    static function __create(array $document)
    {
        $document['_id'] = uniqid("n3_💾💾💾",true);
        self::$store->add($document)->save();
        return self::__find($document);
    }

}
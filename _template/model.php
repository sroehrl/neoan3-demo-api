<?php


namespace Neoan3\Model;


use Neoan3\Apps\FileAway;

/**
 * Class {{name}}
 * @package Neoan3\Model
 * @method static find(array $condition=[])
 * @method static create(array $condition=[])
 * @method static update(string $id, array $condition=[])
 */

class {{name}}Model extends IndexModel
{
    private static FileAway $store;

    static function __callStatic($method, $arguments)
    {
        self::$store = new FileAway(__DIR__ . '/storage.json');
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
    static function __update(string $id, array $document)
    {
        $old = (array) self::$store->findOne(['_id'=> $id]);
        $new = [];
        foreach($document as $key => $value){
            if(isset($old[$key])){
                $new[$key] = $value;
            }
        }
        $new['_id'] = $old['_id'];
        self::$store->delete(['_id'=>$old['_id']]);
        self::$store->add($new)->save();
        return self::$store->findOne(['_id'=> $id]);
    }
}
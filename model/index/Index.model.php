<?php

namespace Neoan3\Model;

use Exception;

class IndexModel
{

    /**
     * @param $ask
     *
     * @return array|mixed
     */
    static function first($ask)
    {
        if (!empty($ask)) {
            return $ask[0];
        } else {
            return [];
        }
    }

    /**
     * @param $modelName
     * @param $deepModel
     *
     * @return array
     */
    static function flatten($modelName, $deepModel)
    {
        $separate = [];
        foreach ($deepModel as $columnOrTable => $value) {
            if (is_array($value)) {
                $separate[$columnOrTable] = $value;
            } else {
                $separate[$modelName][$columnOrTable] = $value;
            }
        }
        return $separate;
    }

    /**
     * @param      $model
     * @param bool $migratePath
     *
     * @return array
     * @throws Exception
     */
    static function getMigrateStructure($model, $migratePath = false)
    {
        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $model . DIRECTORY_SEPARATOR . 'migrate.json';
        if($migratePath){
            $path = $migratePath;
        }
        $structure = [];
        if (file_exists($path)) {
            $pattern = json_decode(file_get_contents($path), true);
            foreach ($pattern as $table => $fields) {
                if ($table !== $model) {
                    $structure[$table] = $fields;
                } else {
                    foreach ($fields as $key => $field) {
                        $structure[$key] = $field;
                    }
                }
            }
            return $structure;
        } else {
            throw new Exception('no migrate json found');
        }
    }
}

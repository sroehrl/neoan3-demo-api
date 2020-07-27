<?php


namespace Neoan3\Components;


use Neoan3\Apps\Stateless;
use Neoan3\Model\{{name.pascal}}Model;

/**
 * Class Test
 * @package Neoan3\Model
 * @method static find(array $condition=[])
 * @method static create(array $condition=[])
 */

class {{name.pascal}} extends \Neoan3\Model\IndexModel
{
    /**
     * GET: api.v1/{{name.kebab}}
     * @param null $id
     * @param array $params
     * @return array
     * @throws \Neoan3\Core\RouteException
     */
    function get{{name.pascal}}($id=null, array $params=[]): array
    {
        Stateless::restrict();
        $result = [];
        if($id){
            $params['_id'] = $id;
            if(!empty($try = {{name.pascal}}Model::find($params))){
                $result = $try[0];
            }
        } else {
            $result = {{name.pascal}}Model::find($params);
        }

        return $result;
    }

    /**
     * POST: api.v1/{{name.kebab}}
     * @param array $body
     * @return array
     * @throws \Neoan3\Core\RouteException
     */
    function post{{name.pascal}}(array $body=[]): array
    {
        Stateless::restrict();
        return  {{name.pascal}}Model::create($body);
    }

    /**
     * PUT: api.v1/{{name.kebab}}
     * @param array $body
     * @param string $id
     * @return array
     * @throws \Neoan3\Core\RouteException
     */
    function put{{name.pascal}}($id=null, array $body=[]): array
    {
        Stateless::restrict();
        return  {{name.pascal}}Model::update($id, $body);
    }
}
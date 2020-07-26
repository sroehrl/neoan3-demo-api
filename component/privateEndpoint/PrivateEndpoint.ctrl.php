<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;

use Neoan3\Apps\Stateless;
use Neoan3\Frame\Demo;
use Neoan3\Model\UserModel;

/**
 * Class PrivateEndpoint
 * @package Neoan3\Components
 */

class PrivateEndpoint extends Demo{
    /**
     * GET: api.v1/private-endpoint
     * @param $count
     * @param array $params
     * @return array
     */
    function getPrivateEndpoint($count=1, array $params=[]): array
    {
        Stateless::restrict();
        $users = [];
        $all = UserModel::find();
        for($i = 0; $i < $count; $i++){
            $users[] = $all[$i];
        }

        return $users;
    }


}
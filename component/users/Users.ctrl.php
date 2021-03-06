<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;

use Neoan3\Apps\FileAway;
use Neoan3\Apps\Ops;
use Neoan3\Apps\Stateless;
use Neoan3\Frame\Demo;
use Neoan3\Model\UserModel;

/**
 * Class Users
 * @package Neoan3\Components
 */

class Users extends Demo{
    /**
     * GET: api.v1/users
     * @param null $id
     * @param array $params
     * @return array
     * @throws \Neoan3\Core\RouteException
     */
    function getUsers($id=null, array $params=[]): array
    {
        $jwt = Stateless::restrict();
        $users = [];
        foreach (UserModel::find() as $user){
            unset($user->password);
            $users[] = $user;
        }
        return [
            'results'=>$users,
            'requestUser' => $jwt['jti']
        ];
    }

    /**
     * POST: api.v1/users
     * @param bool $auth
     * @param array $body
     * @return array
     */
    function postUsers($auth=false, array $body=[]): array
    {
        $user = $auth ? UserModel::login($body) : UserModel::register($body);
        $token = Stateless::assign($user['_id'], ['read', 'write']);
        return [
            'token' => $token,
            'user' => $user
        ];

    }
}

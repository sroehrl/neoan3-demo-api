<?php
/**
 * Created by PhpStorm.
 * User: sroehrl
 * Date: 2/4/2019
 * Time: 1:36 PM
 */

namespace Neoan3\Frame;

use Neoan3\Apps\FileAway;
use Neoan3\Apps\Stateless;
use Neoan3\Core\Serve;

class Demo extends Serve
{
    private string $secret = 'Ohjseh65^%js9486789se';

    function __construct()
    {
        parent::__construct();
        Stateless::setSecret($this->secret);
    }

    function constants()
    {
        return [
            'base' => [base],
            'link' => [
                [
                    'sizes' => '32x32',
                    'type' => 'image/png',
                    'rel' => 'icon',
                    'href' => 'asset/neoan-favicon.png'
                ]
            ],
            'stylesheet' => [
                '' . base . 'frame/demo/demo.css',
            ]
        ];
    }
}

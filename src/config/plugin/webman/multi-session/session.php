<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

return [

    '/admin' => [

        'lifetime' => 7*24*60*60,

        'cookie_lifetime' => 7*24*60*60,

        'http_only' => true,

        'domain' => '',

        'secure' => false,

        'gc_probability' => [1, 1000],

        'same_site' => '',
    ],
    
    '/api' => [

        'lifetime' => 7*24*60*60,

        'cookie_lifetime' => 7*24*60*60,

        'http_only' => true,

        'domain' => '',

        'secure' => false,

        'gc_probability' => [1, 1000],

        'same_site' => '',
    ]
];

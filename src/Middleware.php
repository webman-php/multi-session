<?php
namespace Webman\MultiSession;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use Workerman\Protocols\Http;
use Workerman\Protocols\Http\Session;
use function config;

class Middleware implements MiddlewareInterface
{
    public function process(Request $request, callable $next) : Response
    {
        $configs = config('plugin.webman.multi-session.session');
        $path = $request->path();
        $default = $config = config('session');
        foreach ($configs as $path_prefix => $item) {
            if (strpos($path, $path_prefix) === 0) {
                $config = $item;
                break;
            }
        }
        $map = [
            'cookie_lifetime' => 'cookieLifetime',
            'gc_probability' => 'gcProbability',
            'cookie_path' => 'cookiePath',
            'lifetime' => 'lifetime',
            'http_only' => 'httpOnly',
            'domain' => 'domain',
            'secure' => 'secure',
            'same_site' => 'sameSite',
        ];
        if (!isset($config['session_name'])) {
            $session_name = config('session.session_name', 'PHPSID');
            $app = trim($path_prefix, '/');
            if ($app) {
                $session_name .= '-' . strtoupper(str_replace('/', '-', $app));
            }
        } else {
            $session_name = $config['session_name'];
        }
        Session::$name = $session_name;
        foreach ($map as $key => $name) {
            if (property_exists(Session::class, $name)) {
                Session::${$name} = $config[$key] ?? $default[$key];
            }
        }
        if (!isset($config['cookie_path'])) {
            Session::$cookiePath = $path_prefix;
        }
        return $next($request);
    }
    
}

<?php
namespace TestHugo\Http\Controllers;

use Illuminate\Http\Request;
use TestHugo\Http\Views\View;

class HomeController
{
    /**
     * [index]
     * @param  Request $request
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            echo json_encode(array(
                'success' => true,
                'random_alpha'  => $this->random_string('alpha'),
                'random_numeric'  => $this->random_string('numeric'),
                'random_alnum'  => $this->random_string('alnum')
            ));
        }else{
            $view = new View('home',[]);
            $response = $view->render();
            $response->send();
        }
    }

    /**
     * @param string $type
     * @param int $length
     * @return string
     */
    public function random_string( $type = 'alnum', $length = 6 ){
        switch ( $type ) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }


        $crypto_rand_secure = function ( $min, $max ) {
            $range = $max - $min;
            if ( $range < 0 ) return $min; // not so random...
            $log    = log( $range, 2 );
            $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
            $bits   = (int) $log + 1; // length in bits
            $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ( $rnd >= $range );
            return $min + $rnd;
        };

        $token = "";
        $max   = strlen( $pool );
        for ( $i = 0; $i < $length; $i++ ) {
            $token .= $pool[$crypto_rand_secure( 0, $max )];
        }
        return $token;
    }
}
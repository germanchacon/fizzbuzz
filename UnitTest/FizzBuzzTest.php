<?php
namespace UnitTest;

use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    
    public function request($method, $path, $port, $options = array())
    {
        require_once __DIR__ .'/HttpRest.php';
        // Capture STDOUT
        $headr = array ();
        $headr [] = 'Expect:';
        
        $urlBase = str_replace ( "http://", "", "localhost:".$port."/fizzbuzz/index.php" );
        $data = HttpRest::connect ( $urlBase, $port )->setHeaders ( $headr )->doGet( $path );
        
        return $data;
    }

    public function get($path, $port, $options = array())
    {
        $data = $this->request('GET', $path, $port, $options);
        return $data;
    }

    public function testFizzBuzz($value = 10, $value2= 45, $port = 9080)
    {
        $data = $this->get('/fizzbuzz/'.$value.'/'.$value2.'', $port);
        
        $condition = true;
        if (strpos($data, 'Welcome') !== false) {
            $this->assertTrue(true,$data);
        }else{
            // Return STDOUT
            $this->assertTrue(false, $data);
        }
     }
}
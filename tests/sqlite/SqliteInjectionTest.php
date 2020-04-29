<?php

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../base/DatabaseInjectionTest.php';

use Kristuff\Patabase\Database;
use Kristuff\Patabase\Driver\Sqlite;
use PHPUnit\Framework\TestCase;

class SqliteInjectionTest extends DatabaseInjectionTest
{
    public static function setUpBeforeClass() : void
    {   
        self::$db = new Database(array('driver' => 'sqlite', 'database' => ':memory:'));
        self::createTables();
  
    }

   
   public function testDebug1()
   {
    
       // debug
       $this->assertEquals('', self::$db->select()->from('test')->getAll('JSON'));

   }

    public function testDebug2()
    {
    
       // debug
       $this->assertEquals('', json_encode(self::$db->getTables()));

    }   

}

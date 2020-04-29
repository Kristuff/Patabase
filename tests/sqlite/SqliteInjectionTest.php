<?php

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../base/DatabaseInjectionTest.php';

use Kristuff\Patabase\Database;
use Kristuff\Patabase\Driver\Sqlite;
use PHPUnit\Framework\TestCase;

class SqliteInjectionTest extends DatabaseInjectionTest
{
    public function setUpBeforeClass() : void
    {   
        self::$db = new Database(array('driver' => 'sqlite', 'database' => ':memory:'));
        self::createTables();
  
    }

    public function testInjectionDropTable()
    {
     
       // John’; DROP table users_details;’       
       self::$db->insert('test')
       ->setValue('name', 'John')
       ->execute();

       $this->assertTrue( self::$db->insert('test')
                                    ->setValue('name', 'John"; DROP table test_injection;"')
                                    ->execute());

       $this->assertTrue( self::$db->table('test_injection')
                                    ->exists());


    }
 public function testDebug1()
    {
    
       // debug
       $this->assertEquals('', self::$db->select('name')->from('test')->getAll('JSON'));

    }

    public function testDebug2()
    {
    
       // debug
       $this->assertEquals('', json_encode(self::$db->getTables()));

    }   

}

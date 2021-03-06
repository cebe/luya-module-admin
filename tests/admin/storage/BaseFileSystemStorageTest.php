<?php

namespace admintests\components;

use Yii;
use admintests\AdminTestCase;
use luya\admin\filesystem\LocalFileSystem;

class BaseFileSystemStorageTest extends AdminTestCase
{
    private function getStorage()
    {
        return new LocalFileSystem(Yii::$app->request);
    }
    
    public function testHttpPath()
    {
        $this->assertEquals('/luya/envs/dev/public_html/storage', $this->getStorage()->httpPath);
    }
    
    public function testAbsoluteHttpPath()
    {
        $this->assertEquals('http://localhost/luya/envs/dev/public_html/storage', $this->getStorage()->absoluteHttpPath);
    }
    
    public function testServerPath()
    {
        $this->assertEquals('/var/www/luya/envs/dev/public_html/storage', $this->getStorage()->serverPath);
    }
    
    public function testBaseFileSystemStorage()
    {
        /** @var $mock \luya\admin\storage\BaseFileSystemStorage */
        $mock = $this->getMockForAbstractClass('luya\admin\storage\BaseFileSystemStorage', ['request' => Yii::$app->request]);
        
        // just test wrong get file and get image methods which sure return false and empty arrays
        $this->assertFalse($mock->getFile(0));
        $this->assertEmpty($mock->findFiles([]));
        $this->assertEmpty($mock->findFile([]));
        
        $this->assertFalse($mock->getImage(0));
        $this->assertEmpty($mock->findImages([]));
        $this->assertEmpty($mock->findImage([]));
        
        $this->assertFalse($mock->getFolder(0));
        $this->assertEmpty($mock->findFolder([]));
        $this->assertEmpty($mock->findFolders([]));
        
        $this->assertNull($mock->flushArrays());
    }
}

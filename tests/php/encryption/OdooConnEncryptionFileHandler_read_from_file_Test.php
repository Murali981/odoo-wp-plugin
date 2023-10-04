<?php

namespace odoo_conn\tests\OdooConnEncryptionFileHandler_Test;

use \org\bovigo\vfs\vfsStream;
use \PHPUnit\Framework\TestCase;

define("ABSPATH", "vfs://root/");

require_once(__DIR__ . "/../../../encryption.php");

class OdooConnEncryptionFileHandler_read_from_file_Test extends TestCase
{

    public function setUp(): void
    {
        $this->root = vfsStream::setup("root", 0777);
        $this->file_handler = new \odoo_conn\encryption\OdooConnEncryptionFileHandler();
    }

    public function test_existing_file()
    {
        vfsStream::newFile("odoo_conn.key")->at($this->root)->setContent("abc");

        $key = $this->file_handler->read_from_file();

        $this->assertEquals("abc", $key);
    }

    public function test_non_existing_file()
    {
        $this->assertFalse($this->root->hasChild("odoo_conn.key"));

        $key = $this->file_handler->read_from_file();

        $this->assertNull($key);
    }

}

?>
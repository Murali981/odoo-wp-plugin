<?php

namespace odoo_conn\tests\admin\api\endpoints\cf7_posts\OdooConnGetContact7Form;

require_once(__DIR__ . "/../common.php");
require_once(__DIR__ . "/../../../../../../admin/api/schema.php");
require_once(__DIR__ . "/../../../../../../admin/api/endpoints/c7f_posts.php");

use \PHPUnit\Framework\TestCase;
use function \odoo_conn\admin\api\endpoints\odoo_conn_get_contact_7_forms;
use OdooConnGetContact7Form;

class OdooConnGetContact7Form_Test extends TestCase
{

    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function test_ok()
    {
        $wpdb = \Mockery::mock("WPDB");
        $wpdb->posts = "wp_posts";
        $wpdb->shouldReceive("prepare")->with(
            "SELECT ID, post_title FROM wp_posts WHERE post_type=%s ORDER BY wp_posts.ID DESC",
            ["wpcf7_contact_form"]
        )
            ->once()->andReturn("SELECT ID, post_title FROM wp_posts WHERE post_type='wpcf7_contact_form' ORDER BY wp_posts.ID DESC");
        $wpdb->shouldReceive("get_results")->with("SELECT ID, post_title FROM wp_posts WHERE post_type='wpcf7_contact_form' ORDER BY wp_posts.ID DESC")
            ->once()->andReturn(array(array("ID" => 4, "post_title" => "Title")));
        $GLOBALS["wpdb"] = $wpdb;
        $GLOBALS["table_prefix"] = "wp_";

        $response = odoo_conn_get_contact_7_forms(array());

        $this->assertEquals(array(array("ID" => 4, "post_title" => "Title")), $response);
    }
}

?>
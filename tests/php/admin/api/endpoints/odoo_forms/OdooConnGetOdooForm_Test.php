<?php

namespace odoo_conn\tests\admin\api\endpoints\odoo_forms\OdooConnGetOdooForm;

require_once(__DIR__ . "/../common.php");
require_once(__DIR__ . "/../../../../../../admin/api/schema.php");
require_once(__DIR__ . "/../../../../../../admin/api/endpoints/odoo_forms.php");

use \PHPUnit\Framework\TestCase;
use function odoo_conn\admin\api\endpoints\odoo_conn_get_odoo_forms;

class OdooConnGetOdooForm_Test extends TestCase
{

    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function test_ok()
    {
        $query_response = array(
            array(
                "id" => 3, "odoo_form_id" => 2, "odoo_form_name" => "form name", "cf7_field_name" => "your-name", "odoo_field_name" => "name",
                "constant_value" => null
            )
        );
        $wpdb = \Mockery::mock("WPDB");
        $wpdb->posts = "wp_posts";
        $wpdb->shouldReceive("prepare")->with("SELECT wp_odoo_conn_form.id, wp_odoo_conn_form.odoo_connection_id, wp_odoo_conn_connection.name as 'odoo_connection_name', wp_odoo_conn_form.odoo_model, wp_odoo_conn_form.name, wp_odoo_conn_form.contact_7_id as 'contact_7_id', wp_posts.post_title as 'contact_7_title' FROM wp_odoo_conn_form JOIN wp_odoo_conn_connection ON wp_odoo_conn_form.odoo_connection_id=wp_odoo_conn_connection.id JOIN wp_posts ON wp_odoo_conn_form.contact_7_id=wp_posts.ID ORDER BY wp_odoo_conn_form.id DESC", [])
            ->once()->andReturn("SELECT wp_odoo_conn_form.id, wp_odoo_conn_form.odoo_connection_id, wp_odoo_conn_connection.name as 'odoo_connection_name', wp_odoo_conn_form.odoo_model, wp_odoo_conn_form.name, wp_odoo_conn_form.contact_7_id as 'contact_7_id', wp_posts.post_title as 'contact_7_title' FROM wp_odoo_conn_form JOIN wp_odoo_conn_connection ON wp_odoo_conn_form.odoo_connection_id=wp_odoo_conn_connection.id JOIN wp_posts ON wp_odoo_conn_form.contact_7_id=wp_posts.ID ORDER BY wp_odoo_conn_form.id DESC");
        $wpdb->shouldReceive("get_results")->with("SELECT wp_odoo_conn_form.id, wp_odoo_conn_form.odoo_connection_id, wp_odoo_conn_connection.name as 'odoo_connection_name', wp_odoo_conn_form.odoo_model, wp_odoo_conn_form.name, wp_odoo_conn_form.contact_7_id as 'contact_7_id', wp_posts.post_title as 'contact_7_title' FROM wp_odoo_conn_form JOIN wp_odoo_conn_connection ON wp_odoo_conn_form.odoo_connection_id=wp_odoo_conn_connection.id JOIN wp_posts ON wp_odoo_conn_form.contact_7_id=wp_posts.ID ORDER BY wp_odoo_conn_form.id DESC")
            ->once()->andReturn($query_response);
        $GLOBALS["wpdb"] = $wpdb;
        $GLOBALS["table_prefix"] = "wp_";

        $response = odoo_conn_get_odoo_forms(array());

        $this->assertEquals($query_response, $response);
    }

}

?>
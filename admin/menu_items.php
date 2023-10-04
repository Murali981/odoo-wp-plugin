<?php

include("pages/odoo_form.php");
include("pages/odoo_connection.php");
include("pages/odoo_form_mapping.php");
include("pages/odoo_errors.php");
include("pages/odoo_settings.php");

function add_top_menu_page()
{
    add_menu_page(
        "Odoo Froms",
        "Odoo Forms",
        "administrator",
        "odoo-form",
        "odoo_conn_odoo_form_page"
    );

    add_submenu_page(
        "odoo-form",
        "Odoo Connections",
        "Odoo Connections",
        "administrator",
        "odoo-connection",
        "odoo_conn_odoo_connection_page"
    );

    add_submenu_page(
        "odoo-form",
        "Odoo Form Mappings",
        "Odoo Form Mappings",
        "administrator",
        "odoo-form-mapping",
        "odoo_conn_odoo_form_mapping_page"
    );

    add_submenu_page(
        "odoo-form",
        "Odoo Submit Errors",
        "Odoo Submit Errors",
        "administrator",
        "odoo-submit-errors",
        "odoo_conn_odoo_errors_page"
    );

    add_submenu_page(
        "odoo-form",
        "Odoo Connector Settings",
        "Odoo Connector Settings",
        "administrator",
        "odoo-settings",
        "odoo_conn_odoo_settings"
    );

}

add_action("admin_menu", "add_top_menu_page");

?>
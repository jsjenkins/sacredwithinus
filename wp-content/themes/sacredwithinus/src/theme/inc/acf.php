<?php // Advanced Custom Fields settings

// ACF map API
/* function acf_maps_api() {
    
    acf_update_setting('google_api_key', '');
}

add_action('acf/init', 'acf_maps_api'); */

// Save fields to ../acf-json
function custom_acf_json_save_point( $path ) {
    
    $path = get_stylesheet_directory() . '/../acf-json';
    
    return $path;
    
}
add_filter('acf/settings/save_json', 'custom_acf_json_save_point');

// Load fields from ../acf-json
function custom_acf_json_load_point( $paths ) {
    
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/../acf-json';
    
    return $paths;
    
}
add_filter('acf/settings/load_json', 'custom_acf_json_load_point');

// Add styles for flexible content
function acf_modify_styles() {
    
    ?>
    <style type="text/css">
        .acf-field .acf-editor-wrap iframe {
            width: 100%;
            display: block;
        }

        /* Page Builder */
        .acf-field-flexible-content[data-name="page_builder"] .no-value-message {
            border-color: #1d2327;
            border-width: 3px;
        }
        @media (min-width: 600px) {
            .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .acf-fc-top-actions {
                margin-top: -34px;
            }
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout {
            border: 3px solid #1d2327;
            margin-top: 30px;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-actions-wrap,
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout.layout-active .acf-fc-layout-actions-wrap {
            background-color: #1d2327 !important;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-handle {
            font-weight: bold;
            color: #ffffff;
            font-size: 16px;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-handle .acf-fc-layout-order {
            background-color: #ffffff;
            font-weight: bold;
            color: #1d2327;
            font-size: 16px;
            width: 30px;
            height: 30px;
            border-radius: 100%;
            line-height: 28px;
            margin: 0 5px 0 0;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-handle .acf-fc-layout-draggable-icon {
            background-color: #ffffff !important;
            width: 30px;
            height: 30px;
            color: #1d2327;
            border-radius: 100%;
            margin: 0 5px 0 0;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-handle .acf-fc-layout-draggable-icon:before {
            background: #1d2327 !important;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-handle .acf-fc-layout-original-title {
            color: hsla(0, 0%, 100%, .5);
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-controls {
            top: 10px;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-controls .acf-layout-collapse {
            border-left: 0;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-fc-layout-controls .acf-icon {
            background-color: #ffffff !important;
            color: #101828 !important;
            border-radius: 100% !important;
            line-height: 23px;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table {
            border: 0;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td {
            border-bottom: 10px solid #fff;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td {
            border: 0;
            border-bottom: 3px solid #EAECF0;
            padding: 25px 10px;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater.-block .acf-table tr.acf-row td {
            border-top: 3px solid #EAECF0;
            border-bottom: 20px solid #fff;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater.-block .acf-table tr.acf-row:nth-last-child(2) td {
            border-bottom: 0 solid #fff;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater.-block .acf-table tr.acf-row td::after {
            content: '';
            display: block;
            width: 100%;
            height: 3px;
            background-color: #EAECF0;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater.-table .acf-table tr th {
            background-color: #EAECF0;
            color:  #1d2327;
            font-weight: bold;
            border: 0;
            border-bottom: 3px solid #fff;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td.acf-row-handle {
            background-color: #EAECF0;
            color: #c3c4c7;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td.acf-row-handle.order {
            text-shadow: none;
            font-weight: bold;
            font-size: 14px;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater.-table .acf-table tr.acf-row:not(:nth-last-child(2)) td.acf-row-handle {
            border-bottom-color: #fff;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td.acf-row-handle a.acf-icon {
            background-color: #fff;
            color:  #1d2327;
            border-color: #EAECF0;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td.acf-row-handle a.acf-icon.-minus:hover {
            border-color: #a10000;
            color: #dc3232;
        }
        .acf-field-flexible-content[data-name="page_builder"] .acf-flexible-content .layout .acf-repeater .acf-table tr.acf-row td.acf-row-handle a.acf-icon.-plus:hover {
            border-color: #0071a1;
            color: #0071a1;
        }

        .acf-field-flexible-content .acf-flexible-content .acf-fc-popup ul li a:hover {
            color: #101828;
            background-color: #EAECF0;
        }
    </style>
    <?php    
    
}
add_action('acf/input/admin_head', 'acf_modify_styles');

// Remove ACF WYSIWYG styles
function remove_acf_wysiwyg_styles() { ?>
    <script type="text/javascript">
        (function($) {
            acf.add_action('wysiwyg_tinymce_init', function( ed, id, mceInit, $field ){
                $(".acf-field .acf-editor-wrap iframe").removeAttr("style");
            });
        })(jQuery); 
    </script>
<?php }
add_action('acf/input/admin_footer', 'remove_acf_wysiwyg_styles');

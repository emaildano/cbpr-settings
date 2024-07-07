<?php
/*
Plugin Name: CBPR - API Keys and Settings
Description: A plugin with CBPR settings.
Version: 1.0
Author: Daniel Olson
*/

// Step 1: Define the Settings Page
function cbpr_add_settings_page()
{
  add_options_page(
    'CBPR Settings', // Page title
    'CBPR Settings', // Menu title
    'manage_options', // Capability
    'cbpr', // Menu slug
    'cbpr_render_settings_page' // Callback function
  );
}
add_action('admin_menu', 'cbpr_add_settings_page');

// Step 2: Register Settings
function cbpr_register_settings()
{
  register_setting('cbpr_settings_group', 'cbpr_api_key');
  register_setting('cbpr_settings_group', 'cbpr_google_spreadsheet_id');
}
add_action('admin_init', 'cbpr_register_settings');

// Step 3: Render the Settings Page
function cbpr_render_settings_page()
{
?>
  <div class="wrap">
    <h1>CBPR Settings</h1>
    <form method="post" action="options.php">
      <?php
      settings_fields('cbpr_settings_group');
      do_settings_sections('cbpr');
      submit_button();
      ?>
    </form>
  </div>
<?php
}

// Step 4: Add Settings Fields
function cbpr_settings_init()
{
  add_settings_section(
    'cbpr_settings_section',
    'CBPR Settings Section',
    'cbpr_settings_section_callback',
    'cbpr'
  );

  add_settings_field(
    'cbpr_api_key',
    'API Key',
    'cbpr_api_key_field_callback',
    'cbpr',
    'cbpr_settings_section'
  );

  add_settings_field(
    'cbpr_google_spreadsheet_id',
    'Google Spreadsheet ID',
    'cbpr_google_spreadsheet_id_field_callback',
    'cbpr',
    'cbpr_settings_section'
  );
}
add_action('admin_init', 'cbpr_settings_init');

function cbpr_settings_section_callback()
{
  echo '<p>Settings for CBPR Plugin.</p>';
}

function cbpr_api_key_field_callback()
{
  $api_key = get_option('cbpr_api_key');
?>
  <input type="text" name="cbpr_api_key" value="<?php echo isset($api_key) ? esc_attr($api_key) : ''; ?>" />
<?php
}

function cbpr_google_spreadsheet_id_field_callback()
{
  $google_spreadsheet_id = get_option('cbpr_google_spreadsheet_id');
?>
  <input type="text" name="cbpr_google_spreadsheet_id" value="<?php echo isset($google_spreadsheet_id) ? esc_attr($google_spreadsheet_id) : ''; ?>" />
<?php
}
?>

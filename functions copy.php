<?php

/**
 * Arab Fund functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Arab Fund
 * @since Arab Fund 1.0
 */


include get_parent_theme_file_path("assets/php/shortcodes.php");


/**
 * Register block styles.
 */

if (!function_exists('arab_fund_block_styles')):
    /**
     * Register custom block styles
     *
     * @since Arab Fund 1.0
     * @return void
     */
    function arab_fund_block_styles()
    {

        register_block_style(
            'core/details',
            array(
                'name' => 'arrow-icon-details',
                'label' => __('Arrow icon', 'arab-fund'),
                /*
                 * Styles for the custom Arrow icon style of the Details block
                 */
                'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
            )
        );
        register_block_style(
            'core/post-terms',
            array(
                'name' => 'pill',
                'label' => __('Pill', 'arab-fund'),
                /*
                 * Styles variation for post terms
                 * https://github.com/WordPress/gutenberg/issues/24956
                 */
                'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
            )
        );
        register_block_style(
            'core/list',
            array(
                'name' => 'checkmark-list',
                'label' => __('Checkmark', 'arab-fund'),
                /*
                 * Styles for the custom checkmark list block style
                 * https://github.com/WordPress/gutenberg/issues/51480
                 */
                'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
            )
        );
        register_block_style(
            'core/navigation-link',
            array(
                'name' => 'arrow-link',
                'label' => __('With arrow', 'arab-fund'),
                /*
                 * Styles for the custom arrow nav link block style
                 */
                'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
            )
        );
        register_block_style(
            'core/heading',
            array(
                'name' => 'asterisk',
                'label' => __('With asterisk', 'arab-fund'),
                'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
            )
        );
    }
endif;

add_action('init', 'arab_fund_block_styles');

/**
 * Enqueue block stylesheets.
 */

if (!function_exists('arab_fund_block_stylesheets')):
    /**
     * Enqueue custom block stylesheets
     *
     * @since Arab Fund 1.0
     * @return void
     */
    function arab_fund_block_stylesheets()
    {
        /**
         * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
         * for a specific block. These will only get loaded when the block is rendered
         * (both in the editor and on the front end), improving performance
         * and reducing the amount of data requested by visitors.
         *
         * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
         */
        wp_enqueue_block_style(
            'core/button',
            array(
                'handle' => 'arab-fund-button-style-outline',
                'src' => get_parent_theme_file_uri('assets/css/button-outline.css'),
                'ver' => wp_get_theme(get_template())->get('Version'),
                'path' => get_parent_theme_file_path('assets/css/button-outline.css'),
            )
        );
    }
endif;

add_action('init', 'arab_fund_block_stylesheets');

/**
 * Register pattern categories.
 */

if (!function_exists('arab_fund_pattern_categories')):
    /**
     * Register pattern categories
     *
     * @since Arab Fund 1.0
     * @return void
     */
    function arab_fund_pattern_categories()
    {

        register_block_pattern_category(
            'arab_fund_page',
            array(
                'label' => _x('Pages', 'Block pattern category', 'arab-fund'),
                'description' => __('A collection of full page layouts.', 'arab-fund'),
            )
        );
    }
endif;

add_action('init', 'arab_fund_pattern_categories');

function arab_fund_setup()
{
    add_theme_support('wp-block-styles');
    // remove_theme_support('widgets-block-editor');

    add_editor_style(array(
        get_stylesheet_uri(),
        get_parent_theme_file_uri('assets/css/primary.css'),
        get_parent_theme_file_uri('assets/css/select2.min.css'),
        get_parent_theme_file_uri('assets/css/main.css'),
        get_parent_theme_file_uri('assets/css/homepagestyle.css'),
        get_parent_theme_file_uri('assets/css/about.css'),
        get_parent_theme_file_uri('assets/css/jquery.mCustomScrollbar.min.css'),
        get_parent_theme_file_uri('assets/css/custom.css'),
        get_parent_theme_file_uri('assets/css/fancybox.css'),
        get_parent_theme_file_uri('assets/css/media.css'),
        get_parent_theme_file_uri('assets/css/aos.css'),
        get_parent_theme_file_uri('assets/css/jquery-ui.css'),
        get_parent_theme_file_uri('assets/css/jquery.multiselect.css'),
        get_parent_theme_file_uri('assets/css/mgpopup.css'),
        get_parent_theme_file_uri('assets/css/arabfund.css')
    ));
}
add_action('after_setup_theme', 'arab_fund_setup');


// add_action('after_setup_theme', 'arab_fund_setup');

// function arab_fund_setup()
// {
//     add_theme_support('wp-block-styles');
//     remove_theme_support('widgets-block-editor');
//     add_editor_style(array(
//         get_stylesheet_uri(),
//         get_parent_theme_file_uri('assets/css/primary.css')
//     ));
// }

// Importing CSS and JS files

add_action('wp_enqueue_scripts', 'arab_fund_enqueue_styles');

function arab_fund_enqueue_styles()
{
    wp_enqueue_style(
        'arab-fund-style',
        get_stylesheet_uri()
    );
    wp_enqueue_style(
        'arab-fund-select2',
        get_parent_theme_file_uri('assets/css/select2.min.css')
    );
    wp_enqueue_style(
        'arab-fund-main',
        get_parent_theme_file_uri('assets/css/main.css')
    );
    wp_enqueue_style(
        'arab-fund-homepagestyle',
        get_parent_theme_file_uri('assets/css/homepagestyle.css')
    );
    wp_enqueue_style(
        'arab-fund-about',
        get_parent_theme_file_uri('assets/css/about.css')
    );

    wp_enqueue_style(
        'arab-fund-mCustomScrollbar',
        get_parent_theme_file_uri('assets/css/jquery.mCustomScrollbar.min.css')
    );
    wp_enqueue_style(
        'arab-fund-custom',
        get_parent_theme_file_uri('assets/css/custom.css')
    );
    wp_enqueue_style(
        'arab-fund-fancybox',
        get_parent_theme_file_uri('assets/css/fancybox.css')
    );
    wp_enqueue_style(
        'arab-fund-media',
        get_parent_theme_file_uri('assets/css/media.css')
    );
    wp_enqueue_style(
        'arab-fund-aos',
        get_parent_theme_file_uri('assets/css/aos.css')
    );
    wp_enqueue_style(
        'arab-fund-jquery',
        get_parent_theme_file_uri('assets/css/jquery-ui.css')
    );
    wp_enqueue_style(
        'arab-fund-multiselect',
        get_parent_theme_file_uri('assets/css/jquery.multiselect.css')
    );
    wp_enqueue_style(
        'arab-fund-mgpopup',
        get_parent_theme_file_uri('assets/css/mgpopup.css')
    );
    wp_enqueue_style(
        'arab-fund-style',
        get_parent_theme_file_uri('assets/css/arabfund.css')
    );

    wp_register_script('aos', get_stylesheet_directory_uri() . '/assets/js/aos.js', array('jquery'), time());
    wp_enqueue_script('aos');
    wp_register_script('fancybox', get_stylesheet_directory_uri() . '/assets/js/fancybox.js', array('jquery'), time());
    wp_enqueue_script('fancybox');
    wp_register_script('customjs', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), time());
    wp_enqueue_script('customjs');
    wp_register_script('mCustomScrollbar', get_stylesheet_directory_uri() . '/assets/js/jquery.mCustomScrollbar.min.js', array('jquery'), time());
    wp_enqueue_script('mCustomScrollbar');
    wp_register_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'));
    wp_enqueue_script('jquery-ui');
    wp_register_script('multiselect', get_stylesheet_directory_uri() . '/assets/js/jquery.multiselect.js', array('jquery'));
    wp_enqueue_script('multiselect');

    wp_register_script('select2', get_stylesheet_directory_uri() . '/assets/js/select2.min.js', array('jquery'));
    wp_enqueue_script('select2');
    wp_register_script('magnific', get_stylesheet_directory_uri() . '/assets/js/magnific_popup.js', array('jquery'));
    wp_enqueue_script('magnific');
}



// Add Pattern to Dashboard Sidebar
function add_patterns_to_admin_menu()
{
    add_menu_page(
        __('Arab Fund Patterns', '/wp-admin'), // Page title
        __('Arab Fund Patterns', '/wp-admin'), // Menu title
        'edit_posts',                             // Capability
        'edit.php?post_type=wp_block',            // Menu slug
        '',                                       // Function (not needed here)
        'dashicons-screenoptions',                // Icon URL (or dashicon class)
        5                                        // Position in the menu
    );
}
add_action('admin_menu', 'add_patterns_to_admin_menu');

//  activate content duplication selected by default in polylang 
function polylang_default_content_duplication()
{
    if (function_exists('pll_current_language')) {
?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const duplicateCheckbox = document.querySelector('#post_custom_keys input[name="pll_duplication"]');
                if (duplicateCheckbox && !duplicateCheckbox.checked) {
                    duplicateCheckbox.checked = true;
                }
            });
        </script>
    <?php
    }
}
add_action('admin_footer', 'polylang_default_content_duplication');




// Get the current year dynamically

function current_year_shortcode()
{
    return date('Y');
}
add_shortcode('current_year', 'current_year_shortcode');




// Allow svg images
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



// Custom post type script start from here
function arabfund_job()
{
    ob_start();

    $data = '<div class="container">';
    $query = new WP_Query('post_type=jobs&showposts=-1&order=ASC');
    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();


        $data .= '<div class="job-box">
          <h2>' . get_field("title") . '</h2>
          <p>' . get_field("description") . '.</p>
          <p>Date : <span>' . get_field("job_post_date") . '</span></p>
          <a href="' . get_permalink() . '" target="_self">Read More <img src="/sample/wp-content/uploads/2023/09/arrow_.svg" alt="read more arrow"></a>
    </div>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_job_shartcode', 'arabfund_job'); /// end simple

/**
 *  Function returns associated english id based on arab country
 */

function arab_countries_map_data()
{
    $arab_english_countries = array(
        '219' => '1024',
        '218' => '1025',
        '217' => '1026',
        '216' => '1027',
        '215' => '1028',
        '214' => '1030',
        '213' => '1031',
        '212' => '1032',
        '211' => '1033',
        '210' => '1034',
        '209' => '1035',
        '208' => '1036',
        '207' => '1037',
        '206' => '1038',
        '205' => '1039',
        '204' => '1040',
        '203' => '1041',
        '202' => '1042',
        '201' => '1043',
        '200' => '1044',
        '937' => '936',
        '5681' => '938'
    );
    return $arab_english_countries;
}

function arab_sectors_map_data()
{

    $arab_sectors = array(
        '10713' => '10714',
        '10724' => '10725',
        '10726' => '10727',
        '10728' => '10729',
        '10730' => '10731',
        '10732' => '10733',
        '10735' => '10736',
        '10738' => '10739'
    );

    return $arab_sectors;
}

//Demo for syncing prices from arab to english translated post from arab post.
function arab_funds_sync_data_arab_to_english($post_id, $post, $update)
{
    session_start();

    $arab_primary_post = get_post_meta($post_id, 'arab_primary_post', true);
    $post_language = pll_get_post_language($post_id);

    //Code update execute english post update only if post updated is of arab country
    if ($post_language == 'en-us') {

        $args = array(
            'post_type' => 'projects',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => 'arab_primary_post',
                    'value' => $post_id,
                ),
            ),
        );

        $posts = get_posts($args);


        if (!empty($posts) && !empty($posts[0]->ID)) {

            $english_loan_number = get_post_meta($posts[0]->ID, 'project_loan_number', true);
            $english_agreement_serial = get_post_meta($posts[0]->ID, 'project_agreement_serial', true);
            $english_project_type = get_post_meta($posts[0]->ID, 'project_type', true);
            $english_sector = get_post_meta($posts[0]->ID, 'project_sector', true);
            $english_country = get_post_meta($posts[0]->ID, 'project_country', true);
            $english_approved_year = get_post_meta($posts[0]->ID, 'project_approved_year', true);
            $english_sign_date = get_post_meta($posts[0]->ID, 'project_sign_date', true);
            $english_original_amount = get_post_meta($posts[0]->ID, 'project_original_amount', true);
            $english_cancelled_amount = get_post_meta($posts[0]->ID, 'project_cancelled_amount', true);
            $english_net_amount = get_post_meta($posts[0]->ID, 'project_net_amount', true);
            $english_board_approval = get_post_meta($posts[0]->ID, 'project_board_approval_date', true);
            $english_date_effectiveness = get_post_meta($posts[0]->ID, 'project_date_effectiveness', true);
            $english_interest_rate = get_post_meta($posts[0]->ID, 'project_interest_rate', true);
            $english_grace_period = get_post_meta($posts[0]->ID, 'project_grace_period', true);
            $english_project_cost = get_post_meta($posts[0]->ID, 'project_cost', true);
            $english_project_maturity = get_post_meta($posts[0]->ID, 'project_maturity', true);

            if (!empty($_POST['acf']) && is_array($_POST['acf'])) {
                //Original Amount
                if ($english_original_amount !== $_POST['acf']['field_654d1f2fa1cab']) {
                    update_post_meta($posts[0]->ID, 'project_original_amount', $_POST['acf']['field_654d1f2fa1cab']);
                }
                //Cancelled Amount
                if ($english_cancelled_amount !== $_POST['acf']['field_654f1b3f6b65a']) {
                    update_post_meta($posts[0]->ID, 'project_cancelled_amount', $_POST['acf']['field_654f1b3f6b65a']);
                }
                //Net Amount
                if ($english_net_amount !== $_POST['acf']['field_654f1c8b6b65b']) {
                    update_post_meta($posts[0]->ID, 'project_net_amount', $_POST['acf']['field_654f1c8b6b65b']);
                }
                //Loan Number
                if ($english_loan_number !== $_POST['acf']['field_6552575ff1cbc']) {
                    update_post_meta($posts[0]->ID, 'project_loan_number', $_POST['acf']['field_6552575ff1cbc']);
                }
                //Agreement Serial
                if ($english_agreement_serial !== $_POST['acf']['field_6558eae422d23']) {
                    update_post_meta($posts[0]->ID, 'project_agreement_serial', $_POST['acf']['field_6558eae422d23']);
                }
                //Project type
                if ($english_project_type !== $_POST['acf']['field_654cfe016645a']) {
                    update_post_meta($posts[0]->ID, 'project_type', $_POST['acf']['field_654cfe016645a']);
                }
                //Sector
                if ($english_sector !== $_POST['acf']['field_655f131036f4e']) {
                    $arab_selected_sector = $_POST['acf']['field_655f131036f4e'];
                    $arab_sector_data = arab_sectors_map_data();
                    $arab_sector_associated_id = isset($arab_sector_data[$_POST['acf']['field_655f131036f4e']]) ? $arab_sector_data[$_POST['acf']['field_655f131036f4e']] : null;
                    update_post_meta($posts[0]->ID, 'project_sector', $arab_sector_associated_id);
                }
                //Country

                if ($english_country !== $_POST['acf']['field_654bce08aad84']) {
                    $arab_selected_country = $_POST['acf']['field_654bce08aad84'];
                    $arab_available_mapped_data = arab_countries_map_data();
                    $arab_country_associated_id = isset($arab_available_mapped_data[$_POST['acf']['field_654bce08aad84']]) ? $arab_available_mapped_data[$_POST['acf']['field_654bce08aad84']] : null;
                    update_post_meta($posts[0]->ID, 'project_country', $arab_country_associated_id);
                }
                //Approved year
                if ($english_approved_year !== $_POST['acf']['field_65524381f9997']) {
                    update_post_meta($posts[0]->ID, 'project_approved_year', $_POST['acf']['field_65524381f9997']);
                }
                //Project Sign Date
                if ($english_sign_date !== $_POST['acf']['field_6558ef23d21b7']) {
                    update_post_meta($posts[0]->ID, 'project_sign_date', $_POST['acf']['field_6558ef23d21b7']);
                }


                //this section indicates updation of secondary details
                //Project Board Approval
                if ($english_board_approval !== $_POST['acf']['field_658e91238bc6a']) {
                    update_post_meta($posts[0]->ID, 'project_board_approval_date', $_POST['acf']['field_658e91238bc6a']);
                }

                if ($english_date_effectiveness !== $_POST['acf']['field_659d9738dbf48']) {
                    update_post_meta($posts[0]->ID, 'project_date_effectiveness', $_POST['acf']['field_659d9738dbf48']);
                }

                if ($english_interest_rate !== $_POST['acf']['field_658e91238bac0']) {
                    update_post_meta($posts[0]->ID, 'project_interest_rate', $_POST['acf']['field_658e91238bac0']);
                }

                if ($english_grace_period !== $_POST['acf']['field_658e922e6127d']) {
                    update_post_meta($posts[0]->ID, 'project_grace_period', $_POST['acf']['field_658e922e6127d']);
                }

                /*if( $english_project_cost !== $_POST['acf']['field_658e93376127e']  ) {
                    update_post_meta($posts[0]->ID,'project_cost',$_POST['acf']['field_658e93376127e']);
                }*/

                if ($english_project_cost !== $_POST['acf']['field_658e93b76127f']) {
                    update_post_meta($posts[0]->ID, 'project_maturity', $_POST['acf']['field_658e93b76127f']);
                }

                //Project date effectiveness


            }
        }
    } else {


        //$arab_primary_post = get_post_meta( $post_id , 'arab_primary_post', true );
        if (isset($_GET['from_post']) && empty($_SESSION['arab_main_post'])) {
            $_SESSION['arab_main_post'] = $_GET['from_post'];
            //update_post_meta($post_id,'arab_primary_post',$_GET['from_post']);
        }
        if (isset($_SESSION['arab_main_post']) && $post->post_status == "publish") {
            update_post_meta($post_id, 'arab_primary_post', $_SESSION['arab_main_post']);
            unset($_SESSION['arab_main_post']);
        }
    }
}
add_action('save_post', 'arab_funds_sync_data_arab_to_english', 10, 3); /// end simple


//Custom code to make project group fields dynamically
function arab_acf_fields_readonly($field)
{
    // Check if Polylang is active
    //sprint_r($field);

    if (function_exists('pll_current_language')) {
        // Get the current language
        // echo '<pre>';
        // print_r($field);
        // echo '</pre>';
        $current_language = pll_current_language();
        //echo $current_language;
        $en_read_only_fields = array(
            'project_loan_number',
            'project_agreement_serial',
            'project_type',
            //'project_sector',
            //'project_country',
            //'project_approved_year',
            'project_sign_date',
            'project_original_amount',
            'project_cancelled_amount',
            'project_net_amount',
            'project_amount_paid',
            //'project_primary_caption',
            //'project_secondary_caption',
            'project_interest_rate',
            //'project_beneficiary',
            'project_grace_period',
            // 'project_cost',
            'project_maturity',
            //'project_repayment',
            'project_board_approval_date',
            'project_date_effectiveness',
            //'project_first_installment',
            'project_start_date',
            'project_amount_paid'
        );

        /*if ($current_language === 'ar' && $field['name'] == 'project_sector') {
            $new_choices = array(
                'new_value_1' => 'New Label 1',
                'new_value_2' => 'New Label 2',
                // Add more values and labels as needed
            );
            $field['choices'] = $new_choices;
        }*/
        // Check if the current language is 'en' (English)
        if ($current_language === 'ar') {

            if (in_array($field['name'], $en_read_only_fields)) {
                //echo $field['name'];
                if ($field['type'] !== 'radio') {
                    $field['disabled'] = true;
                }
            }
        }
    }
    return $field;
}
add_action('acf/load_field', 'arab_acf_fields_readonly');

/* changing drop-down values of sector when selected post type is of arab type */
function arab_acf_change_values($title, $post, $field, $post_id)
{
    if (function_exists('pll_current_language')) {
        $current_language = pll_current_language();
        // Check if the field is the one you want to modify
        if ($current_language === 'ar' && $field['name'] == 'project_sector') { // Replace 'field_655f131036f4e' with the actual field key
            // Get the translated post title based on the current language
            $translated_title = arabfund_plugin_str_display(trim($title));

            // Update the post title in the field value
            $title = $translated_title;
        }
    }
    return $title;
}

// Hook into acf/load_value
//add_filter('acf/fields/post_object/result/name=project_sector', 'arab_acf_change_values', 10, 4);

function arab_acf_update_values($value, $post_id, $field)
{
    if (function_exists('pll_current_language')) {
        $current_language = pll_current_language();

        // Check if the field is the one you want to modify
        if ($current_language === 'ar' && $field['name'] == 'project_sector') {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            wp_die("aaa");
            // Get the translated post title based on the current language
            $translated_title = arabfund_plugin_str_display(trim($value->post_title));

            // Update the post title in the field value
            $value->post_title = $translated_title;
        }
    }
    return $value;
}

// Hook into acf/update_value
//add_filter('acf/update_value/name=project_sector', 'arab_acf_update_values', 10, 4);
//add_filter('acf/load_value/name=project_sector', 'arab_acf_update_values',10,3);


function add_custom_search_footer()
{
    ?>
    <div id="search-form" class="full-popup mfp-hide">
        <p><?php echo get_search_form(); ?>
        <p>
    </div>
<?php
}
add_action('wp_footer', 'add_custom_search_footer');



add_filter('wpseo_breadcrumb_links', 'custom_album_breadcrumbs');

function custom_album_breadcrumbs($links)
{
    global $post;
    $current_language = pll_current_language();

    // Check if the current post type is "albums"
    if (is_singular('albums')) {
        // Create breadcrumb links
        if ($current_language == 'en-us') {
            $breadcrumb = array(
                array(
                    'url' => site_url('/photo-gallery/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'Photo Gallery',
                ),

            );
        } else if ($current_language == 'ar') {
            $breadcrumb = array(
                array(
                    'url' => site_url('/ar/agreement-of-afesd-establishment/photo-gallery/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'معرض الصور',
                ),

            );
        }

        // Replace the second and subsequent breadcrumb links with the custom ones
        array_splice($links, 1, -2, $breadcrumb);
    }
    if (is_singular('countries')) {
        if ($current_language == 'en-us') {
            // Create breadcrumb links
            $breadcrumb = array(
                array(
                    'url' => site_url('/overview/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'Fund Activities',
                    //ملخص المشروع
                ),
                array(
                    'url' => site_url('/overview/project-summary/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'Project Summary',
                    //ملخص المشروع
                ),

            );
        } else if ($current_language == 'ar') {
            $breadcrumb = array(
                array(
                    'url' => site_url('/ar/لمحة-عامة/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => ' لمحة عامة',
                ),
                array(
                    'url' => site_url('/ar/afesd-activities/project-summary/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'ملخص المشروع',
                    //ملخص المشروع
                ),

            );
        }


        // Replace the second and subsequent breadcrumb links with the custom ones
        array_splice($links, 1, -2, $breadcrumb);
    }
    if (is_singular('projects')) {
        if ($current_language == 'en-us') {
            // Create breadcrumb links
            $breadcrumb = array(
                array(
                    'url' => site_url('/overview/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'Fund Activities',
                    //ملخص المشروع
                ),
                array(
                    'url' => site_url('/overview/list-of-all-projects/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'List of all Projects',
                    //ملخص المشروع
                ),

            );
        } else if ($current_language == 'ar') {
            $breadcrumb = array(
                array(
                    'url' => site_url('/ar/لمحة-عامة/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => ' لمحة عامة',
                ),
                array(
                    'url' => site_url('/ar/list-of-all-projects/'), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'قائمة بجميع المشاريع',
                ),

            );
        }


        // Replace the second and subsequent breadcrumb links with the custom ones
        array_splice($links, 1, -2, $breadcrumb);
    }
    if (is_singular('training-programme')) {
        if ($current_language == 'en') {
            // Create breadcrumb links
            $breadcrumb = array(
                array(
                    'url' => site_url(), // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'Training Programs',
                ),


            );
        } else if ($current_language == 'ar') {
            $breadcrumb = array(
                array(
                    'url' => '#', // Assuming "/photo-gallery/" is the URL of your photo gallery page
                    'text' => 'برامج تدريبية',
                ),


            );
        }
        array_splice($links, 1, -2, $breadcrumb);
    }

    return $links;
}
add_filter('frm_submit_button', 'change_my_submit_button_label', 10, 2);
function change_my_submit_button_label($label, $form)
{
    $current_language = pll_current_language();
    if ($current_language === "ar") {
        $label = "يُقدِّم";
    } else {
        $label = "Submit";
    }

    //Change this text to the new Submit button label
    return $label;
}



function filter_featured_image_admin_text($content, $post_id, $thumbnail_id)
{
    // Get the post object
    $post = get_post($post_id);

    // Check if the post type is 'countries'
    if ($post && $post->post_type === 'countries') {
        $help_text = '<p>' . __('Please use an image that is 1170 pixels wide x 658 pixels tall.', 'my_domain') . '</p>';
        return $help_text . $content;
    }

    // For other post types, return the original content
    return $content;
}
add_filter('admin_post_thumbnail_html', 'filter_featured_image_admin_text', 10, 3);



function translate_elementor_project_title($atts)
{

    // echo pll__('Projects');
    $current_language = pll_current_language();
    if ($current_language == "ar") {
        $heading = "المشاريع";
    } else {
        $heading = $atts['title'];
    }
    return '<h2 class="elementor-heading-title elementor-size-default">' . $heading . '</h2>';
}
add_shortcode('project_title', 'translate_elementor_project_title');

function custom_search_posts_per_page($query)
{
    if ($query->is_search() && !is_admin()) {
        $query->set('posts_per_page', 20); // Change the number 10 to the desired number of posts per page for search results
    }
}
add_action('pre_get_posts', 'custom_search_posts_per_page');

//add_action('wp_insert_post', 'arab_validate_country_post_title', 10, 3);
//add_filter('wp_insert_post_data', 'arab_validate_country_post_title', 99, 3);
function arab_validate_country_post_title($data, $postarr, $update)
{
    // Check if it's a new post being added for the first time

    if ($postarr['ID'] === 0 && isset($postarr['post_type']) && $postarr['post_type'] === 'countries') {
        // Get the post title
        $post_title = isset($data['post_title']) ? $data['post_title'] : '';

        // Query to check if a post with the same title already exists
        $args = array(
            'post_type' => 'countries',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'title' => $post_title,
            'fields' => 'ids',
        );

        // Perform the query
        $existing_post_ids = get_posts($args);


        // If a post with the same title exists, prevent saving and display a validation message
        if (!empty($existing_post_ids)) {
            // Set an error message
            $error_message = __('A post with the same title already exists. Please choose a different title.', 'arab-fund');

            // Display the error message
            add_action('admin_notices', function () use ($error_message) {
                echo '<div class="error"><p>' . esc_html($error_message) . '</p></div>';
            });

            // Empty the post data to prevent saving
            $data = array();

            // Return empty data to prevent saving the post
            return $data;
        }
    }

    // Return the original data if no duplicate title found or if the post is being updated
    return $data;
}

function acf_load_countries_in_special_account($field)
{
    // Reset choices
    $field['choices'] = array();
    $lang = pll_current_language();
    switch_to_blog(1);
    $args = array(
        'post_type' => 'countries',           // Your custom post type name
        'post_status' => 'publish',          // Post status
        'numberposts' => -1,
        'lang' => $lang,
        'orderby' => 'title',
        'order' => 'ASC'
    );
    $country_data = get_posts($args);

    if ($country_data) {
        foreach ($country_data as $country) {
            // Add each country to the choices array
            $field['choices'][$country->ID] = get_the_title($country->ID);
        }
    }
    restore_current_blog();
    // Return the field
    return $field;
}

add_filter('acf/load_field/name=meeting_country', 'acf_load_countries_in_special_account');



function hide_wp_version()
{
    return '';
}
add_filter('the_generator', 'hide_wp_version');


$role_object = get_role('editor');
$role_object->add_cap('edit_theme_options');



// // Create a shortcode to display 'page_title'
// function page_main_heading()
// {
//     $page_title = get_field('page_title');
//     if ($page_title) {
//         return '<div class=""><h1>' . esc_html($page_title) . '</h1></div>';
//     } else {
//         // Return nothing if 'page_title' empty
//         return '';
//     }
// }

// // Register the shortcode [page_main_heading]
// add_shortcode('page_main_heading', 'page_main_heading');





// function my_custom_meta_box()
// {
//     add_meta_box(
//         'my_custom_meta_box_id',           // ID
//         'Custom Information',              // Title
//         'my_custom_meta_box_callback',     // Callback function
//         'page',                            // Post type (can be 'post', 'page', 'your_cpt_slug')
//         'side',                            // Context (where it shows up: 'side', 'normal', 'advanced')
//         'high'                             // Priority (high or low)
//     );
// }
// add_action('add_meta_boxes', 'my_custom_meta_box');

// function my_custom_meta_box_callback($post)
// {
//     // Add a nonce field for security
//     wp_nonce_field('my_custom_nonce_action', 'my_custom_nonce');

//     // Retrieve existing value from the database
//     $value = get_post_meta($post->ID, '_my_custom_meta_key', true);

//     // Display input field
//     echo '<label for="my_custom_field">Custom Info:</label>';
//     echo '<input type="text" id="my_custom_field" name="my_custom_field" value="' . esc_attr($value) . '" />';
// }

// // Save the custom meta box data
// function my_save_meta_box_data($post_id)
// {
//     // Verify the nonce before proceeding
//     if (!isset($_POST['my_custom_nonce']) || !wp_verify_nonce($_POST['my_custom_nonce'], 'my_custom_nonce_action')) {
//         return;
//     }

//     // Save the custom field value
//     if (isset($_POST['my_custom_field'])) {
//         update_post_meta($post_id, '_my_custom_meta_key', sanitize_text_field($_POST['my_custom_field']));
//     }
// }
// add_action('save_post', 'my_save_meta_box_data');

// // $custom_info = get_post_meta(get_the_ID(), '_my_custom_meta_key', true);
// function display_custom_info_shortcode()
// {
//     // Get the current post ID
//     $post_id = get_the_ID();

//     // Retrieve the custom field value using the post ID
//     $custom_info = get_post_meta($post_id, '_my_custom_meta_key', true);

//     // Return the custom info to be displayed by the shortcode
//     if (!empty($custom_info)) {
//         return '<div class="custom-info">' . esc_html($custom_info) . '</div>';
//     }

//     return ''; // Return nothing if the field is empty
// }
// add_shortcode('custom_info', 'display_custom_info_shortcode');


function my_main_heading_meta_box()
{
    add_meta_box(
        'my_main_heading_meta_box_id',     // ID
        'Main Heading',                    // Title
        'my_main_heading_meta_box_callback', // Callback function
        'page',                            // Post type (can be 'post', 'page', 'your_cpt_slug')
        'side',                            // Context (where it shows up: 'side', 'normal', 'advanced')
        'high'                             // Priority (high or low)
    );
}
add_action('add_meta_boxes', 'my_main_heading_meta_box');

function my_main_heading_meta_box_callback($post)
{
    // Add a nonce field for security
    wp_nonce_field('my_main_heading_nonce_action', 'my_main_heading_nonce');

    // Retrieve existing value from the database
    $value = get_post_meta($post->ID, '_my_main_heading_meta_key', true);

    // Display input field
    echo '<label for="my_main_heading_field"  style="display:block; margin-bottom: 5px;">Main Heading:</label>';
    echo '<input type="text" id="my_main_heading_field" name="my_main_heading_field" value="' . esc_attr($value) . '" />';
    echo '<p style="font-size: 12px; color: #666; margin-top: 5px;">Leave empty if none</p>';
}

// Save the main heading meta box data
function my_save_main_heading_meta_box_data($post_id)
{
    // Verify the nonce before proceeding
    if (!isset($_POST['my_main_heading_nonce']) || !wp_verify_nonce($_POST['my_main_heading_nonce'], 'my_main_heading_nonce_action')) {
        return;
    }

    // Save the main heading field value
    if (isset($_POST['my_main_heading_field'])) {
        update_post_meta($post_id, '_my_main_heading_meta_key', sanitize_text_field($_POST['my_main_heading_field']));
    }
}
add_action('save_post', 'my_save_main_heading_meta_box_data');

// Create a shortcode to display 'main_heading'
function page_main_heading_shortcode()
{
    $post_id = get_the_ID();
    $main_heading = get_post_meta($post_id, '_my_main_heading_meta_key', true);

    // If 'main_heading' is not empty, display it with h1 tag
    if (!empty($main_heading)) {
        return '<div class=""><h1>' . esc_html($main_heading) . '</h1></div>';
    } else {
        // Return nothing if 'main_heading' is empty
        return '';
    }
}

// Register the shortcode [page_main_heading]
add_shortcode('page_main_heading', 'page_main_heading_shortcode');



function my_mega_menu_meta_box()
{
    add_meta_box(
        'my_mega_menu_meta_box_id',     // ID
        'Mega Menu',                    // Title
        'my_mega_menu_meta_box_callback', // Callback function
        'page',                         // Post type (can be 'post', 'page', 'your_cpt_slug')
        'side',                         // Context (where it shows up: 'side', 'normal', 'advanced')
        'high'                          // Priority (high or low)
    );
}
add_action('add_meta_boxes', 'my_mega_menu_meta_box');

function my_mega_menu_meta_box_callback($post)
{
    // Add a nonce field for security
    wp_nonce_field('my_mega_menu_nonce_action', 'my_mega_menu_nonce');

    // Retrieve the existing Mega Menu value
    $mega_menu_value = get_post_meta($post->ID, '_my_mega_menu_meta_key', true);

    // Get all registered menus (including Mega Menu menus)
    $menus = get_terms('nav_menu', array('hide_empty' => false));

    // Display dropdown for Mega Menu selection
    echo '<label for="my_mega_menu_field">Select Mega Menu:</label>';
    echo '<select id="my_mega_menu_field" name="my_mega_menu_field">';
    echo '<option value="">Select a Mega Menu</option>'; // Default option

    // Loop through the menus and populate the dropdown options
    if (!empty($menus)) {
        foreach ($menus as $menu) {
            $selected = ($mega_menu_value == $menu->term_id) ? 'selected="selected"' : '';
            echo '<option value="' . esc_attr($menu->term_id) . '" ' . $selected . '>' . esc_html($menu->name) . '</option>';
        }
    }
    echo '</select>';
}

// Save the Mega Menu meta box data
function my_save_mega_menu_meta_box_data($post_id)
{
    // Verify the nonce before proceeding
    if (!isset($_POST['my_mega_menu_nonce']) || !wp_verify_nonce($_POST['my_mega_menu_nonce'], 'my_mega_menu_nonce_action')) {
        return;
    }

    // Save the selected Mega Menu value
    if (isset($_POST['my_mega_menu_field'])) {
        update_post_meta($post_id, '_my_mega_menu_meta_key', sanitize_text_field($_POST['my_mega_menu_field']));
    }
}
add_action('save_post', 'my_save_mega_menu_meta_box_data');
// Create a shortcode to display the selected Mega Menu
function display_mega_menu_shortcode()
{
    $post_id = get_the_ID();
    $mega_menu_id = get_post_meta($post_id, '_my_mega_menu_meta_key', true);

    if (!empty($mega_menu_id)) {
        return wp_nav_menu(array(
            'menu' => $mega_menu_id,
            'echo' => false, // Return the menu instead of echoing
        ));
    }
    return ''; // Return nothing if no Mega Menu is selected
}
add_shortcode('mega_menu', 'display_mega_menu_shortcode');





// Add Theme to Dashboard Sidebar
function add_theme_to_admin_menu()
{
    add_menu_page(
        __('Appearance', 'textdomdomain: ain'),
        __('Appearance', 'textdomain'),
        'edit_theme_options',
        'themes.php',
        '',
        'dashicons-admin-appearance',
        5
    );
}
add_action('admin_menu', 'add_theme_to_admin_menu');

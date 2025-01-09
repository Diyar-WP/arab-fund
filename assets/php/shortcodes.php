<?php

/**
 *  Singular redirect for pagination
 */
add_filter('redirect_canonical', 'arabfund_disable_redirect_canonical');
function arabfund_disable_redirect_canonical($redirect_url)
{
    if (is_singular())
        $redirect_url = false;
    return $redirect_url;
}

/**
 *  Register string translation for Ploylang
 */
add_action('after_setup_theme', 'arabfund_string_translation');
function arabfund_string_translation()
{
    // register our translatable strings - again first check if function exists.
    if (function_exists('pll_register_string')) {
        pll_register_string('readmore', 'Read More', 'arab-fund', false);
        pll_register_string('download', 'Download', 'arab-fund', false);
        pll_register_string('view-previous-issues', 'View Previous Issues', 'arab-fund', false);
        pll_register_string('reset', 'Reset', 'arab-fund', false);
        pll_register_string('filter', 'Filter', 'arab-fund', false);
        pll_register_string('to-date', 'To Date', 'arab-fund', false);
        pll_register_string('from-date', 'From Date', 'arab-fund', false);
        pll_register_string('searck-keyword', 'Search with a keyword here', 'arab-fund', false);
        pll_register_string('keyword', 'Keyword', 'arab-fund', false);
        pll_register_string('view-details', 'View Details', 'arab-fund', false);
        pll_register_string('photo-title', 'There is a lot going on throughout the year at arabfund. Here is Photo Gallery.', 'arab-fund', false);
        pll_register_string('video-title', 'There is a lot going on throughout the year at arabfund. Here is Video Gallery.', 'arab-fund', false);
        pll_register_string('sort-by', 'Sort by', 'arab-fund', false);
        pll_register_string('publish-date', 'Publish Date', 'arab-fund', false);

        pll_register_string('title', 'Title', 'arab-fund', false);
        pll_register_string('attachment', 'Attachment', 'arab-fund', false);

        pll_register_string('January', 'January', 'arab-fund', false);
        pll_register_string('February', 'February', 'arab-fund', false);
        pll_register_string('March', 'March', 'arab-fund', false);
        pll_register_string('April', 'April', 'arab-fund', false);
        pll_register_string('May', 'May', 'arab-fund', false);
        pll_register_string('June', 'June', 'arab-fund', false);
        pll_register_string('July', 'July', 'arab-fund', false);
        pll_register_string('August', 'August', 'arab-fund', false);
        pll_register_string('September', 'September', 'arab-fund', false);
        pll_register_string('October', 'October', 'arab-fund', false);
        pll_register_string('November', 'November', 'arab-fund', false);
        pll_register_string('December', 'December', 'arab-fund', false);
        pll_register_string('News', 'News', 'arab-fund', false);
        pll_register_string('Event', 'Event', 'arab-fund', false);
        pll_register_string('Activity', 'Activity', 'arab-fund', false);
        pll_register_string('Current Events', 'Current Events', 'arab-fund', false);
        pll_register_string('Canceled Events', 'Canceled Events', 'arab-fund', false);
        pll_register_string('Upcoming Events', 'Upcoming Events', 'arab-fund', false);
        pll_register_string('Past event', 'Past event', 'arab-fund', false);
        pll_register_string('Monday', 'Monday', 'arab-fund', false);
        pll_register_string('Tuesday', 'Tuesday', 'arab-fund', false);
        pll_register_string('Wednesday', 'Wednesday', 'arab-fund', false);
        pll_register_string('Thursday ', 'Thursday', 'arab-fund', false);
        pll_register_string('Friday ', 'Friday', 'arab-fund', false);
        pll_register_string('Saturday ', 'Saturday', 'arab-fund', false);
        pll_register_string('Sunday', 'Sunday', 'arab-fund', false);
        pll_register_string('AM ', 'AM', 'arab-fund', false);
        pll_register_string('PM', 'PM', 'arab-fund', false);
        pll_register_string('Select', 'Select', 'arab-fund', false);
        pll_register_string('submit-btn', 'Submit', 'arab-fund', false);
        pll_register_string('am', 'AM', 'arab-fund', false);
        pll_register_string('search-query-title', 'Search results for:', 'arab-fund', false);
        pll_register_string('country-detail', 'Country Details', 'arab-fund', false);
        pll_register_string('search-no-results', "It seems we can't find what you're looking for.", 'arab-fund', false);
        pll_register_string('Approved Loans', 'Approved Loans', 'arab-fund', false);
        pll_register_string('Approved Grants', 'Approved Grants', 'arab-fund', false);
        pll_register_string('Signed Loans', 'Signed Loans', 'arab-fund', false);

    }
}
/**
 *  Function for display translated string
 */
function arabfund_str_display($string)
{
    if (function_exists('pll__')) {
        return pll__($string);
    }
    return $string;
}

/**
 *  Admin custom post bredcrumb
 */

add_action('edit_form_top', 'arabfund_post_breadcrumb');
function arabfund_post_breadcrumb($post)
{
    if ($post->post_type != 'post' && $post->post_type != 'page') {
        $post = $post->post_type;
        $arabfund_posts = 'arabfund-posts';
        $arabfund_tender_posts = 'arabfund-tender-posts';
        $add_new_url = get_admin_url() . 'post-new.php?post_type=' . $post;
        $view_url = get_admin_url() . 'edit.php?post_type=' . $post;
        $arabfund_post_url = get_admin_url() . 'admin.php?page=' . $arabfund_posts;
        $tender_post_url = get_admin_url() . 'admin.php?page=' . $arabfund_tender_posts;

        $arabfund_posts_array = array('videos', 'albums');
        $tender_posts_array = array('tender_plan');

        $post_name = $post;
        if (strpos($post, '-') !== false) {
            $post_name = str_replace("-", " ", $post);
        }
        if (strpos($post, '_') !== false) {
            $post_name = str_replace("_", " ", $post);
        }

        $html =
            '<ul class="arabfund-breadcrumb">';
        if (in_array($post, $arabfund_posts_array) && (current_user_can('administrator') || current_user_can('editor'))) {
            $html .= '<li><a href="' . $arabfund_post_url . '">arabfund Posts</a></li>';
        }
        if (in_array($post, $tender_posts_array) && (current_user_can('administrator') || current_user_can('editor'))) {
            $html .= '<li><a href="' . $tender_post_url . '">arabfund Tender Posts</a></li>';
        }
        $html .=
            '<li><a href="' . $view_url . '">All ' . ucwords($post_name) . '</a></li>
        </ul>';
        echo $html;
    }
}


/**
 *  Remove CPT & Pages based on User capability & role
 */

/**
 *  Add nav menu for editor role
 */
add_action('admin_menu', 'add_nav_menus_link_for_editor');
function add_nav_menus_link_for_editor()
{
    if (!current_user_can('editor')) {
        return;
    }
    // Custom link to the nav menus page
    add_menu_page(
        __('Menus'),
        __('Menus'),
        'edit_others_posts',
        '?options=nav-menus.php', // I didn't get 'nav-menus.php' working directly here
        '',
        'dashicons-menu',
        90
    );
    // remove themes menu page, would be visible otherwise when user is on menu editing page and has the edit_theme_options capability
    remove_menu_page('themes.php');
}

/**
 *  Add redirection to redirect on nav menu page
 */
add_action('admin_init', 'redirect_to_nav_menu_page');
function redirect_to_nav_menu_page()
{
    if (current_user_can('editor') && isset($_GET['options']) && 'nav-menus.php' === $_GET['options']) {
        wp_redirect(admin_url('nav-menus.php'));
        die;
    }
}

/**
 *  Pagination function
 */
function arabfund_post_pagination($query)
{
    $pagination = paginate_links(array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'total' => $query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'format' => '?paged=%#%',
        'show_all' => false,
        'type' => 'list',
        'end_size' => 2,
        'mid_size' => 1,
        'prev_next' => false,
        'prev_text' => sprintf('<i></i> %1$s', __('Newer Posts', 'arab-fund')),
        'next_text' => sprintf('%1$s <i></i>', __('Older Posts', 'arab-fund')),
        'add_args' => false,
        'add_fragment' => '',
    ));
    return $pagination;
}
/**
 *  Pagination function
 */
function arabfund_acf_pagination($current_page, $total_pages)
{
    $pagination = paginate_links(array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'total' => $total_pages,
        'current' => $current_page,
        'format' => '?paged=%#%',
        'show_all' => false,
        'type' => 'list',
        'end_size' => 2,
        'mid_size' => 1,
        'prev_next' => false,
        'prev_text' => sprintf('<i></i> %1$s', __('Newer Posts', 'arab-fund')),
        'next_text' => sprintf('%1$s <i></i>', __('Older Posts', 'arab-fund')),
        'add_args' => false,
        'add_fragment' => '',
    ));
    return $pagination;
}

/**
 *  Search form action changed based on language
 */
add_action('wp_footer', 'arabfund_search', 100);
function arabfund_search()
{
    if (pll_current_language() == 'ar') { ?>
        <script>
            jQuery(document).ready(function () {
                var url = '<?php echo PLL()->curlang->search_url ?>';
                jQuery('form.bdt-search').submit(function () {
                    jQuery('.bdt-search').prop('action', url);
                });
            });   
        </script>
        <?php
    }
}

/**
 *  Add Shortcode for Album
 */
add_shortcode('albums_arabfund_shortcode', 'albums_arabfund');
function albums_arabfund()
{
    ob_start();
    $data = "";
    $per_page = -1;
    $query = new WP_Query(array(
        'post_type' => 'albums',
        'posts_per_page' => $per_page,
    ));
    /*$data .= '<div class="site-loader">
        <img src="'.get_stylesheet_directory_uri() . '/assets/images/site-loader.svg" alt="">
    </div>';*/
    $data .= '<div class="container media-sec">
              <div class="mg-f">
                  <div class="mg-t">
                      <p>' . arabfund_str_display('There is a lot going on throughout the year at arabfund. Here is Photo Gallery.') . '</p>
                  </div>
                  <div class="form-strip-inner select2-dropdown-wrapper drophide_temp">
                      <label>' . arabfund_str_display('Sort by') . '</label>
                           <form method="post">
                                <select name="album_date" id="album_date" class="select2-dropdown" onchange="this.form.submit()">
                                    <option value="all">' . arabfund_str_display('Publish Date') . '</option>';
    if ($query->have_posts()):
        $date_array = array();
        while ($query->have_posts()):
            $query->the_post();

            $current_month = date('d-m-Y');
            $album_publish_date = get_field('album_publish_date');

            if ($album_publish_date) {
                $album_publish_date = str_replace('/', '-', $album_publish_date);
                $date_format = date_create($album_publish_date);
                $publish_date = date_format($date_format, "d-m-Y");
                $publish_month = date_format($date_format, "m");
                $publish_year = date_format($date_format, "Y");
                $date = $publish_month . '-' . $publish_year;
                $album_date = arabfund_str_display(date_format($date_format, "F")) . ' ' . $publish_year;
                //echo $date = DateTime::createFromFormat('Ymd', $publish_date);

                $d1 = new DateTime($current_month);
                $d2 = new DateTime($publish_date);
                $interval = $d1->diff($d2);
                $month = $interval->m;

                if (!in_array($date, $date_array) && $month < 8) {
                    $selected = '';
                    if (isset($_REQUEST['album_date']) && $date == $_REQUEST['album_date']) {
                        $selected = 'selected';
                    }
                    array_push($date_array, $date);
                    $data .= '<option value="' . $date . '" ' . $selected . '>' . $album_date . '</option>';
                }
            }
        endwhile;
    endif;
    wp_reset_query();
    $data .= '
                                </select>
                                <input type="hidden" name="submit_date">
                            </form>    
                  </div>
              </div>
            </div>';
    $data .= '<div class="container album_section">';

    if (isset($_REQUEST['submit_date'])) {
        if (isset($_REQUEST['album_date']) && $_REQUEST['album_date'] != 'all') {
            $publish_date = $_REQUEST['album_date'];
            $date = explode("-", $publish_date);
            $month = $date[0];
            $year = $date[1];

            $lastday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $from_date = $year . '-' . $month . '-01';
            $to_date = $year . '-' . $month . '-' . $lastday;

            $query = new WP_Query(array(
                'post_type' => 'albums',
                //'category_name' => 'image_en',
                'posts_per_page' => $per_page,
                'meta_query' => array(
                    array(
                        'key' => 'album_publish_date',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));

            $count = $query->found_posts;
        }
    }
    if ($query->have_posts()):
        $data .= '<div class="media-gallery">';

        while ($query->have_posts()):
            $query->the_post();
            $mediaimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($mediaimg == "") {
                $mediaimg = "/arabfund/wp-content/themes/arab-fund/assets/images/no_img_gallery.jpg";
            }
            $album_images = get_field('album_images', get_the_ID());
            //$imgcount = count($album_images);
            if (!empty($album_images)) {
                $imgcount = count($album_images);
            }
            $album_publish_date = get_field('album_publish_date');
            $pub_date = '';
            if ($album_publish_date) {
                $album_publish_date = str_replace('/', '-', $album_publish_date);
                $date_format = date_create($album_publish_date);
                $day = date_format($date_format, "d");
                $month = date_format($date_format, "F");
                $year = date_format($date_format, "Y");
                //$pub_date = $day.'-'.arabfund_str_display($month).'-'.$year;
                $pub_date = $year;
            }
            $data .= '<a href="' . get_permalink() . '" >
                                      <div class="photo-box">
                                        <div class="gallery_img">
                                        <img src="' . $mediaimg . '" alt="' . get_field('album_name') . '">
                                          <div class="photo-info">
                                            <h6>' . $imgcount . ' <span class="en_view"> Images</span><span class="ar_view">الصور</span></h6>
                                            <span class="pub-date">' . $pub_date . '</span>
                                            </div>
                                          </div>
                                        </div>
                                  </a>';
            //       $data .= '<a href="'.get_permalink().'" >
            //       <div class="photo-box">
            //         <div class="gallery_img">
            //         <img src="'. $mediaimg .'" alt="' . get_field('album_name') . '">
            //           <div class="photo-info">
            //             <span class="pub-date">'.$pub_date.'</span>
            //             </div>
            //           </div>
            //         </div>
            //   </a>';
        endwhile;

        $data .= '</div>';
    endif;
    wp_reset_query();
    $data .= '
    </div>';
    return $data;
}

/**
 *  This Ajax function get Album details
 */
add_action('wp_ajax_get_album_data', 'arab_get_albums');
add_action('wp_ajax_nopriv_get_album_data', 'arab_get_albums');

function arabfund_get_albums()
{
    $publish_date = $_POST['publish_date'];
    $posts = get_post($post_id);
    $content = $posts->post_content;
    $image = get_the_post_thumbnail_url($post_id, 'full');
    $date = get_the_date('F Y', $post_id);
    $html = "";

    if (isset($_POST['page'])) {

        $page = sanitize_text_field($_POST['page']);
        $cur_page = $page;
        $page -= 1;
        // Set the number of results to display
        $per_page = 9;
        $previous_btn = false;
        $next_btn = false;
        $first_btn = false;
        $last_btn = false;
        $start = $page * $per_page;

        if ($publish_date == 'all') {
            $query = new WP_Query(array(
                'post_type' => 'albums',
                'posts_per_page' => $per_page,
                'offset' => $start,
            ));

            $count = $query->found_posts;
        } else {
            $date = explode("-", $publish_date);
            $month = $date[0];
            $year = $date[1];

            $lastday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $from_date = $year . '-' . $month . '-01';
            $to_date = $year . '-' . $month . '-' . $lastday;

            $query = new WP_Query(array(
                'post_type' => 'albums',
                //'category_name' => 'image_en',
                'posts_per_page' => $per_page,
                'offset' => $start,
                'meta_query' => array(
                    array(
                        'key' => 'album_publish_date',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));

            $count = $query->found_posts;
        }

        if ($query->have_posts()):
            $html .= '<div class="media-gallery">';

            while ($query->have_posts()):
                $query->the_post();
                $mediaimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
                if ($mediaimg == "") {
                    $mediaimg = "/arabfund/wp-content/themes/arab-fund/assets/images/no_img_gallery.jpg";
                }
                $imgcount = count(get_field('album_images'));

                $html .= '<a href="' . get_permalink() . '">
                                  <div class="photo-box">
                                    <img class="gallery_img" src="' . $mediaimg . '" alt="' . get_field('album_name') . '">
                                      <div class="photo-info">
                                        <h6><img src="/arabfund/wp-content/uploads/2022/04/Icon-photo.svg">' . $imgcount . ' <span class="en_view">Photos</span><span class="ar_view">الصور</span></h6>
                                        <p>' . get_the_title() . '</p>
                                      </div>
                                    </div>
                              </a>';
            endwhile;

            $html .= '</div>';
        endif;
        wp_reset_query();
        // Optional, wrap the output into a container
        $msg = "<div class='cvf-universal-content'>" . $msg . "</div><br class = 'clear' />";

        // This is where the magic happens
        if ($count > $per_page) {
            $no_of_paginations = ceil($count / $per_page);

            if ($cur_page >= 7) {
                $start_loop = $cur_page - 3;
                if ($no_of_paginations > $cur_page + 3)
                    $end_loop = $cur_page + 3;
                else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                    $start_loop = $no_of_paginations - 6;
                    $end_loop = $no_of_paginations;
                } else {
                    $end_loop = $no_of_paginations;
                }
            } else {
                $start_loop = 1;
                if ($no_of_paginations > 7)
                    $end_loop = 7;
                else
                    $end_loop = $no_of_paginations;
            }

            // Pagination Buttons logic     
            $html .= "
            <div class='pagination arabfund-pagination ajax-arabfund-pagination'>
                <ul class='page-numbers'>";

            if ($first_btn && $cur_page > 1) {
                $html .= "<li p='1' class='active'>First</li>";
            } else if ($first_btn) {
                $html .= "<li p='1' class='inactive'>First</li>";
            }

            if ($previous_btn && $cur_page > 1) {
                $pre = $cur_page - 1;
                $html .= "<li p='$pre' class='active'>Previous</li>";
            } else if ($previous_btn) {
                $html .= "<li class='inactive'>Previous</li>";
            }
            for ($i = $start_loop; $i <= $end_loop; $i++) {

                if ($cur_page == $i)
                    $html .= "<li p='$i' class = 'selected' ><span class='page-numbers current'>{$i}</span></li>";
                else
                    $html .= "<li p='$i'><a>{$i}</a></li>";
            }

            if ($next_btn && $cur_page < $no_of_paginations) {
                $nex = $cur_page + 1;
                $html .= "<li p='$nex' class='active'>Next</li>";
            } else if ($next_btn) {
                $html .= "<li class='inactive'>Next</li>";
            }

            if ($last_btn && $cur_page < $no_of_paginations) {
                $html .= "<li p='$no_of_paginations' class='active'>Last</li>";
            } else if ($last_btn) {
                $html .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
            }

            $html .= "
                </ul>
            </div>";
        }
        $data = json_encode(array('success' => true, 'content' => $html));
        echo $data;
    }

    wp_die();
}

/**
 *  Add Shortcode for Album/Gallery Single page
 */
add_shortcode('albumsid_arabfund_shortcode', 'albumsid_arabfund');
function albumsid_arabfund()
{
    ob_start();
    //global $page_id;
    global $post;

    if (pll_current_language() == 'ar') {
        $gallery_title = get_field('arabic_album_name', 157);
    } else {
        $gallery_title = get_field('album_name', 157);
    }

    $gallery = get_field('album_images', $post->ID);

    // print_r($gallery);
    /*$images = array();

    $items_per_page = 9;
    $total_items = count($gallery);
    $size = 'full'; 
    $total_pages = ceil($total_items / $items_per_page);

    if(get_query_var('paged')){
      $current_page = get_query_var('paged');
    }elseif (get_query_var('page')) {
      $current_page = get_query_var('page');
    }else{
        $current_page = 1;
    }
    $starting_point = (($current_page-1)*$items_per_page);

    if($gallery){
        $images = array_slice($gallery,$starting_point,$items_per_page);
    }*/
    $html = '<div class="container">';
    if ($gallery) {
        $html .= '<div class="media-gallery">';
        $no = 0;
        foreach ($gallery as $image):
            $html .= '<a href="' . wp_get_attachment_url(get_field('album_images')[$no], $page_id) . '" data-fancybox="images" >
                <div class="mg-fb">
                    <img src="' . wp_get_attachment_url(get_field('album_images')[$no], $page_id) . '">
                </div>
            </a>';
            $no++;
        endforeach;

        $html .= '</div>';

    }
    $html .= '</div>';


    return $html;
}

/**
 *  Add Shortcode for Video page
 */
add_shortcode('video_arabfund_shortcode', 'video_arabfund');
function video_arabfund()
{
    ob_start();
    $data = "";
    $per_page = -1;
    $query = new WP_Query(array(
        'post_type' => 'videos',
        'posts_per_page' => $per_page,
    ));
    $count = $query->found_posts;
    /*$data .= '<div class="site-loader">
        <img src="'.get_stylesheet_directory_uri() . '/assets/images/site-loader.svg" alt="">
    </div>';*/
    $data .= '<div class="container media-sec">
              <div class="mg-f">
                  <div class="mg-t">
                        <p>' . arabfund_str_display('There is a lot going on throughout the year at arabfund. Here is Video Gallery.') . '</p>
                  </div>
                  <div class="form-strip-inner select2-dropdown-wrapper drophide_temp">
                      <label>' . arabfund_str_display('Sort by') . '</label>
                        <form method="post">
                            <select name="video_date" id="video_date" class="select2-dropdown" onchange="this.form.submit()">
                                <option value="all">' . arabfund_str_display('Publish Date') . '</option>';
    if ($query->have_posts()):
        $date_array = array();
        while ($query->have_posts()):
            $query->the_post();
            $current_month = date('d-m-Y');
            $video_publish_date = get_field('video_publish_date');

            if ($video_publish_date) {
                $video_publish_date = str_replace('/', '-', $video_publish_date);
                $date_format = date_create($video_publish_date);
                $publish_date = date_format($date_format, "d-m-Y");
                $publish_month = date_format($date_format, "m");
                $publish_year = date_format($date_format, "Y");
                $date = $publish_month . '-' . $publish_year;
                //$video_date = date_format($date_format,"F Y");
                $video_date = arabfund_str_display(date_format($date_format, "F")) . ' ' . $publish_year;

                $d1 = new DateTime($current_month);
                $d2 = new DateTime($publish_date);
                $interval = $d1->diff($d2);
                $month = $interval->m;

                if (!in_array($date, $date_array) && $month < 6) {
                    $selected = '';
                    if (isset($_REQUEST['video_date']) && $date == $_REQUEST['video_date']) {
                        $selected = 'selected';
                    }
                    array_push($date_array, $date);
                    $data .= '<option value="' . $date . '" ' . $selected . '>' . $video_date . ' </option>';
                }
            }
        endwhile;
    endif;
    wp_reset_query();
    $data .=
        '</select>
                            <input type="hidden" name="submit_date">
                        </form>    
                  </div>
              </div>
            </div>';

    $data .= '<div class="container video-section">';

    if (isset($_REQUEST['submit_date'])) {
        if (isset($_REQUEST['video_date']) && $_REQUEST['video_date'] != 'all') {
            $publish_date = $_REQUEST['video_date'];
            $date = explode("-", $publish_date);
            $month = $date[0];
            $year = $date[1];

            $lastday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $from_date = $year . '-' . $month . '-01';
            $to_date = $year . '-' . $month . '-' . $lastday;

            $query = new WP_Query(array(
                'post_type' => 'videos',
                //'category_name' => 'image_en',
                'posts_per_page' => $per_page,
                'meta_query' => array(
                    array(
                        'key' => 'video_publish_date',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));

            $count = $query->found_posts;
        }
    }

    if ($query->have_posts()):
        $data .= '<div class="video-gallery">';
        while ($query->have_posts()):
            $query->the_post();
            $videoimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($videoimg == "") {
                $videoimg = "/arabfund/wp-content/uploads/2022/04/no_video.png";
            }
            $video_publish_date = get_field('video_publish_date');
            $pub_date = '';
            if ($video_publish_date) {
                $video_publish_date = str_replace('/', '-', $video_publish_date);
                $date_format = date_create($video_publish_date);
                $day = date_format($date_format, "d");
                $month = date_format($date_format, "F");
                $year = date_format($date_format, "Y");
                $pub_date = $year;
            }
            $data .= '<div class="video-block" >
                                    <div class="video-box">
                                                <a href="' . get_field('video_url') . '" data-fancybox="images" class="video-thumbnail">
                                                    <video src="' . get_field('video_url') . '" poster="' . $videoimg . '"></video>
                                                </a>
                                                <div class="video-info">
                                                    <h6><span class="en_view">Video</span><span class="ar_view">فيديو</span></h6>
                                                    <span class="pub-date">' . $pub_date . '</span>
                                                    <p>' . get_field('name_video') . '</p>
                                                   
                                                </div>
                                    </div>
                                </div>';
        endwhile;
        $data .= '</div>';
    endif;
    wp_reset_query();

    $data .= ' 
            </div>';
    $data .= '<div class="video-pagination-container"></div>';
    return $data;
}

/**
 *  This Ajax function get Album details
 */
add_action('wp_ajax_get_video_data', 'arab_get_video');
add_action('wp_ajax_nopriv_get_video_data', 'arab_get_video');

function arab_get_video()
{
    $publish_date = $_POST['publish_date'];
    $posts = get_post($post_id);
    $content = $posts->post_content;
    $image = get_the_post_thumbnail_url($post_id, 'full');
    $date = get_the_date('F Y', $post_id);
    $html = "";

    if (isset($_POST['page'])) {

        $page = sanitize_text_field($_POST['page']);
        $cur_page = $page;
        $page -= 1;
        // Set the number of results to display
        $per_page = 9;
        $previous_btn = false;
        $next_btn = false;
        $first_btn = false;
        $last_btn = false;
        $start = $page * $per_page;

        if ($publish_date == 'all') {
            $query = new WP_Query(array(
                'post_type' => 'videos',
                'posts_per_page' => $per_page,
                'offset' => $start,
            ));

            $count = $query->found_posts;
        } else {
            $date = explode("-", $publish_date);
            $month = $date[0];
            $year = $date[1];

            $lastday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $from_date = $year . '-' . $month . '-01';
            $to_date = $year . '-' . $month . '-' . $lastday;

            $query = new WP_Query(array(
                'post_type' => 'videos',
                //'category_name' => 'image_en',
                'posts_per_page' => $per_page,
                'offset' => $start,
                'meta_query' => array(
                    array(
                        'key' => 'video_publish_date',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));

            $count = $query->found_posts;
        }

        if ($query->have_posts()):
            $html .= '<div class="video-gallery">';
            while ($query->have_posts()):
                $query->the_post();
                $videoimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
                if ($videoimg == "") {
                    $videoimg = "/arabfund/wp-content/uploads/2022/04/no_video.png";
                }
                $html .= '<div class="video-block">
                            <div class="video-box">
                                        <a href="' . get_field('video_url') . '" data-fancybox="images" class="video-thumbnail">
                                            <video src="' . get_field('video_url') . '" poster="' . $videoimg . '"></video>
                                        </a>
                                        <div class="video-info">
                                            <h6><span class="en_view">Video</span><span class="ar_view">فيديو</span></h6>
                                            <p>' . get_field('name_video') . '</p>
                                           
                                        </div>
                            </div>
                        </div>';
            endwhile;
            $html .= '</div>';
        endif;
        wp_reset_query();
        // Optional, wrap the output into a container
        $msg = "<div class='cvf-universal-content'>" . $msg . "</div><br class = 'clear' />";

        // This is where the magic happens
        if ($count > $per_page) {
            $no_of_paginations = ceil($count / $per_page);

            if ($cur_page >= 7) {
                $start_loop = $cur_page - 3;
                if ($no_of_paginations > $cur_page + 3)
                    $end_loop = $cur_page + 3;
                else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                    $start_loop = $no_of_paginations - 6;
                    $end_loop = $no_of_paginations;
                } else {
                    $end_loop = $no_of_paginations;
                }
            } else {
                $start_loop = 1;
                if ($no_of_paginations > 7)
                    $end_loop = 7;
                else
                    $end_loop = $no_of_paginations;
            }

            // Pagination Buttons logic     
            $html .= "
            <div class='pagination arabfund-pagination ajax-arabfund-pagination'>
                <ul class='page-numbers'>";

            if ($first_btn && $cur_page > 1) {
                $html .= "<li p='1' class='active'>First</li>";
            } else if ($first_btn) {
                $html .= "<li p='1' class='inactive'>First</li>";
            }

            if ($previous_btn && $cur_page > 1) {
                $pre = $cur_page - 1;
                $html .= "<li p='$pre' class='active'>Previous</li>";
            } else if ($previous_btn) {
                $html .= "<li class='inactive'>Previous</li>";
            }
            for ($i = $start_loop; $i <= $end_loop; $i++) {

                if ($cur_page == $i)
                    $html .= "<li p='$i' class = 'selected' ><span class='page-numbers current'>{$i}</span></li>";
                else
                    $html .= "<li p='$i'><a>{$i}</a></li>";
            }

            if ($next_btn && $cur_page < $no_of_paginations) {
                $nex = $cur_page + 1;
                $html .= "<li p='$nex' class='active'>Next</li>";
            } else if ($next_btn) {
                $html .= "<li class='inactive'>Next</li>";
            }

            if ($last_btn && $cur_page < $no_of_paginations) {
                $html .= "<li p='$no_of_paginations' class='active'>Last</li>";
            } else if ($last_btn) {
                $html .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
            }

            $html .= "
                </ul>
            </div>";
        }
        $data = json_encode(array('success' => true, 'content' => $html));
        echo $data;
    }

    wp_die();
}



// Custom post type script start from here
function arabfund_meeting()
{
    ob_start();

    $data .= '<div class="meeting-container">';
    //$query = new WP_Query('post_type=meetings&showposts=4&order=DES'); 
    $query = new WP_Query(array(
        'post_type' => 'meetings',
        'posts_per_page' => 4,
        'meta_key' => 'meeting_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',

    ));
    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();


        $data .= '<div class="meeting-box">
       <div class="meeting_details">
          <h2>' . get_field("meeting_title") . '</h2>
          <p>' . get_field("meeting_description") . '.</p>
        </div>
          <a href="' . get_permalink() . '" target="_self"> <span class="ar_view">اقرأ أكثر </span><span class="en_view">Read More</span></a>
    </div>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_meeting_shartcode', 'arabfund_meeting'); /// end meeting





// Custom post type for Event News
function arabfund_newsevent_home()
{
    ob_start();

    $data .= '<div class="events_container">';
    //   $query = new WP_Query('post_type=news_or_activity&showposts=3&order=desc'); 
    $query = new WP_Query(array(
        'post_type' => 'news_or_activity',
        'posts_per_page' => 3,
        'meta_key' => 'newsevent_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',

    ));
    while ($query->have_posts()):
        $query->the_post();
        $eventnewsimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($eventnewsimg == "") {
            $eventnewsimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_logo.jpg";
        }
        $post_id = get_the_ID();
        $categories = get_the_terms($post_id, 'news_or_activity_type');
        $arabdate = get_field('newsevent_date');
        if ($arabdate) {
            $to = str_replace('/', '-', $arabdate);
            //$arabevent_date = date("d-F-Y", strtotime($to));
            $day = date("d", strtotime($to));
            $month = date("F", strtotime($to));
            $year = date("Y", strtotime($to));
            $event_news_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
        }



        $data .= ' <div class="event_box">
                      <div class="event_image">
                          <img src="' . $eventnewsimg . '" alt="' . $eventnewsimg . '">
                      </div>
                      <div class="event_details">
                          <div class="event_type">';
        if (is_array($categories)) {
            $data .= '
                              <ul class="event_type_list">';
            foreach ($categories as $key => $cat) {
                $newseventname = $cat->name;
                $data .= '<li id="' . $cat->name . '">' . arabfund_str_display($newseventname) . '</li>';
            }
            $data .= '    
                               </ul>';
        }
        $data .= ' 
						  </div>
                          <p class="event_date"><img src="/arabfund/wp-content/uploads/2023/11/calendar_icon.svg" alt="date-icon"><span>' . $event_news_date . '</span> </p>
                          <p class="event_description">' . get_field("short_description") . '</p>
                          <a href="' . get_permalink() . '" target="_self"> <span class="ar_view">اقرأ أكثر </span><span class="en_view">Read More</span>  <img src="/arabfund/wp-content/uploads/2024/01/green_arrow_event.svg" alt="readmore-icon" class="green_arrow"></a>
                      </div>
                  </div>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_newsevent_home_shartcode', 'arabfund_newsevent_home'); /// end homepage arabfund News Event Section



// country List Shortcode Start
function coutry_listview()
{
    ob_start();
    $data .= '<div id="maps_list_view"><div class="coutry_container" >';

    $query = new WP_Query('post_type=countries&showposts=-1&order=ASC&orderby=title');
    while ($query->have_posts()):
        $query->the_post();
        $countryImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($countryImg == "") {
            $countryImg = "/arabfund/wp-content/uploads/2023/09/no_img.svg";
        }
        $post_id = get_the_ID();


        $data .= '<div class="country_box">          
				  <a href="' . get_permalink() . '" target="_self">
				  <img src=" ' . $countryImg . ' " alt=' . get_field("job_post_date") . '>
				  <h2>' . get_the_title() . '</h2></a>
			</div>';


    endwhile;
    wp_reset_query();

    $data .= '</div></div>';

    return $data;
}
add_shortcode('coutry_listview_shartcode', 'coutry_listview');



// Annual Report List Shortcode Start
function annual_report_list()
{
    ob_start();
    $title = $from_date = $to_date = $start_date = $end_date = '';
    $per_page = -1;
    $page = get_query_var('paged') ? get_query_var('paged') : 1;
    if (isset($_POST['filter_btn'])) {
        $title = !empty(filter_var($_POST['title'], FILTER_SANITIZE_STRING)) ? filter_var($_POST['title'], FILTER_SANITIZE_STRING) : '';
        if (!empty(filter_var($_POST['from_date'], FILTER_SANITIZE_STRING))) {
            $start_date = filter_var($_POST['from_date'], FILTER_SANITIZE_STRING);
            $from = str_replace('/', '-', $_POST['from_date']);
            $from_date = date("Y-m-d", strtotime($from));
        }
        if (!empty(filter_var($_POST['to_date'], FILTER_SANITIZE_STRING))) {
            $end_date = filter_var($_POST['to_date'], FILTER_SANITIZE_STRING);
            $to = str_replace('/', '-', $_POST['to_date']);
            $to_date = date("Y-m-d", strtotime($to));
        }
        if (!empty($_POST['title'])) {
            $query = new WP_Query(array(
                'post_type' => 'annual_reports',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    array(
                        'key' => 'annual_report_title',
                        'value' => $title,
                        'compare' => 'LIKE',
                    ),
                ),
            ));
        }
        if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'annual_reports',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    array(
                        'key' => 'annual_report_year',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (!empty($_POST['title']) && !empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'annual_reports',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'annual_report_title',
                        'value' => $title,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'annual_report_year',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (empty($_POST['title']) && !empty($_POST['from_date']) && empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'annual_reports',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'annual_report_year',
                        'value' => $from_date,
                        'compare' => '>=',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (empty($_POST['title']) && empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'annual_reports',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'annual_report_year',
                        'value' => $to_date,
                        'compare' => '<=',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (empty($_POST['title']) && empty($_POST['from_date']) && empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'annual_reports',
                'posts_per_page' => $per_page,
                'paged' => $page,
            ));
        }
    } else {
        $query = new WP_Query(array(
            'post_type' => 'annual_reports',
            'posts_per_page' => $per_page,
            'paged' => $page,
            'meta_key' => 'annual_report_year',
            'orderby' => 'meta_value',
            'order' => 'DESC',
        ));
    }

    $data = '<div class="filter_sec">
              <form method="post" name="filter_frm" autocomplete="off">
                <div class="search_sec">
                  <input type="text" name="title" placeholder="' . arabfund_str_display('Keyword') . '" value="' . filter_var($title, FILTER_SANITIZE_STRING) . '"/>
                </div>
                <div class="date_sec">
                  <input type="text" name="from_date" id="from" placeholder="' . arabfund_str_display('From Date') . '" value="' . $start_date . '"/>
                  <a href="javascript:void(0)" class="from-date-icon"><img src="' . get_stylesheet_directory_uri() . '/assets/images/date.svg" /></a>
                </div>
                <div class="date_sec">
                  <input type="text" name="to_date" id="to" placeholder="' . arabfund_str_display('To Date') . '" value="' . $end_date . '"/>
                  <a href="javascript:void(0)" class="to-date-icon"><img src="' . get_stylesheet_directory_uri() . '/assets/images/date.svg" /></a>
                </div>
                <div class="btn_sec">                  
                  <input type="button" value="' . arabfund_str_display('Reset') . '" class="refresh" onClick="reloadpage()">
				  <input type="submit" name="filter_btn" class="filter-btn" value="' . arabfund_str_display('Filter') . '"/>
                </div>
              </form>  
          </div>';

    $data .= '<div class="report_container" >';

    //$query = new WP_Query('post_type=annual_reports&showposts=-1&order=ASC'); 
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            $annualreportsImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($annualreportsImg == "") {
                $annualreportsImg = "/arabfund/wp-content/themes/arab-fund/assets/images/pdficon.jpg";
            }
            $post_id = get_the_ID();


            $data .= '<a class="report_box" href="' . get_field("annual_reports_attachment") . '" target="_blank">    
                    <img src=" ' . $annualreportsImg . ' " alt=' . get_field("annual_report_titile") . '>
                    <h2 class="report_heading">' . get_field("annual_report_title") . '</h2>
                   </a>';

        endwhile;
    else:
        $data .= '<div class="not-found">
                <p>No posts found.</p>
                  </div>';
    endif;
    wp_reset_query();

    $data .= '</div>';

    $data .= '<div class="annual-pagination-container"></div>';
    return $data;
}
add_shortcode('annual_report_list_shartcode', 'annual_report_list');





// JAE Annual Report List Shortcode Start
function jae_annual_report_list()
{
    ob_start();
    $title = $from_date = $to_date = $start_date = $end_date = '';
    $per_page = 100000;
    $page = get_query_var('paged') ? get_query_var('paged') : 1;
    if (isset($_POST['filter_btn'])) {
        $title = !empty(filter_var($_POST['title'], FILTER_SANITIZE_STRING)) ? filter_var($_POST['title'], FILTER_SANITIZE_STRING) : '';
        if (!empty(filter_var($_POST['from_date'], FILTER_SANITIZE_STRING))) {
            $start_date = filter_var($_POST['from_date'], FILTER_SANITIZE_STRING);
            $from = str_replace('/', '-', $_POST['from_date']);
            $from_date = date("Y-m-d", strtotime($from));
        }
        if (!empty(filter_var($_POST['to_date'], FILTER_SANITIZE_STRING))) {
            $end_date = filter_var($_POST['to_date'], FILTER_SANITIZE_STRING);
            $to = str_replace('/', '-', $_POST['to_date']);
            $to_date = date("Y-m-d", strtotime($to));
        }
        if (!empty($_POST['title'])) {
            $query = new WP_Query(array(
                'post_type' => 'jae_annual_report',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    array(
                        'key' => 'jae_annual_report_title',
                        'value' => $title,
                        'compare' => 'LIKE',
                    ),
                ),
            ));
        }
        if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'jae_annual_report',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    array(
                        'key' => 'jae_annual_report_date',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (!empty($_POST['title']) && !empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'jae_annual_report',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'jae_annual_report_title',
                        'value' => $title,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key' => 'jae_annual_report_date',
                        'value' => array($from_date, $to_date),
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (empty($_POST['title']) && !empty($_POST['from_date']) && empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'jae_annual_report',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'jae_annual_report_date',
                        'value' => $from_date,
                        'compare' => '>=',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (empty($_POST['title']) && empty($_POST['from_date']) && !empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'jae_annual_report',
                'posts_per_page' => $per_page,
                'paged' => $page,
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'jae_annual_report_date',
                        'value' => $to_date,
                        'compare' => '<=',
                        'type' => 'DATE'
                    ),
                ),
            ));
        }
        if (empty($_POST['title']) && empty($_POST['from_date']) && empty($_POST['to_date'])) {
            $query = new WP_Query(array(
                'post_type' => 'jae_annual_report',
                'posts_per_page' => $per_page,
                'paged' => $page,
            ));
        }
    } else {
        $query = new WP_Query(array(
            'post_type' => 'jae_annual_report',
            'posts_per_page' => $per_page,
            'paged' => $page,
            'meta_key' => 'jae_annual_report_date',
            'orderby' => 'meta_value',
            'order' => 'DESC',

        ));
    }

    $data = '<div class="filter_sec">
              <form method="post" name="filter_frm" autocomplete="off">
                <div class="search_sec">
                  <input type="text" name="title" placeholder="' . arabfund_str_display('Keyword') . '" value="' . filter_var($title, FILTER_SANITIZE_STRING) . '"/>
                </div>
                <div class="date_sec">
                  <input type="text" name="from_date" id="from" placeholder="' . arabfund_str_display('From Date') . '" value="' . $start_date . '"/>
                  <a href="javascript:void(0)" class="from-date-icon"><img src="' . get_stylesheet_directory_uri() . '/assets/images/date.svg" /></a>
                </div>
                <div class="date_sec">
                  <input type="text" name="to_date" id="to" placeholder="' . arabfund_str_display('To Date') . '" value="' . $end_date . '"/>
                  <a href="javascript:void(0)" class="to-date-icon"><img src="' . get_stylesheet_directory_uri() . '/assets/images/date.svg" /></a>
                </div>
                <div class="btn_sec">
					<input type="button" value="' . arabfund_str_display('Reset') . '" class="refresh" onClick="reloadpage()">
                  <input type="submit" name="filter_btn" class="filter-btn" value="' . arabfund_str_display('Filter') . '"/>                  
                </div>
              </form>  
          </div>';

    $data .= '<div class="jae_report_container" >';

    // <!-- $query = new WP_Query('post_type=jae_annual_report&showposts=-1&order=ASC');  -->
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            // $jae_annualreportsImg = get_the_post_thumbnail_url(get_the_ID(),'full');  

            $report_eng_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($report_eng_img == "") {
                $report_eng_img = "/arabfund/wp-content/themes/arab-fund/assets/images/pdficon.jpg";
            }
            $post_id = get_the_ID();
            $report_attachment = get_field("jae_annual_report_attachment");


            $data .= '<a class="jae_report_box" href="' . get_field("jae_annual_report_attachment") . '" target="_blank">    
                            <img src=" ' . $report_eng_img . ' " alt=' . get_field("jae_annual_report_title_english") . '>
                            <h2 class="jae_report_name">' . get_field("jae_annual_report_title_english") . '</h2>
                        </a>';

        endwhile;
    else:
        $data .= '<div class="not-found">
                                <p>No posts found.</p>
                  </div>';
    endif;
    wp_reset_query();

    $data .= '</div>';
    // $data .= '<div class="pagination arab-pagination">'.arabfund_post_pagination($query).'</div>';
    $data .= '<div class="pagination-container"></div>';
    return $data;
}
add_shortcode('jaeannual_report_list_shartcode', 'jae_annual_report_list');



// Board Member List Shortcode Start
function board_members_list()
{
    ob_start();


    $data .= '<div class="team_container" >';

    $query = new WP_Query('post_type=board_members&member_type=board-of-governors&showposts=-1&order=ASC');
    //$query = new WP_Query('post_type=board_members&showposts=-1&order=ASC'); 
    while ($query->have_posts()):
        $query->the_post();
        $memberimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberimg == "") {
            $memberimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_team_logo.png";
        }
        $post_id = get_the_ID();

        $data .= '<div class="team_box">
                    <div class="team_box_wrap">
                        <div class="team_imgbox">
                            <img class="img-responsive" src=" ' . $memberimg . ' "  alt=' . get_field("member_title") . '>
                        </div>
                        <div class="team_inner">
                            <h3><span class="en_view">' . get_field("member_title") . '</span><span class="ar_view">' . get_field("member_arabic_title") . '</span></h3>
                            <div class="member-desg">
                                <h4 class=""><span class="en_view">' . get_field("member_designation") . '</span><span class="ar_view">' . get_field("member_designation_arabic") . '</span></h4>
                            </div> 
                        </div>
                    </div>
                </div>';

    endwhile;
    wp_reset_query();

    $data .= '</div>';

    $data .= '<h4 class="elementor-heading-title team_margin_top elementor-size-default"><span class="en_view">Alternate Governors</span><span class="ar_view">نواب المحافظين</span></h4>';

    $data .= '<div class="team_container team_margin_top" >';

    $query = new WP_Query('post_type=board_members&member_type=alternate-governors&showposts=-1&order=ASC');
    while ($query->have_posts()):
        $query->the_post();
        $governorimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($governorimg == "") {
            $governorimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_team_logo.png";
        }
        $post_id = get_the_ID();

        $data .= '<div class="team_box">
             <div class="team_box_wrap">
                 <div class="team_imgbox">
                     <img class="img-responsive" src="' . $governorimg . '"  alt=' . get_field("member_title") . '>
                 </div>
                 <div class="team_inner">
                     <h3><span class="en_view">' . get_field("member_title") . '</span><span class="ar_view">' . get_field("member_arabic_title") . '</span></h3>
                     <div class="member-desg">
                         <h4><span class="en_view">' . get_field("member_designation") . '</span><span class="ar_view">' . get_field("member_designation_arabic") . '</span></h4>
                     </div> 
                 </div>
             </div>
         </div>';

    endwhile;
    wp_reset_query();
    $data .= '</div>';


    return $data;
}
add_shortcode('board_members_list_shartcode', 'board_members_list');




// Board Member List Shortcode Start
function manager_directors_of_board_list()
{
    ob_start();


    $data .= '<h4 class="elementor-heading-title team_margin_top elementor-size-default"><span class="en_view">Director General/Chairman of the Board of Directors </span><span class="ar_view"> المدير العام / رئيس مجلس الإدارة</span></h4>';

    $data .= '<div class="team_container team_margin_top" >';

    $query = new WP_Query('post_type=directors&director_type=general-manager-chairman&showposts=-1&order=ASC');
    //$query = new WP_Query('post_type=board_members&showposts=-1&order=ASC'); 
    while ($query->have_posts()):
        $query->the_post();
        $memberimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberimg == "") {
            $memberimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_team_logo.png";
        }
        $post_id = get_the_ID();

        $data .= '<div class="team_box">
                  <div class="team_box_wrap">
                      <div class="team_imgbox">
                          <img class="img-responsive" src=" ' . $memberimg . ' "  alt=' . get_field("member_title") . '>
                      </div>
                      <div class="team_inner">
                          <h3><span class="en_view">' . get_field("full_name") . '</span><span class="ar_view">' . get_field("arabic_name") . '</span></h3>';

        $designation = get_field("designation");
        $arabicdesignation = get_field("designation_arabic");
        if ($designation == "" && $arabicdesignation == "") {
            $nodesignation = "no_desg";
        }
        $data .= ' <div class="member-desg ' . $nodesignation . '">
                       <h4><span class="en_view">' . get_field("designation") . '</span><span class="ar_view">' . get_field("designation_arabic") . '</span></h4>
                          </div> 
                      </div>
                  </div>
              </div>';

    endwhile;
    wp_reset_query();

    $data .= '</div>';

    $data .= '<h4 class="elementor-heading-title team_margin_top elementor-size-default"><span class="en_view">Members of the Board  </span><span class="ar_view">أعضاء مجلس الإدارة</span></h4>';

    $data .= '<div class="team_container team_margin_top" >';

    $query = new WP_Query('post_type=directors&director_type=members-of-the-board&showposts=-1&order=ASC');
    while ($query->have_posts()):
        $query->the_post();
        $governorimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($governorimg == "") {
            $governorimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_team_logo.png";
        }
        $post_id = get_the_ID();

        $data .= '<div class="team_box">
           <div class="team_box_wrap">
               <div class="team_imgbox">
                   <img class="img-responsive" src="' . $governorimg . '"  alt=' . get_field("member_title") . '>
               </div>
               <div class="team_inner">
                   <h3><span class="en_view">' . get_field("full_name") . '</span><span class="ar_view">' . get_field("arabic_name") . '</span></h3>';

        $designation = get_field("designation");
        $arabicdesignation = get_field("designation_arabic");
        if ($designation == "" && $arabicdesignation == "") {
            $nodesignation = "no_desg";
        }
        $data .= ' <div class="member-desg ' . $nodesignation . '">
                       <h4><span class="en_view">' . get_field("designation") . '</span><span class="ar_view">' . get_field("designation_arabic") . '</span></h4>
                   </div> 
               </div>
           </div>
       </div>';

    endwhile;
    wp_reset_query();
    $data .= '</div>';


    return $data;
}
add_shortcode('manager_directors_of_board_shartcode', 'manager_directors_of_board_list');



// Links List Shortcode Start
function links_list()
{
    ob_start();

    $data .= '<div class="link_fluid_container" >';
    //Regional Organizations Code
    $data .= '<h2><span class="en_view">Regional Organizations</span><span class="ar_view">المنظمات الإقليمية</span></h2>';
    $data .= '<div class="link_container">';
    $query = new WP_Query('post_type=links&organization_type=regional-organizations&showposts=-1&order=ASC&orderby=title');
    while ($query->have_posts()):
        $query->the_post();
        $links_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($links_img == "") {
            $links_img = "/arabfund/wp-content/themes/arab-fund/assets/images/no_logo.png";
        }
        $post_id = get_the_ID();
        $websitelink = get_field("organization_link");

        $data .= '<a class="link_box" href=" ' . $websitelink . '" target="_blank">    
	   				<div class="img_link_box"><img src=" ' . $links_img . ' " alt=' . get_field("organization_name") . '></div>
				  <h3><img src="' . get_stylesheet_directory_uri() . '/assets/images/link_icon.svg"> <span class="en_view">' . get_field("organization_name") . ' </span><span class="ar_view">' . get_field("organization_name_arabic") . '</span></h3>
                </a>';
    endwhile;
    $data .= '</div>';
    // International Organizations Code
    $data .= '<h2><span class="en_view">International Organizations</span><span class="ar_view">المنظمات الدولية</span></h2>';
    $data .= '<div class="link_container">';
    $query = new WP_Query('post_type=links&organization_type=international-organizations&showposts=-1&order=ASC&orderby=title');
    while ($query->have_posts()):
        $query->the_post();
        $links_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($links_img == "") {
            $links_img = "/arabfund/wp-content/themes/arab-fund/assets/images/no_logo.png";
        }
        $post_id = get_the_ID();
        $websitelink = get_field("organization_link");

        $data .= '<a class="link_box" href=" ' . $websitelink . '" target="_blank">    
	   				<div class="img_link_box"><img src=" ' . $links_img . ' " alt=' . get_field("organization_name") . '></div>
				  <h3><img src="' . get_stylesheet_directory_uri() . '/assets/images/link_icon.svg"> <span class="en_view">' . get_field("organization_name") . ' </span><span class="ar_view">' . get_field("organization_name_arabic") . '</span></h3>
                </a>';
    endwhile;
    $data .= '</div>';
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('links_list_shartcode', 'links_list');


// institutions List Shortcode Start
function institutions_list()
{
    ob_start();

    $data .= '<div class="link_fluid_container" >';
    $data .= '<div class="link_container">';
    $query = new WP_Query('post_type=institutions&showposts=-1&order=ASC&orderby=title');
    while ($query->have_posts()):
        $query->the_post();
        $institutions_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($institutions_img == "") {
            $institutions_img = "/arabfund/wp-content/themes/arab-fund/assets/images/pdf.svg";
        }
        $post_id = get_the_ID();
        $websitelink = get_field("institution_link");

        $data .= '<a class="link_box" href=" ' . $websitelink . '" target="_blank">    
           <div class="img_link_box"><img src=" ' . $institutions_img . ' " alt=' . get_field("institution_name") . '></div>
        <h3><img src="' . get_stylesheet_directory_uri() . '/assets/images/link_icon.svg"> <span class="en_view">' . get_field("institution_name") . ' </span><span class="ar_view">' . get_field("institution_arabic_name") . '</span></h3>
              </a>';
    endwhile;
    $data .= '</div>';

    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('institutions_list_shartcode', 'institutions_list');

/**
 *  Add Shortcode for News Single page
 */
add_shortcode('newsact_arabfund_shortcode', 'newsact_arabfund');
function newsact_arabfund()
{
    ob_start();

    $data .= '<div class="news_single_container">';
    //  $query = new WP_Query('post_type=news_or_activity'); 

    $eventnewsimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if ($eventnewsimg == "") {
        $eventnewsimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg.png";
    }
    $post_id = get_the_ID();
    $categories = get_the_terms($post_id, 'news_or_activity_type');
    $arabdate = get_field('newsevent_date');
    if ($arabdate) {
        $to = str_replace('/', '-', $arabdate);
        //$arabevent_date = date("d-F-Y", strtotime($to));
        $day = date("d", strtotime($to));
        $month = date("F", strtotime($to));
        $year = date("Y", strtotime($to));
        $event_news_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
    }

    $data .= '<div class="content">
                                <img class="left-side-box" src="' . $eventnewsimg . '">
                                      <h5>' . get_field("news_or_event_name") . '</h5>
                                      <div class="newstype_date"><div class="news_type">';
    if (is_array($categories)) {
        $data .= '<ul class="event_type_list">';
        foreach ($categories as $key => $cat) {
            $newseventname = $cat->name;
            $data .= '<li id="' . $cat->name . '">' . arabfund_str_display($newseventname) . '</li>';
        }
        $data .= '</ul>';
    }
    $data .= '</div>
                                  <div class="news_date"><img src="/arabfund/wp-content/uploads/2023/11/calendar_icon.svg" alt="date-icon"><span>' . $event_news_date . '</span></div>
                              </div>
                                <p>' . get_field("news_event_description") . '</p>';

    if (have_rows('video_urls', $post_id)):
        $data .= '<div class="video-gallery">';
        while (have_rows('video_urls', $post_id)):
            the_row();



            $video_event_urls = get_sub_field('video_url', $post_id);
            //print_r($video_event_urls);
            if ($video_event_urls) {

                $data .= '<div class="video_frame">';
                if (!empty($video_event_urls)) {
                    $data .= '                                     
                                  <div class="iframe-container">
                                    <iframe width="560" height="315" src="' . $video_event_urls . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" loading="lazy" allowfullscreen></iframe>
                                  </div>';
                }
                $data .= '   </div> ';


            }
        endwhile;
        $data .= '</div>';
        // end video gallery


        // End loop. 

        // No value.
    else:
        // Do something...
    endif;


    $data .= '  </div>';
    // Load sub field value.
    if (have_rows('project_details_table', $post_id)):
        // Loop through rows.
        $data .= '<div class="news_table"><table id="loan_table">
                       <thead>
                         <tr>
                           <th><span class="en_view">S.no</span><span class="ar_view">الرقم التسلسلي</span></th>
                           <th><span class="en_view">Country</span><span class="ar_view">دولة</span></th>
                           <th><span class="en_view">Project Name</span><span class="ar_view">اسم المشروع</span></th>
                           <th><span class="en_view">Amount of Loan(KD Million)</span><span class="ar_view">مقدار من القرض
                           (مليون د.ك)</span></th>                           
                         </tr>
                         </thead><tbody>';
        $serial_number = 1;
        while (have_rows('project_details_table', $post_id)):
            the_row();

            $data .= '<tr>             
                       <td data-th="S.no">' . $serial_number . '</td>
                       <td data-th="Country">' . get_sub_field("country", $post_id) . '</td>
                       <td data-th="Loan Amount">' . get_sub_field("project", $post_id) . '</td>
                       <td data-th="Loan">' . get_sub_field("amount_of_loan_kd_million", $post_id) . '</td>
                     </tr> ';
            $serial_number++;
        endwhile;
        $data .= '<tr><td ></td> <td ><b class="en_view">Total</b><b class="ar_view">المجموع</b></td> <td ></td> <td ><b><span id="val"></span></b></td></tr>';




        $data .= '</tbody>
                 </table></div>';
        // Do something...            
        // End loop. 
        // No value.
    else:
        // Do something...
    endif;


    $gallery_event_images = get_field('gallery');
    //  echo '<pre>';
    // print_r($gallery_event_images);
    //echo '</pre>';
    $data .= '<div class="container_gallery">';
    if ($gallery_event_images) {
        $data .= '<div class="media-gallery">';
        foreach ($gallery_event_images as $image):
            if ($image['type'] == 'image') {
                $img_url = $image['url'];
                $img_alt = $image['alt'];
                $data .= '<a href="' . $img_url . '" data-fancybox="images" >
                                 <div class="mg-fb">
                                     <img src="' . $img_url . '">
                                 </div>
                             </a>';
            } else {
                $img_url = $image['url'];
                // $data.='<video src="'.$img_url.'"></video>';
                $data .= '<a href="' . $img_url . '" data-fancybox="images" >
                                   <div class="video-layer">
                                   <video src="' . $img_url . '"></video>
                                   </div>
                               </a>';
            }

        endforeach;

        $data .= '</div>';

    }







    $data .= '</div>';

    return $data;
}


/**
 *  Add Shortcode for Meeting Single page
 */
add_shortcode('meetingsingle_arabfund_shortcode', 'meetingsingle_arabfund');
function meetingsingle_arabfund()
{
    ob_start();

    $data .= '<div class="meeting_container">';

    $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if ($memberImg == "") {
        $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
    }
    $post_id = get_the_ID();

    $data .= '<div class="single-meeting-box">';

    // Special Account Loan categories display purpose only
    $categories = get_the_terms($post_id, 'operations');
    $data .= ' <div class="newstype_date mt-5"><div class="news_type">';
    if (is_array($categories)) {
        $data .= '<ul class="event_type_list">';
        foreach ($categories as $key => $cat) {
            $loancategoryname = $cat->name;
            $data .= '<li id="' . $cat->name . '">' . arabfund_str_display($loancategoryname) . '</li>';
        }
        $data .= '</ul>';
    }
    $data .= '</div>';
    // Special Account Loan categories display purpose End

    $data .= '<div class="meeting_title_details">
                      <h2>' . get_field("meeting_title") . '</h2>
                      <p>' . get_field("meeting_description_specialaccount") . '</p>
                      <p>' . get_field("meeting_short_inner_description") . '</p>
                      </div>';



    $data .= ' </div>';

    // Load sub field value.

    if (have_rows('loan_details', $post_id)):
        // Loop through rows.
        $data .= '<div class="meeting_table"><table id="loan_table" class="summary-table">
                <thead>
                  <tr>
                    <th><span class="en_view">S.no</span><span class="ar_view">الرقم التسلسلي</span></th>
                    <th><span class="en_view">Country</span><span class="ar_view">دولة</span></th>
                    <th><span class="en_view">Loan Amount (KD Million)</span><span class="ar_view">قيمة القرض (مليون د.ك.)</span></th>
                    <th><span class="en_view">Project Name</span><span class="ar_view">اسم المشروع</span></th>
                  </tr>
                  </thead><tbody>';
        $serial_number = 1;
        while (have_rows('loan_details', $post_id)):
            the_row();

            $data .= '<tr>             
                <td data-th="S.no">' . $serial_number . '</td>
                <td data-th="Country">' . get_sub_field("country", $post_id) . '</td>
                <td data-th="Loan Amount">' . get_sub_field("loan_amount", $post_id) . '</td>
                <td data-th="Project Name">' . get_sub_field("project_name", $post_id) . '</td>
              </tr> ';
            $serial_number++;
        endwhile;
        $data .= '</tbody>
          </table></div>';
        // Do something...            
        // End loop. 
        // No value.
    else:
        // Do something...
    endif;
    $data .= '<div class="single-more-des">
                  <p>' . get_field("meeting_more_description") . '</p>
             </div>                   
            </div>';

    return $data;
}


// Custom post type for Event News
function arabfund_newsevent_list()
{
    ob_start();

    $data .= '<div class="events_container">';
    // $query = new WP_Query('post_type=news_or_activity&order=desc&posts_per_page=-1'); 
    $query = new WP_Query(array(
        'post_type' => 'news_or_activity',
        'posts_per_page' => -1,
        'meta_key' => 'newsevent_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',

    ));
    while ($query->have_posts()):
        $query->the_post();
        $eventnewsimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($eventnewsimg == "") {
            $eventnewsimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_logo.jpg";
        }
        $post_id = get_the_ID();
        $categories = get_the_terms($post_id, 'news_or_activity_type');
        $arabdate = get_field('newsevent_date');
        if ($arabdate) {
            $to = str_replace('/', '-', $arabdate);
            //$arabevent_date = date("d-F-Y", strtotime($to));
            $day = date("d", strtotime($to));
            $month = date("F", strtotime($to));
            $year = date("Y", strtotime($to));
            $event_news_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
        }



        $data .= ' <div class="event_box">
                      <div class="event_image">
                          <img src="' . $eventnewsimg . '" alt="' . $eventnewsimg . '">
                      </div>
                      <div class="event_details">
                          <div class="event_type">';
        if (is_array($categories)) {
            $data .= '
                              <ul class="event_type_list">';
            foreach ($categories as $key => $cat) {
                $newseventname = $cat->name;
                $data .= '<li id="' . $cat->name . '">' . arabfund_str_display($newseventname) . '</li>';
            }
            $data .= '    
                               </ul>';
        }
        $data .= ' 
						  </div>
                          <p class="event_date"><img src="/arabfund/wp-content/uploads/2023/11/calendar_icon.svg" alt="date-icon"><span>' . $event_news_date . '</span> </p>
                          <p class="event_description">' . get_field("short_description") . '</p>
                          <a href="' . get_permalink() . '" target="_self"> <span class="ar_view">اقرأ أكثر </span><span class="en_view">Read More</span>  <img src="/arabfund/wp-content/uploads/2024/01/green_arrow_event.svg" alt="readmore-icon" class="green_arrow"></a>
                      </div>
                  </div>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';
    $data .= '<div class="pagination-container"></div>';
    return $data;
}
add_shortcode('arabfund_newsevent_list_shartcode', 'arabfund_newsevent_list'); /// end arabfund News Event Section


function arabfund_meeting_list()
{
    ob_start();

    $data .= '<div class="meeting-container m-30">';
    //$query = new WP_Query('post_type=meetings&order=ASC&posts_per_page=-1'); 
    $query = new WP_Query(array(
        'post_type' => 'meetings',
        'posts_per_page' => -1,
        'meta_key' => 'meeting_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',

    ));
    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();


        $data .= '<div class="meeting-box">
  <div class="meeting_details">
     <h2>' . get_field("meeting_title") . '</h2>
     <p>' . get_field("meeting_description") . '.</p>
   </div>
     <a href="' . get_permalink() . '" target="_self"> <span class="ar_view">اقرأ أكثر </span><span class="en_view">Read More</span></a>
</div>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';
    $data .= '<div class="pagination-container"></div>';


    return $data;
}
add_shortcode('arabfund_meeting_list_shartcode', 'arabfund_meeting_list'); /// end meeting List




// Conferences & Events List Shortcode Start
function conferences_or_event_list()
{
    ob_start();
    $title = $from_date = $to_date = $start_date = $end_date = '';
    $per_page = 10;
    $page = get_query_var('paged') ? get_query_var('paged') : 1;

    $query = new WP_Query(array(
        'post_type' => 'conferences_or_event',
        'posts_per_page' => $per_page,
        'paged' => $page,
        'meta_key' => 'event_from_date',  // Order by the 'from_date' custom field
        'orderby' => 'meta_value',  // Order by the value of the meta key
        'order' => 'DESC',          // Order in descending order
        'meta_type' => 'DATE',      // Specify the meta type as 'DATE' for proper date comparison
    ));




    $data = '<div class="filter_sec">
            <form method="post" name="filter_frm" autocomplete="off">
             <!-- <div class="search_sec">
                <input type="text" name="title" placeholder="' . arabfund_str_display('Keyword') . '" value="' . filter_var($title, FILTER_SANITIZE_STRING) . '"/>                 
              </div> 
              <div class="search_sec">';

    $taxonomy_terms = get_terms('conferences_events_type');
    if ($taxonomy_terms) {
        $data .= '<select id="taxonomy_dropdown" name="taxonomy_dropdown">
                        <option value=""> ' . arabfund_str_display('Select') . '</option>
                        <option value="current"> ' . arabfund_str_display('Current event') . '</option>
                        <option value="upcoming"> ' . arabfund_str_display('Upcoming event') . '</option>
                        <option value="cancelled"> ' . arabfund_str_display('Past event') . '</option>';

        $data .= ' </select>';
    }
    $data .= ' </div>--> 


              <div class="date_sec">
                <input type="text" name="from_date" id="from" placeholder="' . arabfund_str_display('From Date') . '" value="' . $start_date . '"/>
                <a href="javascript:void(0)" class="from-date-icon"><img src="' . get_stylesheet_directory_uri() . '/assets/images/date.svg" /></a>
              </div>
              <div class="date_sec">
                <input type="text" name="to_date" id="to" placeholder="' . arabfund_str_display('To Date') . '" value="' . $end_date . '"/>
                <a href="javascript:void(0)" class="to-date-icon"><img src="' . get_stylesheet_directory_uri() . '/assets/images/date.svg" /></a>
              </div>
              <div class="conference_filter btn_sec">
                 <input type="button" value="' . arabfund_str_display('Reset') . '" class="refresh refresh-events">
                <input type="button" name="filter_btn" class="filter-btn filter-conferences" value="' . arabfund_str_display('Filter') . '"/>                  
              </div>
            </form>  
        </div> 

        <div class="select_conference_list">
        <div class="search_sec">';

    $taxonomy_terms = get_terms('conferences_events_type');
    if ($taxonomy_terms) {
        $data .= '<select id="taxonomy_dropdown" name="taxonomy_dropdown">
                 <option value=""> ' . arabfund_str_display('Select') . '</option>
                 <option value="current"> ' . arabfund_str_display('Current event') . '</option>
                 <option value="upcoming"> ' . arabfund_str_display('Upcoming event') . '</option>
                 <option value="cancelled"> ' . arabfund_str_display('Past event') . '</option>';

        $data .= ' </select>';
    }
    $data .= ' </div>
        </div>';

    $data .= '<div class="conferences_container" >';

    // <!-- $query = new WP_Query('post_type=conferences_or_event&showposts=-1&order=ASC');  -->
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            $jae_annualreportsImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($jae_annualreportsImg == "") {
                $jae_annualreportsImg = "/arabfund/wp-content/themes/arab-fund/assets/images/pdf.svg";
            }
            $post_id = get_the_ID();
            $categories = get_the_terms($post_id, 'conferences_events_type');
            $event_publish_date = get_field('published_date');

            if ($event_publish_date) {
                $to = str_replace('/', '-', $event_publish_date);
                //$arabevent_date = date("d-F-Y", strtotime($to));
                $day = date("d", strtotime($to));
                $month = date("F", strtotime($to));
                $year = date("Y", strtotime($to));
                $event_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
            }
            $event_from_date = get_field('event_from_date');
            if ($event_from_date) {
                $to = str_replace('/', '-', $event_from_date);
                //$arabevent_date = date("d-F-Y", strtotime($to));
                $day = date("d", strtotime($to));
                $month = date("F", strtotime($to));
                $year = date("Y", strtotime($to));
                $event_start_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
            }
            $event_to_date = get_field('event_to_date');
            if ($event_to_date) {
                $to = str_replace('/', '-', $event_to_date);
                //$arabevent_date = date("d-F-Y", strtotime($to));
                $day = date("d", strtotime($to));
                $month = date("F", strtotime($to));
                $year = date("Y", strtotime($to));
                $event_end_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
            }
            $event_from = $event_from_date;
            $event_to = $event_to_date;
            $event_status_label = '';
            $event_status_class = '';
            $currentDate = date('d/m/Y');
            $fromDate = DateTime::createFromFormat('d/m/Y', $event_from);
            $toDate = DateTime::createFromFormat('d/m/Y', $event_to);
            $currentDateObj = DateTime::createFromFormat('d/m/Y', $currentDate);
            // Check if the current date is between the from and to dates
            if ($currentDateObj >= $fromDate && $currentDateObj <= $toDate) {
                // If the current date is within the range, it's a current event
                $event_status_label = arabfund_str_display('Current event');
                $event_status_class = "CurrentEvents";
            } elseif ($currentDateObj < $fromDate) {
                // If the current date is before the from date, it's an upcoming event
                $event_status_label = arabfund_str_display('Upcoming event');
                $event_status_class = "UpcomingEvents";
            } else {
                // If the current date is after the to date, it's a cancelled event
                $event_status_label = arabfund_str_display('Past event');
                $event_status_class = "CanceledEvents";
            }
            $event_cancelled = get_field('is_event_canceled');
            $event_cancelled_or_not = arabfund_str_display($event_cancelled);
            $div_class = '';
            if ($event_cancelled_or_not === 'Yes') {
                // If event is cancelled, add the class 'cancelled'
                $div_class = 'cancelled';
            } else {
                $div_class = 'hide-cancelled';
            }

            $data .= '<div class="conference_box">
        <div class="date_event_type">
            <div class="event_published_date">' . $event_date . '</div>
            <div class="event_type_name	">';
            // if ( is_array( $categories ) ) {
            //                $data.='
            //                 <ul class="event_type_list">';
            //                   foreach ($categories as $key => $cat) {
            //                      $categoryname = $cat->name;
            //                    $data.='<li id="'.$cat->name.'">'.arabfund_str_display($categoryname).'</li>';
            //                    }
            //                  $data.='    
            //                  </ul>';
            //                  }
            $data .= '<ul class="event_type_list">
                             <li id=' . $event_status_class . '>' . $event_status_label . '</li>
                      </ul>';

            $data .= '</div>
        </div>
        <h2> ' . get_field("conference_or_event_name") . '</span><span class="' . $div_class . '" ><span class="en_view">Cancelled</span><span class="ar_view">ألغيت</span></span> </h2>
        <div class="conference_event_details">
            <div class="event_date_from event_dates">
                  <p>' . arabfund_str_display('From Date') . '</p> 
                <span><img src="/arabfund/wp-content/uploads/2024/01/calendar_icon.svg" >' . $event_start_date . '</span>
            </div>
            <div class="event_date_to event_dates">
            <p>' . arabfund_str_display('To Date') . '</p>
            <span><img src="/arabfund/wp-content/uploads/2024/01/calendar_icon.svg" >' . $event_end_date . '</span></div>
            <div class="event_location event_dates">
            <p class="m-none">&nbsp;</p>
            <span><img src="/arabfund/wp-content/uploads/2024/01/location_icon.svg" ></span> ' . get_field("event_location") . '</div>
        </div>
        <hr>
        <a href="' . get_permalink($post_id) . '" target="_self"> <span class="ar_view">اقرأ أكثر </span><span class="en_view">Read More</span>  <img src="/arabfund/wp-content/uploads/2024/01/green_arrow_event.svg" alt="readmore-icon"></a>
      </div>';

        endwhile;
    else:
        $data .= '<div class="not-found">
                              <p>No posts found.</p>
                </div>';
    endif;
    wp_reset_query();

    $data .= '</div>';
    $data .= '<div class="pagination arab-pagination">' . arabfund_post_pagination($query) . '</div>';
    return $data;
}
add_shortcode('conference_list_shartcode', 'conferences_or_event_list');
function conference_events_filters()
{

    ob_start();
    if (empty($_POST['from_date']) && empty($_POST['to_date']) && empty($_POST['taxonomy_id'])) {
        $query = new WP_Query(array(
            'post_type' => 'conferences_or_event',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => 'event_from_date',  // Order by the 'from_date' custom field
            'orderby' => 'meta_value',  // Order by the value of the meta key
            'order' => 'DESC',          // Order in descending order
            'meta_type' => 'DATE',

            //'paged' => $page,
        ));
    } else {

        $from_date = $_POST['from_date'];
        $formatfromDate = DateTime::createFromFormat('d/m/Y', $from_date);

        $to_date = $_POST['to_date'];
        $formatToDate = DateTime::createFromFormat('d/m/Y', $to_date);
        $taxonomy_id = $_POST['taxonomy_id'];


        if ($taxonomy_id != "" || !empty($taxonomy_id)) {
            $current_date = date('Ymd');

            if ($taxonomy_id == 'current') {
                $query = new WP_Query(array(
                    'post_type' => 'conferences_or_event',
                    'post_status' => 'publish',
                    'meta_key' => 'event_from_date',  // Order by the 'from_date' custom field
                    'orderby' => 'meta_value',  // Order by the value of the meta key
                    'order' => 'DESC',          // Order in descending order
                    'meta_type' => 'DATE',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_from_date',
                            'value' => $current_date,
                            'compare' => '<=',
                            'type' => 'DATE'
                        ),
                        array(
                            'key' => 'event_to_date',
                            'value' => $current_date,
                            'compare' => '>=',
                            'type' => 'DATE'
                        ),
                    ),
                ));
            }
            if ($taxonomy_id == 'upcoming') {

                $query = new WP_Query(array(
                    'post_type' => 'conferences_or_event',
                    'post_status' => 'publish',
                    'meta_key' => 'event_from_date',  // Order by the 'from_date' custom field
                    'orderby' => 'meta_value',  // Order by the value of the meta key
                    'order' => 'DESC',          // Order in descending order
                    'meta_type' => 'DATE',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_from_date',
                            'value' => $current_date,
                            'compare' => '>',
                            'type' => 'DATE'
                        ),
                        array(
                            'key' => 'event_to_date',
                            'value' => $current_date,
                            'compare' => '>',
                            'type' => 'DATE'
                        ),
                    ),
                    // 'meta_query'  => array(
                    //     'key' => 'event_from_date',
                    //     'value' => $current_date,
                    //     'compare' => '>',
                    //     'type' => 'DATE'
                    // ),
                ));
            }
            if ($taxonomy_id == 'cancelled') {

                $query = new WP_Query(array(
                    'post_type' => 'conferences_or_event',
                    'post_status' => 'publish',
                    'meta_key' => 'event_from_date',  // Order by the 'from_date' custom field
                    'orderby' => 'meta_value',  // Order by the value of the meta key
                    'order' => 'DESC',          // Order in descending order
                    'meta_type' => 'DATE',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_from_date',
                            'value' => $current_date,
                            'compare' => '<',
                            'type' => 'DATE'
                        ),
                        array(
                            'key' => 'event_to_date',
                            'value' => $current_date,
                            'compare' => '<',
                            'type' => 'DATE'
                        ),
                    ),
                    // 'meta_query'  => array(
                    //     'key' => 'event_to_date',
                    //     'value' => $current_date,
                    //     'compare' => '<',
                    //     'type' => 'DATE'
                    // ),
                ));
            }

        } else {
            if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
                $query = new WP_Query(array(
                    'post_type' => 'conferences_or_event',
                    'posts_per_page' => -1,
                    //'paged' => $page,

                    'meta_query' => array(

                        array(
                            'key' => 'event_from_date',
                            'value' => $formatfromDate->format('Ymd'),
                            'compare' => '>=',
                            'type' => 'DATE'
                        ),
                        array(
                            'key' => 'event_to_date',
                            'value' => $formatToDate->format('Ymd'),
                            'compare' => '<=',
                            'type' => 'DATE'
                        ),
                    ),
                    'relation' => 'AND',
                    'orderby' => 'meta_value', // Optional: You can adjust the orderby based on your needs.
                    'order' => 'ASC',         // Optional: Specify the order (ASC or DESC).
                ));
            }

            /* when only from date is present*/
            if (!empty($_POST['from_date']) && empty($_POST['to_date'])) {
                $query = new WP_Query(array(
                    'post_type' => 'conferences_or_event',
                    'posts_per_page' => -1,
                    //'paged' => $page,
                    'meta_query' => array(
                        array(
                            'key' => 'event_from_date',
                            'value' => $formatfromDate->format('Ymd'),
                            'compare' => '>=',
                            'type' => 'DATE'
                        ),
                    ),
                ));

            }
            /* when only to date is present*/
            if (!empty($_POST['to_date']) && empty($_POST['from_date'])) {
                $query = new WP_Query(array(
                    'post_type' => 'conferences_or_event',
                    'posts_per_page' => -1,
                    //'paged' => $page,
                    'meta_query' => array(
                        array(
                            'key' => 'event_to_date',
                            'value' => $formatToDate->format('Ymd'),
                            'compare' => '<=',
                            'type' => 'DATE'
                        ),
                    ),
                ));

            }
        }
    }





    /* when only taxonomy is present*/
    /*if(!empty($_POST['taxonomy_id'])){
      $query = new WP_Query(array(
        'post_type' => 'conferences_or_event',
        'posts_per_page' => $per_page,
        'paged' => $page,
        'tax_query' => array(
            array(
                'taxonomy' => 'conferences_events_type',
                'field'    => 'term_id',
                'terms'    => $taxonomy_id, // Replace with the actual term ID
            ),
        ),
    ));
    }*/
    /* when  from date and taxonomy both is present
    if(!empty($_POST['taxonomy_id']) && !empty($_POST['from_date'])){
      $query = new WP_Query(array(
        'post_type' => 'conferences_or_event',
        'posts_per_page' => $per_page,
        'paged' => $page,
        'tax_query' => array(
            array(
                'taxonomy' => 'conferences_events_type',
                'field'    => 'term_id',
                'terms'    => $taxonomy_id, // Replace with the actual term ID
            ),
        ),
        'meta_query'  => array(
          array(
            'key'     => 'event_from_date',
            'value'   => $formatfromDate->format('Ymd'),
            'compare' => '>=',
            'type'    => 'DATE'
          ),
        ),
    ));
    }
    /* when only to date and taxonomy both present
    if(!empty($_POST['taxonomy_id']) && !empty($_POST['to_date'])){
      $query = new WP_Query(array(
        'post_type' => 'conferences_or_event',
        'posts_per_page' => $per_page,
        'paged' => $page,
        'tax_query' => array(
            array(
                'taxonomy' => 'conferences_events_type',
                'field'    => 'term_id',
                'terms'    => $taxonomy_id, // Replace with the actual term ID
            ),
        ),
        'meta_query'  => array(
          array(
            'key'     => 'event_to_date',
            'value'   => $formatToDate->format('Ymd'),
            'compare' => '<=',
            'type'    => 'DATE'
          ),
        ),
    ));
    }*/


    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            $jae_annualreportsImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($jae_annualreportsImg == "") {
                $jae_annualreportsImg = "/arabfund/wp-content/themes/arab-fund/assets/images/pdf.svg";
            }
            $post_id = get_the_ID();
            $categories = get_the_terms($post_id, 'conferences_events_type');
            $event_publish_date = get_field('published_date');
            if ($event_publish_date) {
                $to = str_replace('/', '-', $event_publish_date);
                //$arabevent_date = date("d-F-Y", strtotime($to));
                $day = date("d", strtotime($to));
                $month = date("F", strtotime($to));
                $year = date("Y", strtotime($to));
                $event_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
            }

            $event_from_date = get_field('event_from_date');
            if ($event_from_date) {
                $to = str_replace('/', '-', $event_from_date);
                //$arabevent_date = date("d-F-Y", strtotime($to));
                $day = date("d", strtotime($to));
                $month = date("F", strtotime($to));
                $year = date("Y", strtotime($to));
                $event_start_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
            }

            $event_to_date = get_field('event_to_date');
            if ($event_to_date) {
                $to = str_replace('/', '-', $event_to_date);
                //$arabevent_date = date("d-F-Y", strtotime($to));
                $day = date("d", strtotime($to));
                $month = date("F", strtotime($to));
                $year = date("Y", strtotime($to));
                $event_end_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
            }
            $event_from = $event_from_date;
            $event_to = $event_to_date;
            $event_status_label = '';
            $event_status_class = '';
            $currentDate = date('d/m/Y');
            $fromDate = DateTime::createFromFormat('d/m/Y', $event_from);
            $toDate = DateTime::createFromFormat('d/m/Y', $event_to);
            $currentDateObj = DateTime::createFromFormat('d/m/Y', $currentDate);
            // Check if the current date is between the from and to dates
            if ($currentDateObj >= $fromDate && $currentDateObj <= $toDate) {
                // If the current date is within the range, it's a current event
                $event_status_label = arabfund_str_display('Current event');
                $event_status_class = "CurrentEvents";
            } elseif ($currentDateObj < $fromDate) {
                // If the current date is before the from date, it's an upcoming event
                $event_status_label = arabfund_str_display('Upcoming event');
                $event_status_class = "UpcomingEvents";
            } else {
                // If the current date is after the to date, it's a cancelled event
                $event_status_label = arabfund_str_display('Past event');
                $event_status_class = "CanceledEvents";
            }


            $event_cancelled = get_field('is_event_canceled');

            $event_cancelled_or_not = arabfund_str_display($event_cancelled);
            // Define a variable to hold the class
            $div_class = '';
            if ($event_cancelled_or_not === 'Yes') {
                // If event is cancelled, add the class 'cancelled'
                $div_class = 'cancelled';
            } else {
                $div_class = 'hide-cancelled';
            }



            ?>

            <div class="conference_box">
                <div class="date_event_type">
                    <div class="event_published_date"><?php echo $event_date; ?></div>
                    <div class="event_type_name	">
                        <?php /*if ( is_array( $categories ) ) { ?> 
                                                                                                     <ul class="event_type_list">
                                                                                                         <?php foreach ($categories as $key => $cat) { 
                                                                                                           $categoryname = $cat->name;?>
                                                                                                            <li id="<?php echo str_replace(' ', '', $cat->name )?>"><?php  echo $categoryname; ?></li>
                                                                                                         <?php } ?>  
                                                                                                     </ul>
                                                                                                  <?php }*/ ?>
                        <ul class="event_type_list">
                            <li id=<?php echo $event_status_class; ?>><?php echo $event_status_label; ?></li>
                        </ul>
                    </div>
                </div>
                <h2> <span class="ar_view"><?php echo get_field("conference_or_event_name"); ?></span><span
                        class="en_view"><?php echo get_field("conference_or_event_name"); ?></span> <span
                        class="<?php echo $div_class; ?>"><span class="en_view">Cancelled</span><span
                            class="ar_view">ألغيت</span></span></h2>
                <div class="conference_event_details">
                    <div class="event_date_from event_dates">
                        <p><?php echo arabfund_str_display('From Date'); ?></p>
                        <span><img decoding="async"
                                src="/arabfund/wp-content/uploads/2024/01/calendar_icon.svg"><?php echo $event_start_date; ?></span>
                    </div>
                    <div class="event_date_to event_dates">
                        <p><?php echo arabfund_str_display('To Date'); ?></p>
                        <span><img decoding="async"
                                src="/arabfund/wp-content/uploads/2024/01/calendar_icon.svg"><?php echo $event_end_date; ?></span>
                    </div>
                    <div class="event_location event_dates">
                        <p class="m-none">&nbsp;</p>
                        <span><img decoding="async" src="/arabfund/wp-content/uploads/2024/01/location_icon.svg"></span>
                        <?php echo get_field("event_location"); ?>
                    </div>
                </div>
                <hr>
                <a href="<?php echo get_permalink(); ?>" target="_self"> <span class="ar_view">اقرأ أكثر </span><span
                        class="en_view">Read More</span> <img decoding="async"
                        src="/arabfund/wp-content/uploads/2024/01/green_arrow_event.svg" alt="readmore-icon"></a>
            </div>
        <?php endwhile; else: ?>
        <div class="not-found">
            <p><?php echo "No posts found."; ?></p>
        </div>
        <?php
    endif;
    $html = ob_get_clean();
    wp_reset_query();
    wp_send_json(array('html' => $html), 200, JSON_UNESCAPED_UNICODE);

}

add_action('wp_ajax_nopriv_conference_events_filters', 'conference_events_filters');
add_action('wp_ajax_conference_events_filters', 'conference_events_filters');

function conferences_or_event_detail()
{
    ob_start();

    $data .= '<div class="meeting-container m-30">';
    //$query = new WP_Query('post_type=conferences_or_event&order=ASC'); 
    //while( $query->have_posts() ):$query->the_post();           
    $detailcoverImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if ($detailcoverImg == "") {
        $detailcoverImg = "/arabfund/wp-content/themes/arab-fund/assets/images/cover.jpg";
    }
    $post_id = get_the_ID();
    $categories = get_the_terms($post_id, 'conferences_events_type');
    $event_publish_date = get_field('published_date');

    if ($event_publish_date) {
        $to = str_replace('/', '-', $event_publish_date);
        //$arabevent_date = date("d-F-Y", strtotime($to));
        $day = date("d", strtotime($to));
        $month = date("F", strtotime($to));
        $year = date("Y", strtotime($to));
        $event_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
    }
    $event_from_date = get_field('event_from_date');
    if ($event_from_date) {
        $to = str_replace('/', '-', $event_from_date);
        //$arabevent_date = date("d-F-Y", strtotime($to));
        $day = date("d", strtotime($to));
        $month = date("F", strtotime($to));
        $year = date("Y", strtotime($to));
        $event_start_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
    }
    $event_to_date = get_field('event_to_date');
    if ($event_to_date) {
        $to = str_replace('/', '-', $event_to_date);
        //$arabevent_date = date("d-F-Y", strtotime($to));
        $day = date("d", strtotime($to));
        $month = date("F", strtotime($to));
        $year = date("Y", strtotime($to));
        $event_end_date = $day . '-' . arabfund_str_display($month) . '-' . $year;
    }
    $event_from = $event_from_date;
    $event_to = $event_to_date;
    $event_status_label = '';
    $event_status_class = '';
    $currentDate = date('d/m/Y');
    $fromDate = DateTime::createFromFormat('d/m/Y', $event_from);
    $toDate = DateTime::createFromFormat('d/m/Y', $event_to);
    $currentDateObj = DateTime::createFromFormat('d/m/Y', $currentDate);
    // Check if the current date is between the from and to dates
    if ($currentDateObj >= $fromDate && $currentDateObj <= $toDate) {
        // If the current date is within the range, it's a current event
        $event_status_label = arabfund_str_display('Current event');
        $event_status_class = "CurrentEvents";
    } elseif ($currentDateObj < $fromDate) {
        // If the current date is before the from date, it's an upcoming event
        $event_status_label = arabfund_str_display('Upcoming event');
        $event_status_class = "UpcomingEvents";
    } else {
        // If the current date is after the to date, it's a cancelled event
        $event_status_label = arabfund_str_display('Past event');
        $event_status_class = "CanceledEvents";
    }


    $event_cancelled = get_field('is_event_canceled');

    $event_cancelled_or_not = arabfund_str_display($event_cancelled);
    // Define a variable to hold the class
    $div_class = '';
    if ($event_cancelled_or_not === 'Yes') {
        // If event is cancelled, add the class 'cancelled'
        $div_class = 'cancelled';
    } else {
        $div_class = 'hide-cancelled';
    }


    $data .= '<div class="detail-box">
                <div class="coverphoto">
                  <img src="' . $detailcoverImg . '" alt="coverphoto" />
                </div>
                <h2> <span class="ar_view">' . get_field("conference_or_event_arabic_name") . ' </span><span class="en_view">' . get_field("conference_or_event_name") . '</span> <span class="' . $div_class . '" ><span class="en_view">Cancelled</span><span class="ar_view">ألغيت</span></span></h2>
                <div class="conference_event_details">
                    <div class="event_date_from event_dates">
                          <p>' . arabfund_str_display('From Date') . '</p> 
                        <span><img src="/arabfund/wp-content/uploads/2024/01/calendar_icon.svg" >' . $event_start_date . '</span>
                    </div>
                    <div class="event_date_to event_dates">
                    <p>' . arabfund_str_display('To Date') . '</p>
                    <span><img src="/arabfund/wp-content/uploads/2024/01/calendar_icon.svg" >' . $event_end_date . '</span></div>
                    <div class="event_location event_dates">
                    <p class="m-none">&nbsp;</p>
                    <span><img src="/arabfund/wp-content/uploads/2024/01/location_icon.svg" ></span> ' . get_field("event_location") . '</div>

                    <div class="detail_category">';

    $data .= '<ul class="event_type_list"><li id=' . $event_status_class . '>' . $event_status_label . '</li></ul>';
    // if ( is_array( $categories ) ) {
    //   $data.='
    //   <ul class="event_type_list">';
    //     foreach ($categories as $key => $cat) {
    //         $categoryname = $cat->name;
    //       $data.='<li id="'.$cat->name.'">'.arabfund_str_display($categoryname).'</li>';
    //       }
    //     $data.='    
    //     </ul>';
    //     }

    $data .= '</div> </div><hr>
                  <div class="event_declaration">
                        <h4>' . get_field("declaration") . '</h4>
                        <p>' . get_field("event_description") . '</p>
                  </div>
                  <div class="event_tabs">
                      <ul class="tabs event_list">
                        <li class="tab-link current" data-tab="tab-1"><img src="/arabfund/wp-content/uploads/2024/01/schedule.svg" alt="icon"> <span class="en_view">Conference Agenda</span><span class="ar_view">أجندة المؤتمر</span></li>
                        <li class="tab-link" data-tab="tab-2"><img src="/arabfund/wp-content/uploads/2024/01/gallery.svg" alt="icon"><span class="en_view">Part of the Conference in Pictures</span><span class="ar_view">جانب من المؤتمر فى صور</span></li>
                        <li class="tab-link" data-tab="tab-3"><img src="/arabfund/wp-content/uploads/2024/01/contract.svg" alt="icon"><span class="en_view">Register your interest here</span><span class="ar_view">سجل اهتمامك هنا</span></li>                    
                      </ul>
                  </div>
                  <div class="conference_container">
                  <div class="tab-content current" id="tab-1">';
    if (have_rows('on_day_event', $post_id)):
        $data .= '<div class="event_date_wise">';
        while (have_rows('on_day_event', $post_id)):
            the_row();
            $eventdatewise = get_sub_field("day_event_date", $post_id);
            $datewisedayname = get_sub_field("day_event_date", $post_id);
            if ($datewisedayname) {
                $to = str_replace('/', '-', $datewisedayname);
                $day = date("l", strtotime($to));
                $datewisedayname = $day;
            }
            $data .= '<div class="dayname">
                              <h4>' . $eventdatewise . ' - ' . arabfund_str_display($datewisedayname) . '</h4>
                            </div>
                            <div class="session_section_start">';
            if (have_rows('sessions_list_here', $post_id)):
                while (have_rows('sessions_list_here', $post_id)):
                    the_row();
                    $data .= '<div class="day_schedule_container">';
                    $data .= '<div class="day_name_schedule">
                                            <h5>' . get_sub_field("session_name", $post_id) . '</h5>';
                    $day_eventStartTime = get_sub_field("day_event_start_time", $post_id);

                    // echo '<br>'; 05/07/2023 9:00 AM =>  05-07-23 9:00 AM

                    if ($day_eventStartTime) {
                        $to = str_replace('/', '-', $day_eventStartTime);

                        //  if (pll_current_language() == 'ar'){ 
                        //   $to = str_replace('ص', 'AM', $day_eventStartTime);
                        // }


                        $time = date("H:i A", strtotime($to));

                        $day = date("d", strtotime($to));
                        $month = date("F", strtotime($to));
                        $year = date("Y", strtotime($to));
                        $day_eventStartTime_display = $time;
                        //echo $day_eventStartTime_display;
                        $converted_start_time = convertTimeToArabic($day_eventStartTime_display);
                    }
                    $day_eventEndTime = get_sub_field("day_event_end_time", $post_id);
                    if ($day_eventEndTime) {
                        $to = str_replace('/', '-', $day_eventEndTime);
                        if (pll_current_language() == 'ar') {
                            $to = str_replace('ص', 'AM', $day_eventEndTime);
                        }
                        //$arabevent_date = date("d-F-Y", strtotime($to));
                        $time = date("H:i A", strtotime($to));
                        $day = date("d", strtotime($to));
                        $month = date("F", strtotime($to));
                        $year = date("Y", strtotime($to));
                        $day_eventEndTime_display = $time;
                        $converted_end_time = convertTimeToArabic($day_eventEndTime_display);

                    }
                    //$data .='<p>'.$replace.'</p>';
                    $data .= '<p><img src="/arabfund/wp-content/uploads/2024/01/clock_icon.svg" alt="clock-icon"> <span>' . $converted_start_time . '</span> - <span>' . $converted_end_time . '</span> </p>
                               </div>';
                    if (have_rows('session_schedules', $post_id)):
                        $data .= ' <div class="timings_session">';
                        while (have_rows('session_schedules', $post_id)):
                            the_row();
                            $data .= '<div class="day_sessions">                                                  
                                                        <div class="left_time">';
                            $day_SessionStartTime = get_sub_field("speech_from_time", $post_id);

                            if ($day_SessionStartTime) {
                                $to = str_replace('/', '-', $day_SessionStartTime);

                                if (pll_current_language() == 'ar') {
                                    $to = str_replace('ص', 'AM', $day_SessionStartTime);
                                }
                                //$arabevent_date = date("d-F-Y", strtotime($to));
                                $time = date("H:i A", strtotime($to));
                                $day = date("d", strtotime($to));
                                $month = date("F", strtotime($to));
                                $year = date("Y", strtotime($to));

                                $day_sessionStartTime_display = $time;
                                $converted_start_time = convertTimeToArabic($day_sessionStartTime_display);
                            }
                            $day_SessionEndTime = get_sub_field("speech_to_time", $post_id);
                            if ($day_SessionEndTime) {
                                $to = str_replace('/', '-', $day_SessionEndTime);
                                if (pll_current_language() == 'ar') {
                                    $to = str_replace('ص', 'AM', $day_SessionEndTime);
                                }
                                $time = date("H:i A", strtotime($to));
                                $day = date("d", strtotime($to));
                                $month = date("F", strtotime($to));
                                $year = date("Y", strtotime($to));
                                $day_sessionEndTime_display = $time;
                                $converted_end_time = convertTimeToArabic($day_sessionEndTime_display);
                            }
                            $data .= ' <p><img src="/arabfund/wp-content/uploads/2024/01/clock_icon.svg" alt="clock-icon"><span>' . $converted_start_time . ' </span> - <span>' . $converted_end_time . '</span></p>';

                            $materialurl = get_sub_field("material", $post_id);
                            if ($materialurl != "" && $materialurl != "-") {
                                $data .= '<a href="' . $materialurl . '" target="_blank"><img src="/arabfund/wp-content/uploads/2024/01/download_icon.svg" alt="clock-icon" > <span class="en_view">Material Download</span><span class="ar_view">تحميل المواد</span></a>';
                            }
                            $data .= ' 
                                                        </div>
                                                        <div class="right_session">
                                                        <h5>' . get_sub_field("speech_title", $post_id) . '</h5>';
                            $speakerImg = get_sub_field("speaker_photo", $post_id);
                            if ($speakerImg == "") {
                                $speakerImg = "/arabfund/wp-content/themes/arab-fund/assets/images/user.png";
                            }
                            $data .= ' <p><img src=" ' . $speakerImg . '" alt="speakar-name">' . get_sub_field("speaker_name", $post_id) . '</p>
                                                        </div>
                                                  </div>';
                        endwhile;
                        $data .= ' </div>';

                        $data .= '</div>';
                    else:
                        // Do something...
                    endif;

                endwhile;
            else:
                // Do something...
            endif;
            $data .= '</div>';
        endwhile;
        $data .= ' </div>';
    else:
        // Do something...
    endif;

    $data .= ' </div>
                      <!-- Tab1 End -->
                        <div class="tab-content" id="tab-2">';
    $gallery_event_images = get_field('event_gallery');
    if (empty($gallery_event_images)) {
        $data .= '<div class="container">';
        $data .= '<p>No Pictures Found</p>';
        $data .= '</div>';
    } else {
        $data .= '<div class="container">';
        if ($gallery_event_images) {
            $data .= '<div class="media-gallery">';
            foreach ($gallery_event_images as $image):
                if ($image['type'] == 'image') {
                    $img_url = $image['url'];
                    $img_alt = $image['alt'];
                    $data .= '<a href="' . $img_url . '" data-fancybox="images" >
                                    <div class="mg-fb">
                                        <img src="' . $img_url . '">
                                    </div>
                                </a>';
                } else {
                    $img_url = $image['url'];
                    // $data.='<video src="'.$img_url.'"></video>';
                    $data .= '<a href="' . $img_url . '" data-fancybox="images" >
                                      <div class="video-layer">
                                      <video src="' . $img_url . '"></video>
                                      </div>
                                  </a>';
                }

            endforeach;

            $data .= '</div>';

        }
        $data .= '</div>';
    }

    $data .= ' </div>
                        <!-- Tab2 End -->
                        <div class="tab-content" id="tab-3">';
    $register_title = get_field('register_form_title');
    if (empty($register_title)) {
        $data .= '<div class="container">';
        $data .= '<p>No Form Found</p>';
        $data .= '</div>';
    } else {
        $register_description = get_field('register_form_description');
        $register_form = get_field('register_form');
        $data .= '<div class="form_section">
                                <h5>' . $register_title . '</h5>
                                <p>' . $register_description . '</p>
                                <div class="form_fields">' . $register_form . '</div>
                          </div>';
    }
    $data .= ' </div>
                        <!-- Tab3 End -->
                  </div>';



    $gallery_images = get_field('event_sponsors');
    if ($gallery_images) {
        $data .= '<div class="sponsors_heading">
                               <h5><span class="en_view">Event Sponsors</span><span class="ar_view">رعاة الحدث</span></h5>
                              </div>
                        <hr>
                    <div class="sponsors_container">';
        $data .= '<div class="gallery">';

        foreach ($gallery_images as $image) {
            $img_url = $image['url'];
            $img_alt = $image['alt'];

            $data .= '<div class="gallery_image">
                            <img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
            $data .= '</div>';
        }

        $data .= ' </div>';
    }
    $data .= '</div>
			</div>';


    //endwhile;
    //wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('conference_detail_shartcode', 'conferences_or_event_detail'); /// end conferences Detail


//Special Account -- Signed Loans Approved Loans Approved Grants Shortcodes


function arabfund_signed_loans()
{
    ob_start();

    $data .= '<div class="loan-container">';
    // $query = new WP_Query('post_type=meetings&operations=signed-loans&showposts=-1'); 

    $query = new WP_Query(array(
        'post_type' => 'meetings',
        'operations' => 'signed-loans',
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'meta_key' => 'meeting_date',
        'order' => 'DESC'
    ));
    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();
        $arabdate = get_field('meeting_date');
        if ($arabdate) {
            $to = str_replace('/', '-', $arabdate);
            //$arabevent_date = date("d-F-Y", strtotime($to));
            $day = date("d", strtotime($to));
            $month = date("F", strtotime($to));
            $year = date("Y", strtotime($to));
            $loan_date = $day . '-' . arabfund_str_display($month) . '-' . $year;

        }

        $data .= '<a class="loan-box" href="' . get_permalink() . '" target="_self">
     <div class="loan_date">' . $loan_date . '</div>
     <div class="loan_details">
        <h2>' . get_field("meeting_title") . '</h2>
        <p>' . get_field("meeting_description_specialaccount") . '</p>
      </div>
       
  </a>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_signed_loans_shortcode', 'arabfund_signed_loans'); /// end 




function arabfund_approved_loans()
{
    ob_start();

    $data .= '<div class="loan-container">';
    $query = new WP_Query(array(
        'post_type' => 'meetings',
        'operations' => 'approved-loans',
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'meta_key' => 'meeting_date',
        'order' => 'DESC'
    ));
    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();
        $arabdate = get_field('meeting_date');
        if ($arabdate) {
            $to = str_replace('/', '-', $arabdate);
            //$arabevent_date = date("d-F-Y", strtotime($to));
            $day = date("d", strtotime($to));
            $month = date("F", strtotime($to));
            $year = date("Y", strtotime($to));
            $loan_date = $day . '-' . arabfund_str_display($month) . '-' . $year;

        }

        $data .= '<a class="loan-box" href="' . get_permalink() . '" target="_self">
     <div class="loan_date">' . $loan_date . '</div>
     <div class="loan_details">
        <h2>' . get_field("meeting_title") . '</h2>
        <p>' . get_field("meeting_description_specialaccount") . '</p>
      </div>
       
  </a>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_approved_loans_shortcode', 'arabfund_approved_loans'); /// end 


function arabfund_approved_grants()
{
    ob_start();

    $data .= '<div class="loan-containe">';
    $query = new WP_Query('post_type=meetings&operations=approved-grants&showposts=-1');

    $data .= '<div class="news_table"><table id="loan_table" class="summary-table">
            <thead>
              <tr>
                <th><span class="en_view">S.no</span><span class="ar_view">الرقم التسلسلي</span></th>
                <th><span class="en_view">Country / Entity</span><span class="ar_view">الدولة / الجهة</span></th>
                <th><span class="en_view">Beneficiary</span><span class="ar_view"> الجهة المستفيدة</span></th>
                <th><span class="en_view">Grant Objective   </span><span class="ar_view">هدف المعونة</span></th>
                <th><span class="en_view">Year of Granting</span><span class="ar_view">سنة الإقرار</span></th>
                <th><span class="en_view">Amount (in thousands U.S Dollars)</span><span class="ar_view">المبلغ (ألف دولار أمريكي)</span></th>                      
              </tr>
              </thead><tbody>';
    $serial_number = 1;

    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();
        $arabdate = get_field('meeting_date');
        if ($arabdate) {
            $to = str_replace('/', '-', $arabdate);
            //$arabevent_date = date("d-F-Y", strtotime($to));
            $day = date("d", strtotime($to));
            $month = date("F", strtotime($to));
            $year = date("Y", strtotime($to));
            $loan_date = $day . '-' . arabfund_str_display($month) . '-' . $year;

        }



        $data .= '<tr>            
            <td data-th="S.no">' . $serial_number . '</td>
            <td data-th="Country">' . get_field("country") . '</td>
            <td data-th="Beneficiary">' . get_field("beneficiary") . '</td>
            <td data-th="Grant Objective">' . get_field("grant_objective") . '</td>
            <td data-th="Year of Granting">' . get_field("year_of_granting") . '</td>
            <td data-th="Amount (in thousands U.S Dollars)">' . get_field("amount") . '</td>
          </tr> ';
        $serial_number++;

    endwhile;
    $data .= '<tr><td></td> <td><b class="en_view">Total</b><b class="ar_view">الإجمالي</b></td> <td></td> <td></td><td></td>  <td><b><span id="val"></span></b></td></tr>';
    $data .= '</tbody>
    </table></div>';
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_approved_grants_shortcode', 'arabfund_approved_grants'); /// end





// Custom post type script start from here
function arabfund_meeting_special_account()
{
    ob_start();

    $data .= '<div class="meeting-container">';
    $args = array(
        'post_type' => 'meetings',
        'posts_per_page' => 4,
        'meta_key' => 'meeting_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'operations',
                'field' => 'slug',
                'terms' => 'approved-loans'
            ),
            array(
                'taxonomy' => 'operations',
                'field' => 'slug',
                'terms' => 'signed-loans'
            )
        )
    );
    $query = new WP_Query($args);
    while ($query->have_posts()):
        $query->the_post();
        $memberImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($memberImg == "") {
            $memberImg = "/arabfund/wp-content/uploads/2022/04/img.png";
        }
        $post_id = get_the_ID();


        $data .= '<div class="meeting-box">
     <div class="meeting_details">
        <h2>' . get_field("meeting_title") . '</h2>
        <p>' . get_field("meeting_description") . '.</p>
      </div>
        <a href="' . get_permalink() . '" target="_self"> <span class="ar_view">اقرأ أكثر </span><span class="en_view">Read More</span></a>
  </div>';


    endwhile;
    wp_reset_query();

    $data .= '</div>';

    return $data;
}
add_shortcode('arabfund_meeting_special_account_shortcode', 'arabfund_meeting_special_account'); /// end meeting





// Committee Member List Shortcode Start - Special Account
function committee_members_list()
{
    ob_start();
    $data .= '<div class="team_container governor" >';

    $query = new WP_Query('post_type=board_members&member_type=management-committee&showposts=-1&order=ASC');
    while ($query->have_posts()):
        $query->the_post();
        $governorimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($governorimg == "") {
            $governorimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_team_logo.png";
        }
        $post_id = get_the_ID();

        $data .= '<div class="team_box">
                  <div class="team_box_wrap">
                      <div class="team_imgbox">
                          <img class="img-responsive" src="' . $governorimg . '"  alt=' . get_field("member_title") . '>
                      </div>
                      <div class="team_inner">
                          <h3><span class="en_view">' . get_field("member_name") . '</span><span class="ar_view">' . get_field("member_name_arabic") . '</span></h3>
                          <div class="member-desg">
                              <h4><span class="en_view">' . get_field("designation") . '</span><span class="ar_view">' . get_field("designation_arbaic") . '</span></h4>
                              <p><span class="en_view">' . get_field("management_details") . '</span><span class="ar_view">' . get_field("management_details_arabic") . '</span></p>
                          </div> 
                      </div>
                  </div>
              </div>';

    endwhile;
    wp_reset_query();
    $data .= '</div>';

    return $data;
}
add_shortcode('committee_members_list_shortcode', 'committee_members_list');



// Committee Member List Shortcode Start - Special Account
function supervisory_members_list()
{
    ob_start();
    $data .= '<div class="team_container governor" >';

    $query = new WP_Query('post_type=board_members&member_type=supervisory-board&showposts=-1&order=ASC');
    while ($query->have_posts()):
        $query->the_post();
        $governorimg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($governorimg == "") {
            $governorimg = "/arabfund/wp-content/themes/arab-fund/assets/images/noimg_team_logo.png";
        }
        $post_id = get_the_ID();

        $data .= '<div class="team_box">
                  <div class="team_box_wrap">
                      <div class="team_imgbox">
                          <img class="img-responsive" src="' . $governorimg . '"  alt=' . get_field("member_title") . '>
                      </div>
                      <div class="team_inner">
                          <h3><span class="en_view">' . get_field("supervisory_board_member_name") . '</span><span class="ar_view">' . get_field("supervisory_board_member_name_arabic") . '</span></h3>
                          <div class="member-desg">
                              <h4><span class="en_view">' . get_field("member_states") . '</span><span class="ar_view">' . get_field("member_states_arabic") . '</span></h4>
                          </div> 
                      </div>
                  </div>
              </div>';

    endwhile;

    $data .= '</div>';
    wp_reset_query();
    return $data;
}
add_shortcode('supervisory_members_list_shortcode', 'supervisory_members_list');

function HamadWinners()
{
    ob_start();

    $query = new WP_Query(array(
        'post_type' => 'al-hamad-project',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'DESC',
    ));
    while ($query->have_posts()):
        $query->the_post();
        if (strlen(get_field("description")) !== 0) {
            $data .= '<div class="news_single_container" id="' . get_the_title() . '">';

            $post_id = get_the_ID();


            $data .= '<div class="content">
  			<h5>' . get_the_content() . '</h5>';
            $data .= '
  	<div class="newstype_date">
  		<div class="news_date">
        	<img src="/arabfund/wp-content/uploads/2023/11/calendar_icon.svg" alt="date-icon"><span>' . get_the_title() . '</span>
        </div>
    </div>
    <p>' . get_field("description") . '</p>';

            if (have_rows('video_urls', $post_id)):
                $data .= '<div class="video-gallery">';
                while (have_rows('video_urls', $post_id)):
                    the_row();



                    $video_event_urls = get_sub_field('url', $post_id);
                    //print_r($video_event_urls);
                    if ($video_event_urls) {

                        $data .= '<div class="video_frame">';
                        if (!empty($video_event_urls)) {
                            $data .= '                                     
                                  <div class="iframe-container">
                                    <iframe width="560" height="315" src="' . $video_event_urls . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" loading="lazy" allowfullscreen></iframe>
                                  </div>';
                        }
                        $data .= '   </div> ';


                    }
                endwhile;
                $data .= '</div>';
                // end video gallery


                // End loop. 

                // No value.
            else:
                // Do something...
            endif;


            $data .= '  </div>';


            $gallery_event_images = get_field('gallery');
            //  echo '<pre>';
            // print_r($gallery_event_images);
            //echo '</pre>';
            $data .= '<div class="container_gallery">';
            if ($gallery_event_images) {
                $data .= '<div class="media-gallery">';
                foreach ($gallery_event_images as $image):
                    if ($image['type'] == 'image') {
                        $img_url = $image['url'];
                        $img_alt = $image['alt'];
                        $data .= '<a href="' . $img_url . '" data-fancybox="gallery' . get_the_ID() . '" >
                                 <div class="mg-fb">
                                     <img src="' . $img_url . '">
                                 </div>
                             </a>';
                    } else {
                        $img_url = $image['url'];
                        // $data.='<video src="'.$img_url.'"></video>';
                        $data .= '<a href="' . $img_url . '" data-fancybox="images" >
                                   <div class="video-layer">
                                   <video src="' . $img_url . '"></video>
                                   </div>
                               </a>';
                    }



                endforeach;

                $data .= '</div>';

            }



            $data .= '</div>';

            if ($query->post_count != $query->current_post + 1) {
                $data .= '<br><hr>';
            }
        }



    endwhile;
    wp_reset_query();

    $data .= '
  	<script>
    	let projectsWon = document.getElementsByClassName("projects-won")[0];
        let titles = projectsWon.getElementsByClassName("eael-timeline-title");
        
        for (let i = 0; i < titles.length; i++) {
          let anchorTag = titles[i].children[0];
          let innerText = anchorTag.innerText;
          anchorTag.href = "#" + innerText;
        }

    </script>
  ';

    return $data;

}
add_shortcode('hamad_winners_shortcode', 'HamadWinners');

function HamadNews()
{
    $data = '';

    ob_start();

    $query = new WP_Query(array(
        'post_type' => 'al-hamad-news',
        'posts_per_page' => -1,
    ));

    while ($query->have_posts()):
        $query->the_post();

        $data .= '
            <div id="alHamadNewsDetails" class="ajax-content mfp-hide">
              <div class="country-card">

                  <div class="country-flag">
                      <p class="text-26">' . get_the_title() . '</p>
                  </div>

                  <p class="country-flag-title text-21 text-center">' . get_the_content() . '</p>

                  <div class="line"></div>

                  <div class="popup_footer">
                      <a href="javascript:void(0);" class="countries_btn countries_close close-popup-hamad">
                          <span class="en_view">Close</span><span class="ar_view">إغلاق</span>
                      </a>
                  </div>

              </div>
          </div>
        ';

    endwhile;


    if ($query->have_posts()) {
        $data .= '
      <div id="openHamadNews" class="icon-bar">
          <a href="#"><img width="50px" src="/arabfund/wp-content/uploads/2024/06/Hamad-Logo.svg" alt="Al-Hamad Award"></a>
      </div>
    ';
    }

    wp_reset_query();



    return $data;

}
add_shortcode('hamad_news_shortcode', 'HamadNews');


function Careers()
{
    ob_start();

    $query = new WP_Query(array(
        'post_type' => 'career',
        'posts_per_page' => -1,
        'orderby' => 'post_date',
        'order' => 'DESC',
    ));

    $data = '<div><ul>';
    while ($query->have_posts()):
        $query->the_post();

        $data .= '<li>' . get_field("name") . '</li>';


    endwhile;
    wp_reset_query();
    $data .= '</ul></div>';
    $data .= '
  	<script>
    	let projectsWon = document.getElementsByClassName("projects-won")[0];
        let titles = projectsWon.getElementsByClassName("eael-timeline-title");
        
        for (let i = 0; i < titles.length; i++) {
          let anchorTag = titles[i].children[0];
          let innerText = anchorTag.innerText;
          anchorTag.href = "#" + innerText;
        }

    </script>
  ';

    return $data;

}

add_shortcode('careers_shortcode', 'Careers');



function convertTimeToArabic($time)
{
    if (pll_current_language() == 'ar') {
        if (strpos($time, 'AM') !== false) {
            $converted_time = str_replace('AM', 'ص', $time);
        } elseif (strpos($time, 'PM') !== false) {
            $converted_time = str_replace('PM', 'م', $time);
        } else {
            $converted_time = $time;
        }
    } else {
        $converted_time = $time;
    }

    return $converted_time;
}

<?php

/*
Plugin Name:  Post Carousel for DV Builder
Author:       Crear
Author URI:   https://crear.kr
Version:      1.3.1
Description:  커스텀 포스트 유형 및 다양한 캐러셀 옵션을 지원하는 Divi 빌더용 포스트 캐러셀.
Requires PHP: 5.6
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  fh-post-carousel
*/

/*  Copyright 2019	Faiyaz Vaid  (email : vaidfaiyaz@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class FHDiviPostCarousel {

    public function __construct() {
        define( 'FH_POST_CAROUSEL_PATH', dirname(__FILE__) );
        define( 'FH_POST_CAROUSEL_URL', plugin_dir_url(__FILE__) );
        add_action( 'admin_notices', array($this,'fh_general_admin_notice') );
        add_action( 'et_builder_ready', array($this,'fh_divi_child_theme_setup') );
        add_action( 'wp_enqueue_scripts', array($this,'fh_post_carousel_scripts') );
    }

    public function fh_general_admin_notice() {
        $theme = wp_get_theme();
        if ( 'Divi' != $theme->name && 'Divi' != $theme->parent_theme ) {
            echo '<div class="notice notice-warning is-dismissible">
             <p>Divi theme not found. <b>Divi Post Carousel</b> plugin requires divi theme.</p>
         </div>';
        }
    }

    public function fh_divi_child_theme_setup() {
        if(class_exists('ET_Builder_Module')) {
            require( FH_POST_CAROUSEL_PATH."/includes/postcarousel.php" );
        }
    }

    public function fh_post_carousel_scripts() {
        wp_enqueue_style( 'fh-carousel-owl', FH_POST_CAROUSEL_URL.'/assets/css/owl.carousel.css' );
        wp_enqueue_style( 'fh-carousel-style', FH_POST_CAROUSEL_URL.'/assets/css/fh-carousel.css', array(), time() );
        wp_enqueue_script( 'fh-carousel-owl', FH_POST_CAROUSEL_URL.'/assets/js/owl.carousel.min.js', array('jquery') );
        wp_enqueue_script( 'fh-carousel-script', FH_POST_CAROUSEL_URL.'/assets/js/fh-carousel.js', array('jquery'), time() );
    }

}


new FHDiviPostCarousel();
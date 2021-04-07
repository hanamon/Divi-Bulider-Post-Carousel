<?php
/*
 * Plugin Name:	  Divi 빌더용 게시물 캐러셀
 * Plugin URI: 	  https://parkhana.com	
 * Description:	  커스텀 게시물 유형 및 다양한 캐러셀 옵션을 지원하는 Divi 빌더용 게시물 캐러셀입니다.
 * Version:		  1.0.0
 * Author:		  Hanamon
 * Author URI:	  https://parkhana.com
 * Text Domain:	  hm-post-carousel
 * Domain Path:	  /languages
 * Requires PHP:  5.6
 * License:		  GPL v2 or later
 * License URI:	  https://www.gnu.org/licenses/gpl-2.0.html
 */

/*
	Copyright 2021 Hanamon (email : devparkhana@gmail.com)
	
	본 플러그인은 GPL V2 라이센스를 지키며 'Post Carousel for DV Builder'에 사용된 코드를 포함(Forking)하고 있습니다.
	
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

if ( ! defined( 'ABSPATH' ) ) exit;

class HMDiviPostCarousel {

	// __construct() 메소드로 초기화
    public function __construct() {
		// 상수 선언
        define( 'HM_POST_CAROUSEL_PATH', dirname(__FILE__) );
        define( 'HM_POST_CAROUSEL_URL', plugin_dir_url(__FILE__) );
		
		add_action( 'admin_notices', array($this,'hm_general_admin_notice') );
		add_action( 'et_builder_ready', array($this,'hm_divi_child_theme_setup') );
        add_action( 'wp_enqueue_scripts', array($this,'hm_post_carousel_scripts') );
    }

	// 디비 테마가 활성화 되었는지 확인 후 비활성화면 경고 메세지 출력 -- admin_notices() WP 액션 후크로 실행
    public function hm_general_admin_notice() {
        $theme = wp_get_theme();
        if ( 'Divi' != $theme->name && 'Divi' != $theme->parent_theme ) {
            echo '<div class="notice notice-warning is-dismissible">
					<p>Divi 테마를 찾을 수 없습니다. <b>Divi Post Carousel</b> 플러그인에는 Divi 테마가 필요합니다.</p>
				  </div>';
        }
    }

	// 디비 테마 모듈 추가 -- et_builder_ready() Divi 액션 후크로 실행
    public function hm_divi_child_theme_setup() {
        // Builder Module 클래스가 있는지 확인하고 true이면 새 모듈 클래스를 실행합니다.
		if(class_exists('ET_Builder_Module')) {
            require( HM_POST_CAROUSEL_PATH."/includes/postcarousel.php" );
        }
    }

	// 워드프레스 스크립트와 스타일이 대기열에 추가되면 실행 -- wp_enqueue_scripts() WP 액션 후크로 실행
    public function hm_post_carousel_scripts() {
        wp_enqueue_style( 'fh-carousel-owl', HM_POST_CAROUSEL_URL.'/assets/css/owl.carousel.css' );
        wp_enqueue_style( 'fh-carousel-style', HM_POST_CAROUSEL_URL.'/assets/css/fh-carousel.css', array(), time() );
        wp_enqueue_script( 'fh-carousel-owl', HM_POST_CAROUSEL_URL.'/assets/js/owl.carousel.min.js', array('jquery') );
        wp_enqueue_script( 'fh-carousel-script', HM_POST_CAROUSEL_URL.'/assets/js/fh-carousel.js', array('jquery'), time() );
    }

}

new HMDiviPostCarousel();
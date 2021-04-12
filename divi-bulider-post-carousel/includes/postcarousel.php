<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('ET_Builder_Module_HM_Divi_Post_Carousel') ) {
	class ET_Builder_Module_HM_Divi_Post_Carousel extends ET_Builder_Module_Type_PostBased {		
		// init() : 초기화
		function init() {
			// $name : 모듈 이름
			$this->name			= '게시물 캐러셀';
			// $name : 모듈 이름 복수형
			$this->plural		= '게시물 캐러셀';
			// $slug : 모듈 숏코드 슬러그
			$this->slug			= 'et_pb_hm_post_carousel';
			// $vb_support : 호환성 선언
			$this->vb_support	= 'on';
			
			// $settings_modal_toggles : 모듈 설정(토글) 그룹 이름
			$this->settings_modal_toggles = array(
				// 모듈 > 컨텐츠 설정 그룹
				'general'  => array(
					'toggles' => array(
						'main_content'		=> '컨텐츠',				
						'elements'			=> '요소',
						'featured_image'	=> '대표 이미지',
						'post_background'	=> '게시물 배경',					
					),
				),				
				// 모듈 > 디자인 설정 그룹
				'advanced' => array(
					'toggles' => array(
						'carousel'	 => '캐러셀',
						'navigation' => '네비게이션',
						'text'		 => array(
							'title'    => '텍스트',
							'priority' => 30, // 이 숫자를 기준으로 그룹이 정렬됩니다. (가장 낮은 것부터 높은 것까지)
						),
						'image' => array(
							'title' => esc_html__( 'Image', 'et_builder' ),
						),
					),
				),
			);

			// $advanced_fields : 모듈 '디자인' 설정 그룹의 필드 구성
			$this->advanced_fields = array(
				// 제목 본문 메타 텍스트 필드 구성
				'fonts'				=> array(
					'header' => array(
						'label'			=> '제목',
						'css'			=> array( // 여기서 정의한 CSS에 적용된다.
							'main' 			=> "{$this->main_css_element} .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_title, {$this->main_css_element} .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_title a",
							'important' 	=> 'all',
						),
						'header_level'	=> array(
							'default' => 'h2',
						),
						'font_size'		=> array(
							'default' => '20px',
						),
						'line_height'	=> array(
							'default' => '1em',
						),
					),
					'body'   => array(
						'label'			=> '본문',
						'css'			=> array(
							'main' 			=> "{$this->main_css_element} et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_content, {$this->main_css_element} et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_content div",
							'line_height' 	=> "{$this->main_css_element}, {$this->main_css_element} .et_pb_hm_post_carousel_content",
							'important' 	=> 'all',
						),
						'font_size'		=> array(
							'default' => '16px',
						),
						'line_height'	=> array(
							'default' => '1em',
						),
					),
					'meta'   => array(
						'label'			=> '메타',
						'css'			=> array(
							'main' 			=> "{$this->main_css_element} .et_pb_hm_post_carousel_content .post-meta, {$this->main_css_element} .et_pb_hm_post_carousel_content .post-meta a",
							'limited_main' 	=> "{$this->main_css_element} .et_pb_hm_post_carousel_content .post-meta, {$this->main_css_element} .et_pb_hm_post_carousel_content .post-meta a, {$this->main_css_element} .et_pb_hm_post_carousel_content .post-meta span",
							'important' 	=> 'all',
						),
						'font_size'		=> array(
							'default' => '13px',
						),
						'line_height'	=> array(
							'default' => '1em',
						),
					),
				),
				'button'			=> array(
					'button' => array(
						'label'			=> '버튼',
						'css'			=> array(
							'main'			=> "{$this->main_css_element} .et_pb_more_button.et_pb_button",
							'limited_main'	=> "{$this->main_css_element} .et_pb_more_button.et_pb_button",
							'alignment'		=> "{$this->main_css_element} .et_pb_button_wrapper",
						),
						'use_alignment'	=> true,
						'box_shadow'	=> array(
							'css' => array(
								'main' => '%%order_class%% .et_pb_button',
							),
						),
					),
				),
				'background'		=> array(
					'css' => array(
						'main'		=> "{$this->main_css_element}, {$this->main_css_element}.et_pb_bg_layout_dark",
					),
					'options' => array(
						'parallax_method'	=> array(
							'default'		=> 'off',
						),
						'background_color'	=> array(
							'default'		=> '',
						),
					),
				),
				'borders'			=> array(
					'default' => array(
						'css'		=> array(
							'main'		=> array(
								'border_radii'	=> "{$this->main_css_element} .et_pb_hm_carousel_item",
								'border_styles'	=> "{$this->main_css_element} .et_pb_hm_carousel_item",
							),
						),
						'defaults'	=> array(
							'border_radii'	=> array(),
							'border_styles'	=> array(
								'width' => '0',
								'color' => '',
								'style' => 'solid',
							),
						)
					),
				),
				'margin_padding'	=> array(
					'css' => array(
						'main'		=> '%%order_class%%',
						'padding'	=> '%%order_class%% .et_pb_hm_post_carousel_description, .et_pb_hm_post_carousel_fullwidth_off%%order_class%% .et_pb_hm_post_carousel_description',
						'important'	=> array( 'custom_margin' ), // 마지막 모듈 margin-bottom 스타일을 덮어 쓰는데 필요
					),
				),
				'text'				=> array(
					'css' => array(
						'main' => implode( ', ', array(
							'%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_title',
							'%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_title a',
							'%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_content',
							'%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_content .post-meta',
							'%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_content .post-meta a',
							'%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_content .et_pb_button',
						) ),
						'text_orientation' => '%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description',
						'text_shadow'      => '%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_description',
					),
					'options' => array(
						'text_orientation'  => array(
							'default_on_front' => 'center',
						),
						'background_layout' => array(
							'default_on_front' => 'light',
							'hover' => 'tabs',
						),
					),
					'use_background_layout' => true,
				),
				'box_shadow'		=> array(
					'default' => array(
						'css' => array(
							'main' => "{$this->main_css_element} .et_pb_hm_carousel_item",
						),
					),
				),
			);

			// $custom_css_fields : 모듈 '고급' 설정 그룹의 필드 구성
			$this->custom_css_fields = array(
				'slide_image' => array(
					'label'    => '슬라이드 이미지',
					'selector' => '.et_pb_hm_post_carousel_image',
				),
				'slide_description' => array(
					'label'    => '슬라이드 설명',
					'selector' => '.et_pb_hm_post_carousel_description',
				),
				'slide_title' => array(
					'label'    => '슬라이드 제목',
					'selector' => '.et_pb_hm_post_carousel_description .et_pb_hm_post_carousel_title',
				),
				'slide_meta' => array(
					'label'    => '슬라이드 메타',
					'selector' => '.et_pb_hm_post_carousel_content .post-meta',
				),
				'slide_button' => array(
					'label'    => '슬라이드 버튼',
					'selector' => '.et_pb_hm_post_carousel a.et_pb_more_button.et_pb_button',
					'no_space_before_selector' => true,
				),
				'slide_controllers' => array(
					'label'    => '슬라이드 제어기',
					'selector' => '.et-pb-controllers',
				),
				'slide_active_controller' => array(
					'label'    => '슬라이드 활성 제어기',
					'selector' => '.et-pb-controllers .et-pb-active-control',
				),
			);
		}

		// get_fields() : 토글 그룹의 '하위 필드' 추가하기 return array();
		function get_fields() {
			/* (1) */
			// 변수 선언
			$post_types_arr		= '';		// 객체 : '모든' 게시물 유형의 슬러그
			$post_types_txt		= '';		// 객체 : '모든' 게시물 유형의 슬러그 (앞글자 대문자)		
			$taxonomies			= array(); 	// 배열 : foreach($type) 게시물 유형에 '모든' 분류
			$taxonomy_details	= ''; 		// 객체 : foreach($type) 게시물 유형에 foreach($tax) 분류의 모든 세부 정보
			$taxoArr			= array();	// 배열 : foreach($type) 게시물 유형에 foreach($tax) 분류의 모든 세부 정보 중 일부(label)를 배열화		
			$termsData			= array();	// 배열 : foreach($type) 게시물 유형에 foreach($tax) 분류에 해당하는 모든 컨텐츠(terms)와 그 세부 정보

			$fields				= array();	// 배열 : return 할 Array() 변수이다.
			$taxonomyfields		= array();	// 배열 : foreach($type) 게시물 유형에 foreach($tax) 분류와 해당하는 모든 컨텐츠(terms)를 각 배열에 삽입 / $fields 배열에 추가된다.
			$fieldPart2			= array();	// 배열

			/* (2) */
			// get_post_type() WP 함수 : 게시물 유형('public'=>true)을 가져온다.
			$post_types_arr = get_post_types( array('public'=>true) );	

			// array_map() PHP 내장함수 : $post_types (배열/객체)을 PHP 내장함수 ucfirst() 함수로 보내고 그 함수에서 제공한 새 값을 반환한다. ucfirst() PHP 내장함수 : 알파벳 문자열의 첫 글자를 대문자로 반환한다.
			$post_types_txt = array_map('ucfirst', $post_types_arr);

			/* (3) */
			// if 문 : $post_types_txt 객체가 true면 실행한다.
			if( $post_types_txt ) {
				// foreach 문 : $post_types_arr 객체의 프로퍼티(post,page,product...) 수 만큼 반복하여 동작한다.
				foreach( $post_types_arr as $type ) {					
					// echo '<script>';
					// echo 'console.dir('. json_encode( $type ) .')';
					// echo '</script>';

					// get_object_taxonomies() WP 함수 : 주어진 게시물 유형에 모든 분류 이름을 검색한다.
					$taxonomies = get_object_taxonomies( array('post_type'=>$type) );
					// echo '<script>';
					// echo 'console.dir('. json_encode( $taxonomies ) .')';
					// echo '</script>';

					// 이 배열 변수는 여기에서 선언 해줘야한다.
					$taxoArr = array();

					// if 문 : $taxonomies가 true이고 count($taxonomies)가 true면 실행된다.
					if( $taxonomies && count($taxonomies) ) {
						// foreach 문 : $taxonomies 배열의 프로퍼티("category","post_tag"...) 수 만큼 반복하여 동작한다.
						foreach( $taxonomies as $tax ) {
							// echo '<script>';
							// echo 'console.dir('. json_encode( $tax ) .')';
							// echo '</script>';
							
							// get_taxonomy() WP 함수 : 매개 변수 문자열이 'WP 분류 객체'인지 확인하고 맞다면 그것을 반환한다.
							$taxonomy_details = get_taxonomy( $tax );
							// echo '<script>';
							// echo 'console.dir('. json_encode( $taxonomy_details ) .')';
							// echo '</script>';

							// $taxonomies 배열의 프로퍼티(category, post_tag...)를 Key로
							// $taxonomies 배열의 프로퍼티 각각의 $taxonomy_details 객체의 label 프로퍼티를 Value로 $taxoArr 배열에 담는다.
							$taxoArr[$tax]	  = $taxonomy_details->label;					
							// echo '<script>';
							// echo 'console.dir('. json_encode( $taxoArr ) .')';
							// echo '</script>';
							
							// get_terms() WP 함수 : 지정된 분류에서 모든 컨텐츠를 검색한다. ()
							$termsData 		  = get_terms( array(
								'taxonomy'	 => $tax,
								'hide_empty' => true,
							) );							
							// echo '<script>';
							// echo 'console.dir('. json_encode( $termsData ) .')';
							// echo '</script>';
						}

						// $taxonomyfields 배열 : 게시물의 분류 불러오기 (카테고리, 태그... 등)
						$taxonomyfields['include_taxonomy_'.$type] = array(
							'label'           => '분류 선택',
							'type'            => 'select',
							'option_category' => 'basic_option',
							'options'         => $taxoArr,
							'default'         => 30,
							'toggle_slug'     => 'main_content',
							'show_if'         => array(
								'selected_post_type' => array( $type ),
							),
						);

						// foreach 문 : $taxonomies 배열의 프로퍼티("category","post_tag"...) 수 만큼 반복하여 동작한다.
						foreach( $taxonomies as $tax ) {
							// $taxonomyfields 배열 : 게시물의 분류의 카테고리 선택 (국어, 수학, 영어... 등)
							$taxonomyfields['include_cat_'.$tax] = array(
								'label'             => '카테고리 선택',
								'type'              => 'categories',
								'option_category'   => 'basic_option',
								'default'         	=> 40,
								'description'       => '캐러셀에 표시 할 카테고리를 선택하세요.',
								'toggle_slug'       => 'main_content',
								'taxonomy_name'     => $tax,
								'show_if'           => array(
									'include_taxonomy_'.$type => array( $tax ),
									'selected_post_type' => array( $type ),
								),
							);
						}
					}
				}
			}

			/* (4) */
			// $fields : return 할 Array의 기본 배열 
			$fields = array(
				'selected_post_type' => array(
					'label'             => '게시물 유형 선택',
					'type'              => 'select',
					'options'           => $post_types_txt,
					'description'       => '캐러셀에 표시할 게시물 유형을 선택하세요.',
					'toggle_slug'       => 'main_content',
					'computed_affects'  => array(
						'__hmcallback',
					),
				),
				'posts_number' => array(
					'label'            => '표시할 게시물 수',
					'type'             => 'text',
					'option_category'  => 'basic_option',
					'renderer_options' => array(
						'use_terms' => false,
					),
					'description'      => '표시할 게시물 수를 입력하세요.',
					'toggle_slug'      => 'main_content',
					'default'          => 10,
					'computed_affects' => array(
						'__hmcallback',
					),
				),		
			);

			/* (5) */
			// foreach 문 : $taxonomyfields 배열의 요소 수 만큼 반복하여 동작한다. (Key와 Value를 가져온다.)
			foreach( $taxonomyfields as $key => $tax ) {
				// $taxonomyfields 배열의 키와 값을 $fields 배열에 추가합니다.
				$fields[$key] = $tax;
			}

			/* (6) */
			$fieldPart2 = array(
				// 'toggle_slug' => 'main_content'
				'orderby' => array(
					'label'             => '정렬 기준',
					'type'              => 'select',
					'option_category'   => 'configuration',
					'options'           => array(
						'date_desc'  => '날짜: 내림순',
						'date_asc'   => '날짜: 오름순',
						'title_asc'  => '제목: a-z',
						'title_desc' => '제목: z-a',
						'rand'       => '무작위',
					),
					'default_on_front'  => 'date_desc',
					'toggle_slug'       => 'main_content',
					'description'       => '여기서 게시물이 표시되는 순서를 조정할 수 있습니다.',
					'computed_affects'  => array(
						'__hmcallback',
					),					
				),
				'more_text' => array(
					'label'             => '버튼 텍스트',
					'type'              => 'text',
					'option_category'   => 'configuration',
					'default_on_front'  => '더 읽기',
					'depends_show_if'   => 'on',
					'toggle_slug'       => 'main_content',
					'dynamic_content'   => 'text',
					'description'       => '"더 읽기" 버튼에 표시 될 텍스트를 정의합니다. 기본값은 공백으로 두십시오.',
				),
				'content_source' => array(
					'label'             => '컨텐츠 화면',
					'type'              => 'select',
					'option_category'   => 'configuration',
					'options'           => array(
						'off' => '발췌본 보여주기',
						'on'  => '글내용 보여주기',
					),
					'default'           => 'off',
					'affects' 			=> array(
						'use_manual_excerpt',
						'excerpt_length',
					),
					'description'       => '전체 콘텐츠를 표시해도 캐러셀에서 게시물이 잘리지 않습니다. 발췌문을 표시하면 발췌문 만 표시됩니다.',
					'toggle_slug'       => 'main_content',
					'computed_affects'  => array(
						'__hmcallback',
					),
				),
				'use_manual_excerpt' => array(
					'label'             => '정의 된 경우 게시물 발췌 사용',
					'type'              => 'yes_no_button',
					'option_category'   => 'configuration',
					'options'           => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default'           => 'on',
					'depends_show_if'   => 'off',
					'description'       => '수동으로 정의한 발췌 부분을 무시하고 항상 자동으로 생성하려면이 옵션을 비활성화하십시오.',
					'toggle_slug'       => 'main_content',
					'computed_affects'  => array(
						'__hmcallback',
					),
				),
				'excerpt_length' => array(
					'label'             => '자동 발췌 길이',
					'type'              => 'text',
					'default'           => '270',
					'option_category'   => 'configuration',
					'depends_show_if'   => 'off',
					'description'       => '자동으로 생성 된 발췌문의 길이를 정의합니다. 기본값은 비워 둡니다.',
					'toggle_slug'       => 'main_content',
					'computed_affects'  => array(
						'__hmcallback',
					),
				),

				// 'toggle_slug' => 'elements'
				'show_arrows' => array(
					'label'            => '화살표 표시',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'description'      => '이 설정은 탐색 화살표를 켜고 끕니다.',
					'toggle_slug'      => 'elements',
				),
				'show_pagination' => array(
					'label'             => '컨트롤 표시',
					'type'              => 'yes_no_button',
					'option_category'   => 'configuration',
					'options'           => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front'  => 'on',
					'description'       => '이 설정은 캐러셀 하단에 있는 원 버튼을 켜고 끕니다.',
					'toggle_slug'       => 'elements',
				),
				'show_more_button' => array(
					'label'             => '자세히 보기 버튼',
					'type'              => 'yes_no_button',
					'option_category'   => 'configuration',
					'options'           => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front'  => 'on',
					'affects' => array(
						'more_text',
					),
					'description'       => '이 설정은 더 읽기 버튼을 켜고 끕니다.',
					'toggle_slug'       => 'elements',
				),
				'show_meta' => array(
					'label'            => '게시물 메타 표시',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'description'      => '이 설정은 메타 섹션을 켜고 끕니다.',
					'toggle_slug'      => 'elements',
				),
				'show_description' => array(
					'label'            => '게시물 설명 표시',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'description'      => '이 설정은 설명 섹션을 켜고 끕니다.',
					'toggle_slug'      => 'elements',
				),
				'learndash_course_grid_short_description' => array(
					'label'            => '런대쉬 코스 그리드 간단한 설명 표시',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'description'      => '이 설정은 런대쉬 코스 그리드 간단 설명을 켜고 끕니다.',
					'toggle_slug'      => 'elements',
				),

				// 'toggle_slug' => 'featured_image'
				'show_image' => array(
					'label'             => '대표 이미지 보여주기',
					'type'              => 'yes_no_button',
					'option_category'   => 'configuration',
					'options'           => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front'  => 'on',
					'affects'           => array(
						'image_placement',
						'link_image',
					),					
					'description'       => '이 설정은 캐러셀의 특성 이미지를 켜고 끕니다.',
					'toggle_slug'       => 'featured_image',
				),
				'link_image' => array(
					'label'             => '이미지에 링크 적용',
					'type'              => 'yes_no_button',
					'option_category'   => 'configuration',
					'options'           => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front'  => 'on',
					'depends_show_if'   => 'on',
					'description'       => '이 설정은 캐러셀의 특성 이미지에 게시물 링크를 적용합니다.',
					'toggle_slug'       => 'featured_image',
				),
				'image_placement' => array(
					'label'             => '이미지 배치',
					'type'              => 'select',
					'option_category'   => 'configuration',
					'options'           => array(
						'background' => '배경',
						'top'        => '상단',
						'bottom'     => '아래',
					),
					'default_on_front'  => 'top',
					'depends_show_if'   => 'on',		
					'description'       => '슬라이드에 특성 이미지를 표시 할 방법을 선택하십시오.',
					'toggle_slug'       => 'featured_image',
				),

				// 'toggle_slug' => 'post_background'
				'post_bg' => array(
					'label'			=> '게시물 항목 배경색',
					'type'			=> 'color-alpha',
					'custom_color'	=> true,				
					'default'		=> '#fff',
					'description'	=> '이 설정은 추천 이미지 배치가 배경으로 설정된 경우 무시 된 게시물 항목에 배경색을 적용합니다.',
					'toggle_slug'	=> 'post_background',
				),

				//'toggle_slug' => 'carousel'
				'equal_height_posts' => array(
					'label'            => '게시물 높이 균등화',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'tab_slug'         => 'advanced',					
					'description'      => '활성화하면 모든 캐 러셀 항목의 높이가 동일합니다.',
					'toggle_slug'      => 'carousel',
				),
				'autoplay' => array(
					'label'            => '자동 재생 캐 러셀',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'affects'          => array(
						'autoplay_time',
						'autoplay_hoverpause'
					),
					'description'      => '사용 설정하면 캐러셀이 자동으로 회전하기 시작합니다.',
					'tab_slug'         => 'advanced',				
					'toggle_slug'      => 'carousel',
				),
				'autoplay_time' => array(
					'label'             => '자동 재생 시간',
					'type'              => 'range',
					'range_settings'    =>  array(
						'min'  => '1000',
						'max'  => '10000',
						'step' => '500',
					),
					'default' 			=> '5000',
					'validate_unit' 	=> true,
					'option_category'   => 'configuration',
					'description'       => '캐러셀의 자동 재생 시간을 정의합니다.',
					'tab_slug'        	=> 'advanced',
					'toggle_slug'       => 'carousel',
					'computed_affects'  => array(
						'__hmcallback',
					),
				),
				'autoplay_hoverpause' => array(
					'label'            => '자동 재생 호버 일시 중지',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'off',
					'affects'          => array(
						'autoplay_time',
					),
					'description'      => '활성화 된 경우 마우스가 캐러셀 항목에 들어가면 캐러셀 이동이 중지됩니다.',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'carousel',
				),
				'carousel_items' => array(
					'label'             => '표시 할 항목',
					'type'              => 'text',
					'default' 			=> '3',
					'option_category'   => 'configuration',
					'description'       => '캐러셀을 표시할 캐러셀 항목을 정의합니다.',
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'carousel',
					'computed_affects'  => array(
						'__hmcallback',
					),
					'mobile_options'    => true,
					'responsive'        => true,
				),				
				'loop' => array(
					'label'            => '루프 항목',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'description'      => '사용 설정하면 캐러셀이 무한 회전합니다.',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'carousel',				
				),
				'item_margin' => array(
					'label'             => '항목 사이의 여백',
					'type'              => 'range',
					'range_settings'    =>  array(
						'min'  => '0',
						'max'  => '30',
						'step' => '10',
					),
					'default' 			=> '0',
					'validate_unit' 	=> true,
					'option_category'   => 'configuration',
					'description'       => '캐러셀을 표시할 캐러셀 항목을 정의합니다.',
					'tab_slug'        	=> 'advanced',
					'toggle_slug'       => 'carousel',
					'computed_affects'  => array(
						'__hmcallback',
					),
				),
				'mouse_drag' => array(
					'label'            => '마우스 드래그',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'description'      => '활성화되면 마우스를 사용하여 캐러셀을 드래그 할 수 있습니다.',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'carousel',			
				),
				'touch_drag' => array(
					'label'            => '터치 드래그',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'on',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'carousel',
					'description'      => '활성화되면 터치 장치에서 터치를 사용하여 캐러셀을 드래그 할 수 있습니다.',
				),
				'rewind' => array(
					'label'            => '되감기',
					'type'             => 'yes_no_button',
					'option_category'  => 'configuration',
					'options'          => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'off',
					'description'      => '사용 설정하면 최종 항목에 도달하면 캐러셀이 되감기 시작됩니다.',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'carousel',
				),
				'slide_by' => array(
					'label'            => '슬라이드',
					'type'             => 'text',
					'option_category'  => 'configuration',
					'default_on_front' => '1',
					'description'      => '한 번에 슬라이드하려는 항목 수를 입력하십시오.',
					'tab_slug'         => 'advanced',
					'toggle_slug'      => 'carousel',	
				),
				'dots_each' => array(
					'label'           => '단일 점',
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'off',
					'description'     => '사용 설정하면 캐러셀에 캐러셀 항목에 대해 단일 점이 표시됩니다.',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'carousel',	
				),
				'lazy_load' => array(
					'label'           => '지연로드',
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'on'  => '네',
						'off' => '아니요',
					),
					'default_on_front' => 'off',
					'description'     => '활성화되면 캐러셀 이미지가 지연로드됩니다.',
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'carousel',			
				),				

				// 'toggle_slug'  => 'navigation'
				'arrows_custom_color' => array(
					'label'        => '화살표 사용자 정의 색상',
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'navigation',
				),
				'dot_nav_custom_color' => array(
					'label'        => '점 네비게이션 사용자 정의 색상',
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'navigation',
				),

				// computed
				'__hmcallback' => array(
					'type'                => 'computed',
					'computed_callback'   => array( 'ET_Builder_Module_HM_Divi_Post_Carousel', 'get_blog_posts' ),
					'computed_depends_on' => array(
						'tax_query',
						'orderby',
						'content_source',
						'use_manual_excerpt',
						'excerpt_length',
					),
				),
			);

			/* (7) */
			foreach( $fieldPart2 as $key => $tax ) {
				$fields[$key] = $tax;
			}

			/* (8) */
			return $fields;
		}

		public function get_transition_fields_css_props() {
			$fields = parent::get_transition_fields_css_props();
			$fields['background_layout'] = array(
				'background-color' => '%%order_class%% .et_pb_hm_post_carousel_overlay_container, %%order_class%% .et_pb_text_overlay_wrapper',
				'color' => self::$_->array_get( $this->advanced_fields, 'text.css.main', '%%order_class%%' ),
			);

			$fields['bg_overlay_color'] = array(
				'background-color' => '%%order_class%% .et_pb_hm_post_carousel .et_pb_hm_post_carousel_overlay_container',
			);

			$fields['text_overlay_color'] = array(
				'background-color' => '%%order_class%% .et_pb_hm_post_carousel .et_pb_text_overlay_wrapper',
			);

			return $fields;
		}

		static function get_blog_posts( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {
			global $wp_query;

			$defaults = array(
				'post_type'          => 'post',
				'posts_number'       => '',
				'orderby'            => '',
				'content_source'     => '',
				'use_manual_excerpt' => '',
				'excerpt_length'     => '',
			);

			$args = wp_parse_args( $args, $defaults );			

			$query_args = array(
				'posts_per_page' => (int) $args['posts_number'],
				'post_status'    => 'publish',
			);

			if ( '' !== $args['post_type'] ) {
				$query_args['post_type'] = $args['post_type'];
			}

			if ( '' !== $args['tax_query'] ) {
				$query_args['tax_query'] = $args['tax_query'];
			}

			if ( 'date_desc' !== $args['orderby'] ) {
				switch ( $args['orderby'] ) {
					case 'date_asc':
						$query_args['orderby'] = 'date';
						$query_args['order'] = 'ASC';
						break;
					case 'title_asc':
						$query_args['orderby'] = 'title';
						$query_args['order'] = 'ASC';
						break;
					case 'title_desc':
						$query_args['orderby'] = 'title';
						$query_args['order'] = 'DESC';
						break;
					case 'rand':
						$query_args['orderby'] = 'rand';
						break;
				}
			}

			$query = new WP_Query( $query_args );

			// Keep page's $wp_query global
			$wp_query_page = $wp_query;

			// Turn page's $wp_query into this module's query
			$wp_query = $query; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

			if ( $query->have_posts() ) {
				$post_index = 0;
				while ( $query->have_posts() ) {
					$query->the_post();

					$post_author_id = $query->posts[ $post_index ]->post_author;

					$categories = array();

					$categories_object = get_the_terms( get_the_ID(), 'category' );

					if ( ! empty( $categories_object ) ) {
						foreach ( $categories_object as $category ) {
							$categories[] = array(
								'id' => $category->term_id,
								'label' => $category->name,
								'permalink' => get_term_link( $category ),
							);
						}
					}

					$query->posts[ $post_index ]->post_featured_image = esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) );
					$query->posts[ $post_index ]->has_post_thumbnail  = has_post_thumbnail();
					$query->posts[ $post_index ]->post_permalink      = get_the_permalink();
					$query->posts[ $post_index ]->post_author_url     = get_author_posts_url( $post_author_id );
					$query->posts[ $post_index ]->post_author_name    = get_the_author_meta( 'display_name', $post_author_id );
					$query->posts[ $post_index ]->post_date_readable  = get_the_date();
					$query->posts[ $post_index ]->categories          = $categories;
					$query->posts[ $post_index ]->post_comment_popup  = et_core_maybe_convert_to_utf_8( sprintf( esc_html( _nx( '%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) ) );

					$post_content = et_strip_shortcodes( get_the_content(), true );

					global $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;

					$global_processing_original_value = $et_fb_processing_shortcode_object;

					// reset the fb processing flag
					$et_fb_processing_shortcode_object = false;
					// set the flag to indicate that we're processing internal content
					$et_pb_rendering_column_content = true;

					if ( $is_ajax_request ) {
						// reset all the attributes required to properly generate the internal styles
						ET_Builder_Element::clean_internal_modules_styles();
					}

					if ( 'on' === $args['content_source'] ) {
						global $more;

						// page builder doesn't support more tag, so display the_content() in case of post made with page builder
						if ( et_pb_is_pagebuilder_used( get_the_ID() ) ) {
							$more = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

							// do_shortcode for Divi Plugin instead of applying `the_content` filter to avoid conflicts with 3rd party themes
							$builder_post_content = et_is_builder_plugin_active() ? do_shortcode( $post_content ) : apply_filters( 'the_content', $post_content );

							// Overwrite default content, in case the content is protected
							$query->posts[ $post_index ]->post_content = $builder_post_content;
						} else {
							$more = null; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

							// Overwrite default content, in case the content is protected
							$query->posts[ $post_index ]->post_content = et_is_builder_plugin_active() ? do_shortcode( get_the_content( '' ) ) : apply_filters( 'the_content', get_the_content( '' ) );
						}
					} else {
						if ( has_excerpt() && 'off' !== $args['use_manual_excerpt'] ) {
							$query->posts[ $post_index ]->post_content =  et_is_builder_plugin_active() ? do_shortcode( et_strip_shortcodes( get_the_excerpt(), true ) ) : apply_filters( 'the_content', et_strip_shortcodes( get_the_excerpt(), true ) );
						} else {
							$query->posts[ $post_index ]->post_content = strip_shortcodes( truncate_post( intval( $args['excerpt_length'] ), false, '', true ) );
						}
					}

					$et_fb_processing_shortcode_object = $global_processing_original_value;

					if ( $is_ajax_request ) {
						// retrieve the styles for the modules inside Blog content
						$internal_style = ET_Builder_Element::get_style( true );

						// reset all the attributes after we retrieved styles
						ET_Builder_Element::clean_internal_modules_styles( false );

						$query->posts[ $post_index ]->internal_styles = $internal_style;
					}

					$et_pb_rendering_column_content = false;

					$post_index++;
				} // end while
				wp_reset_query();
			} else if ( wp_doing_ajax() || et_core_is_fb_enabled() ) {
				// This is for the VB
				$query  = '<div class="et_pb_no_results">';
				$query .= self::get_no_results_template();
				$query .= '</div>';

				$query = array( 'posts' => $query );
			}

			wp_reset_postdata();

			// Reset $wp_query to its origin
			$wp_query = $wp_query_page; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

			return $query;
		}

		function render( $attrs, $content=null, $render_slug ) {
			$selected_post_type              			= $this->props['selected_post_type'];
			$autoplay                        			= $this->props['autoplay'];
			$autoplay_time                   			= $this->props['autoplay_time'];
			$autoplay_hoverpause             			= $this->props['autoplay_hoverpause'];
			$carousel_items                  			= $this->props['carousel_items'];
			$carousel_items_tablet           			= $this->props['carousel_items_tablet'];
			$carousel_items_phone            			= $this->props['carousel_items_phone'];
			$carousel_items_last_edited      			= $this->props['carousel_items_last_edited'];
			$loop                            			= $this->props['loop'];
			$post_bg                         			= $this->props['post_bg'];
			$item_margin                     			= $this->props['item_margin'];
			$mouse_drag                      			= $this->props['mouse_drag'];
			$touch_drag                      			= $this->props['touch_drag'];
			$rewind                          			= $this->props['rewind'];
			$slide_by                        			= $this->props['slide_by'];
			$dots_each                       			= $this->props['dots_each'];
			$lazy_load                       			= $this->props['lazy_load'];
			$show_arrows                     			= $this->props['show_arrows'];
			$show_pagination                 			= $this->props['show_pagination'];
			$parallax                        			= $this->props['parallax'];
			$parallax_method                 			= $this->props['parallax_method'];
			$body_font_size                  			= $this->props['body_font_size'];
			$background_position             			= $this->props['background_position'];
			$background_size                 			= $this->props['background_size'];
			$background_repeat               			= $this->props['background_repeat'];
			$background_blend                			= $this->props['background_blend'];
			$posts_number                    			= $this->props['posts_number'];
			$selected_tax                    			= $this->props['include_taxonomy_'.$selected_post_type];
			$include_categories              			= '';
			if(!empty($selected_tax)) {			
				$include_categories          			= $this->props['include_cat_'.$selected_tax];
			}			
			$show_more_button                			= $this->props['show_more_button'];
			$more_text                       			= $this->props['more_text'];
			$content_source                  			= $this->props['content_source'];
			$background_color                			= $this->props['background_color'];
			$show_image                      			= $this->props['show_image'];
			$link_image                      			= $this->props['link_image'];
			$image_placement                 			= $this->props['image_placement'];
			$background_image                			= $this->props['background_image'];
			$background_layout               			= $this->props['background_layout'];
			$background_layout_hover         			= et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
			$background_layout_hover_enabled 			= et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
			$orderby                         			= $this->props['orderby'];
			$show_meta                       			= $this->props['show_meta'];
			$show_description                       	= $this->props['show_description'];
			$learndash_course_grid_short_description    = $this->props['learndash_course_grid_short_description'];
			$button_custom                   			= $this->props['custom_button'];
			$custom_icon                     			= $this->props['button_icon'];
			$use_manual_excerpt              			= $this->props['use_manual_excerpt'];
			$excerpt_length                  			= $this->props['excerpt_length'];
			$dot_nav_custom_color            			= $this->props['dot_nav_custom_color'];
			$arrows_custom_color             			= $this->props['arrows_custom_color'];
			$button_rel                      			= $this->props['button_rel'];
			$header_level                    			= $this->props['header_level'];
			$equal_height_posts              			= $this->props['equal_height_posts'];

			$post_index                      			= 0;
			$hide_on_mobile_class            			= '';//self::HIDE_ON_MOBILE;

			//print_r($include_categories); die;

			// Applying backround-related style to slide item since advanced_option only targets module wrapper
			if ( 'on' === $this->props['show_image'] && 'background' === $this->props['image_placement'] && 'off' === $parallax ) {
				if ('' !== $background_color) {
					ET_Builder_Module::set_style( $render_slug, array(
						'selector'    => '%%order_class%% .et_pb_hm_post_carousel:not(.et_pb_hm_post_carousel_with_no_image)',
						'declaration' => sprintf(
							'background-color: %1$s;',
							esc_html( $background_color )
						),
					) );
				}

				if ( '' !== $background_size && 'default' !== $background_size ) {
					ET_Builder_Module::set_style( $render_slug, array(
						'selector'    => '%%order_class%% .et_pb_hm_post_carousel',
						'declaration' => sprintf(
							'-moz-background-size: %1$s;
							-webkit-background-size: %1$s;
							background-size: %1$s;',
							esc_html( $background_size )
						),
					) );

					if ( 'initial' === $background_size ) {
						ET_Builder_Module::set_style( $render_slug, array(
							'selector'    => 'body.ie %%order_class%% .et_pb_hm_post_carousel',
							'declaration' => '-moz-background-size: auto; -webkit-background-size: auto; background-size: auto;',
						) );
					}
				}

				if ( '' !== $background_position && 'default' !== $background_position ) {
					$processed_position = str_replace( '_', ' ', $background_position );

					ET_Builder_Module::set_style( $render_slug, array(
						'selector'    => '%%order_class%% .et_pb_hm_post_carousel',
						'declaration' => sprintf(
							'background-position: %1$s;',
							esc_html( $processed_position )
						),
					) );
				}

				if ( '' !== $background_repeat ) {
					ET_Builder_Module::set_style( $render_slug, array(
						'selector'    => '%%order_class%% .et_pb_hm_post_carousel',
						'declaration' => sprintf(
							'background-repeat: %1$s;',
							esc_html( $background_repeat )
						),
					) );
				}

				if ( '' !== $background_blend ) {
					ET_Builder_Module::set_style( $render_slug, array(
						'selector'    => '%%order_class%% .et_pb_hm_post_carousel',
						'declaration' => sprintf(
							'background-blend-mode: %1$s;',
							esc_html( $background_blend )
						),
					) );
				}
			}
			else {
				if(empty($post_bg)) {
					$post_bg = '#fff';
				}
			}

			$fullwidth = 'et_pb_fullwidth_carousel' === $render_slug ? 'on' : 'off';

			$video_background = $this->video_background();
			$parallax_image_background = $this->get_parallax_image_background();

			$tax_query = array();

			if(!empty($include_categories) && !empty($selected_tax)) {
				$include_categories = explode(',',$include_categories);
				$tax_query = array(
					array(
						'taxonomy' => $selected_tax,
						'field' => 'term_id',
						'terms' => $include_categories
					)
				);				
			}

			ob_start();

			// Re-used self::get_blog_posts() for builder output
			$query = self::get_blog_posts(array(
				'post_type'          => $selected_post_type,
				'posts_number'       => $posts_number,
				'tax_query'          => $tax_query,
				'orderby'            => $orderby,
				'content_source'     => $content_source,
				'use_manual_excerpt' => $use_manual_excerpt,
				'excerpt_length'     => $excerpt_length,
			), array(), array(), false );

			$styleCounter = 0;

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();

					$slide_class = 'off' !== $show_image && in_array( $image_placement, array( 'left', 'right' ) ) && has_post_thumbnail() ? ' et_pb_hm_post_carousel_with_image' : '';
					$slide_class .= 'off' !== $show_image && ! has_post_thumbnail() ? ' et_pb_hm_post_carousel_with_no_image' : '';
					$slide_class .= " et_pb_bg_layout_{$background_layout}";
				?>
				<div class="et_pb_hm_carousel_item et_pb_media_alignment_center<?php echo esc_attr( $slide_class ); ?>" <?php if ( 'on' !== $parallax && 'off' !== $show_image && 'background' === $image_placement ) { printf( 'style="background-image:url(%1$s)"', esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) );  } ?><?php echo et_core_esc_previously( $data_dot_nav_custom_color ); echo et_core_esc_previously( $data_arrows_custom_color ); ?>>
					<?php
						if($styleCounter == 0) {
							$styleCounter++;
							if(!empty($post_bg)) {
								echo '<style>.et_pb_hm_post_carousel .owl-carousel .et_pb_hm_carousel_item { background-color:'.$post_bg.' } </style>';				
							}

							if($equal_height_posts === 'on') {
								echo '<style>.et_pb_hm_post_carousel .owl-carousel .owl-stage-outer { display: flex; } .et_pb_hm_post_carousel .owl-carousel .owl-stage { display: flex; } .et_pb_hm_post_carousel .owl-carousel .et_pb_hm_carousel_item { height: 100%; }</style>';				
							}
				
							if($data_dot_nav_custom_color = '' !== $dot_nav_custom_color) {
								echo '<style>.et_pb_hm_post_carousel .owl-carousel .owl-dots button { background-color:'.$dot_nav_custom_color.' } </style>';	
							}
				
							if($data_arrows_custom_color = '' !== $arrows_custom_color) {
								echo '<style>.et_pb_hm_post_carousel .owl-carousel .owl-nav button { color:'.$arrows_custom_color.' } </style>';
							}
						}
					?>
					<?php if ( 'on' === $parallax && 'off' !== $show_image && 'background' === $image_placement ) { ?>
						<div class="et_parallax_bg<?php if ( 'off' === $parallax_method ) { echo ' et_pb_parallax_css'; } ?>" style="background-image: url(<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>);"></div>
					<?php } ?>
					<div class="et_pb_container clearfix">
						<div class="et_pb_hm_post_carousel_container_inner">
							<?php if ( 'off' !== $show_image && has_post_thumbnail() && ! in_array( $image_placement, array( 'background', 'bottom' ) ) ) { ?>
								<div class="et_pb_hm_post_carousel_image">
									<?php if($link_image !== 'off') { ?>
									<a href="<?php the_permalink(); ?>">
									<?php } ?>
									<?php the_post_thumbnail(); ?>
									<?php if($link_image !== 'off') { ?>
									</a>
									<?php } ?>
								</div>
							<?php } ?>
							<div class="et_pb_hm_post_carousel_description">
									<<?php echo et_pb_process_header_level( $header_level, 'h2' ) ?> class="et_pb_hm_post_carousel_title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></<?php echo et_pb_process_header_level( $header_level, 'h2' ) ?>>
									<div class="et_pb_hm_post_carousel_content <?php if ( 'on' !== $show_content_on_mobile ) { echo esc_attr( $hide_on_mobile_class ); } ?>">
										<?php
										if ( 'off' !== $show_meta ) {
											printf(
												'<p class="post-meta">%1$s | %2$s | %3$s | %4$s</p>',
												et_get_safe_localization( sprintf( __( 'by %s', 'et_builder' ), '<span class="author vcard">' .  et_pb_get_the_author_posts_link() . '</span>' ) ),
												et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published">' . esc_html( get_the_date() ) . '</span>' ) ),
												get_the_category_list(', '),
												esc_html(
													sprintf(
														_nx(
															'%s Comment',
															'%s Comments',
															get_comments_number(),
															'number of comments',
															'et_builder'
														),
														number_format_i18n( get_comments_number() )
													)
												)
											);
										}
										?>
										<?php
										if( 'off' !== $show_description ){
											echo '<p class="post-html">' . et_core_intentionally_unescaped( $query->posts[ $post_index ]->post_content, 'html' ) . '</p>';
										}
										?>
										<?php
										if( 'off' !== $learndash_course_grid_short_description ){
											echo '<p class="learndash-course-grid-short-description">' . et_core_intentionally_unescaped( $query->posts[ $post_index ]->_learndash_course_grid_short_description, 'html' ) . '</p>';
										}
										?>
									</div>
								<?php
									// Render button
									$button_classname = array( 'et_pb_more_button' );

									echo et_core_esc_previously( $this->render_button( array(
										'button_classname' => $button_classname,
										'button_custom'    => $button_custom,
										'button_rel'       => $button_rel,
										'button_text'      => $more_text,
										'button_url'       => get_permalink(),
										'custom_icon'      => $custom_icon,
										'display_button'   => ( 'off' !== $show_more_button && '' !== $more_text ),
									) ) );
								?>
							</div> <!-- .et_pb_hm_post_carousel_description -->
							<?php if ( 'off' !== $show_image && has_post_thumbnail() && 'bottom' === $image_placement ) { ?>
								<div class="et_pb_hm_post_carousel_image">
									<?php if($link_image !== 'off') { ?>
									<a href="<?php the_permalink(); ?>">
									<?php } ?>
									<?php the_post_thumbnail(); ?>
									<?php if($link_image !== 'off') { ?>
									</a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div> <!-- .et_pb_container -->
				</div> <!-- .et_pb_hm_post_carousel -->
			<?php
				$post_index++;

				} // end while
			} // end if

			wp_reset_query();

			if ( ! $content = ob_get_clean() ) {
				$content  = '<div class="et_pb_no_results">';
				$content .= self::get_no_results_template();
				$content .= '</div>';
			}

			// Images: Add CSS Filters and Mix Blend Mode rules (if set)
			if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
				$this->add_classname( $this->generate_css_filters(
					$render_slug,
					'child_',
					self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
				) );
			}

			// Module classnames
			$this->add_classname( array(
				'et_pb_hm_post_carousel',
				"et_pb_hm_post_carousel_image_{$image_placement}",
			) );

			if ( 'off' === $fullwidth ) {
				$this->add_classname( 'et_pb_hm_post_carousel_fullwidth_off' );
			}

			if ( 'off' === $show_arrows ) {
				$this->add_classname( 'et_pb_hm_post_carousel_no_arrows' );
			}

			if ( 'off' === $show_pagination ) {
				$this->add_classname( 'et_pb_hm_post_carousel_no_pagination' );
			}

			if ( 'on' === $parallax ) {
				$this->add_classname( 'et_pb_hm_post_carousel_parallax' );
			}

			$data_background_layout       = '';
			$data_background_layout_hover = '';
			if ( $background_layout_hover_enabled ) {
				$data_background_layout = sprintf(
					' data-background-layout="%1$s"',
					esc_attr( $background_layout )
				);
				$data_background_layout_hover = sprintf(
					' data-background-layout-hover="%1$s"',
					esc_attr( $background_layout_hover )
				);
			}

			//data-auto-width="'.$auto_width.'"

			$output = sprintf(
				'<div%3$s class="%1$s"%7$s%8$s>
					%5$s
					%4$s
					<div class="et_pb_hm_post_carousels owl-carousel" data-autoplay="'.$autoplay.'" data-autoplaytimeout="'.$autoplay_time.'" data-hoverpause="'.$autoplay_hoverpause.'" data-items="'.$carousel_items.'" data-items-tablet="'.$carousel_items_tablet.'" data-items-phone="'.$carousel_items_phone.'" data-loop="'.$loop.'" data-margin="'.$item_margin.'" data-mouse-drag="'.$mouse_drag.'" data-touch-drag="'.$touch_drag.'" data-rewind="'.$rewind.'" data-slide-by="'.$slide_by.'" data-dots-each="'.$dots_each.'" data-lazy-load="'.$lazy_load.'">
						%2$s
					</div> <!-- .et_pb_hm_post_carousels -->
					%6$s
				</div> <!-- .et_pb_hm_post_carousel -->
				',
				$this->module_classname( $render_slug ),
				$content,
				$this->module_id(),
				$video_background,
				$parallax_image_background, // #5
				$this->inner_shadow_back_compatibility( $render_slug ),
				et_core_esc_previously( $data_background_layout ),
				et_core_esc_previously( $data_background_layout_hover )
			);

			return $output;
		}

		private function inner_shadow_back_compatibility( $functions_name ) {
			$utils = ET_Core_Data_Utils::instance();
			$atts  = $this->props;
			$style = '';

			if (
				version_compare( $utils->array_get( $atts, '_builder_version', '3.0.93' ), '3.0.99', 'lt' )
			) {
				$class = self::get_module_order_class( $functions_name );
				$style = sprintf(
					'<style>%1$s</style>',
					sprintf(
						'.%1$s.et_pb_hm_post_carousel .et_pb_hm_post_carousel {'
						. '-webkit-box-shadow: none; '
						. '-moz-box-shadow: none; '
						. 'box-shadow: none; '
						.'}',
						esc_attr( $class )
					)
				);

				if ( 'off' !== $utils->array_get( $atts, 'show_inner_shadow' ) ) {
					$style .= sprintf(
						'<style>%1$s</style>',
						sprintf(
							'.%1$s > .box-shadow-overlay { '
							. '-webkit-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); '
							. '-moz-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); '
							. 'box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); '
							. '}',
							esc_attr( $class )
						)
					);
				}
			}

			return $style;
		}
	}

	new ET_Builder_Module_HM_Divi_Post_Carousel;
}
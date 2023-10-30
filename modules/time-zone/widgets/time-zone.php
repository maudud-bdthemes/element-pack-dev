<?php

namespace ElementPack\Modules\TimeZone\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use ElementPack\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class Time_Zone extends Module_Base {

	public function get_name() {
		return 'bdt-time-zone';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Time Zone', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-time-zone';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'time', 'zone' ];
	}

	public function get_style_depends() {
		if ( $this->ep_is_edit_mode() ) {
			return [ 'ep-styles' ];
		} else {
			return [ 'ep-time-zone' ];
		}
	}

	public function get_script_depends() {
		if ( $this->ep_is_edit_mode() ) {
			return [ 'jclock', 'ep-scripts' ];
		} else {
			return [ 'jclock', 'ep-time-zone' ];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/WOMIk_FVRz4';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content_additional',
			[ 
				'label' => esc_html__( 'Time Zone', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'select_style',
			[ 
				'label'   => esc_html__( 'Select Style', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [ 
					'digital'  => esc_html__( 'Digital', 'bdthemes-element-pack' ),
					'analog_1' => esc_html__( 'Analog ', 'bdthemes-element-pack' ),
				],
				'default' => 'digital',
			]
		);

		$this->add_control(
			'select_gmt',
			[ 
				'label'   => esc_html__( 'Select GMT', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => [ 
					'local'  => 'Local GMT',
					'-0'     => 'UT or UTC - GMT -0',
					'+1'     => 'CET - GMT+1',
					'+2'     => 'EET - GMT+2',
					'+3'     => 'MSK - GMT+3',
					'+4'     => 'SMT - GMT+4',
					'+5'     => 'PKT - GMT+5',
					'+5.5'   => 'IND - GMT+5.5',
					'+6'     => 'OMSK / BD - GMT+6',
					'+7'     => 'CXT - GMT+7',
					'+8'     => 'CST / AWST / WST - GMT+8',
					'+9'     => 'JST - GMT+9',
					'+10'    => 'EAST - GMT+10',
					'+11'    => 'SAKT - GMT+11',
					'+12'    => 'IDLE  - GMT+12',
					'+13'    => 'NZDT  - GMT+13',
					'-1'     => 'WAT  - GMT-1',
					'-2'     => 'AT  - GMT-2',
					'-3'     => 'ART  - GMT-3',
					'-4'     => 'AST  - GMT-4',
					'-5'     => 'EST  - GMT-5',
					'-6'     => 'CST  - GMT-6',
					'-7'     => 'MST  - GMT-7',
					'-8'     => 'PST  - GMT-8',
					'-9'     => 'AKST  - GMT-9',
					'-10'    => 'HST  - GMT-10',
					'-11'    => 'NT  - GMT-11',
					'-12'    => 'IDLW  - GMT-12',
					'custom' => 'Custom GMT',
				],
				'default' => [ '+1' ],

			]
		);

		$this->add_control(
			'local_gmt_note',
			[ 
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Country name will not work dynamically on Local GMT. So in this case, you may deactivate Show Country Option.', 'bdthemes-element-pack' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => [ 
					'select_gmt' => 'local',
				]
			]
		);

		$this->add_control(
			'input_gmt',
			[ 
				'label'       => esc_html__( 'Custom GMT ', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'example: +6',
				'default'     => '+6',
				'condition'   => [ 
					'select_gmt' => 'custom',
				],
			]
		);

		$this->add_control(
			'time_hour',
			[ 
				'label'   => esc_html__( 'Time Format', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [ 
					'12h' => esc_html__( '12 Hours', 'bdthemes-element-pack' ),
					'24h' => esc_html__( '24 Hours', 'bdthemes-element-pack' ),
				],
				'default' => '12h',
			]
		);

		$this->add_control(
			'show_date',
			[ 
				'label'        => esc_html__( 'Show Date', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'bdthemes-element-pack' ),
				'label_off'    => esc_html__( 'Hide', 'bdthemes-element-pack' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'select_date_format',
			[ 
				'label'     => esc_html__( 'Date Format', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [ 
					'%m/%d/%y'  => 'mm/dd/yy',
					'%m/%d/%Y'  => 'mm/dd/yyyy',
					'%m-%d-%y'  => 'mm-dd-yy',
					'%m-%d-%Y'  => 'mm-dd-yyyy',
					'%m %d %y'  => 'mm dd yy',
					'%m %d %Y'  => 'mm dd yyyy',

					'%d/%m/%y'  => 'dd/mm/yy',
					'%d/%m/%Y'  => 'dd/mm/yyyy',
					'%d-%m-%Y'  => 'dd-mm-yyyy',
					'%d %m %Y'  => 'dd mm yyyy',

					'%d/%y'     => 'dd/yy',
					'%d-%y'     => 'dd-yy',
					'%d%y'      => 'dd yy',
					'%d/%Y'     => 'dd/yyyy',
					'%d-%Y'     => 'dd-yyyy',
					'%d %Y'     => 'dd yyyy',

					'%b %d, %y' => 'mm dd, yy',
					'%b %d, %Y' => 'mm dd, yyyy',

					'%d %b, %y' => 'dd mm yy',

					'%y %b %d'  => 'yy mm dd',
					'%Y %b %d'  => 'yyyy mm dd',

					'%d %b, %Y' => 'dd mm, yyyy',
					'%b-%d-%Y'  => 'mm-dd-yyyy',

					'%a, %d %b' => 'day-dd-m',

					'custom'    => 'Custom Format',
				],
				'default'   => '%d %b, %Y',
				'condition' => [ 
					'show_date' => 'yes',
				],
			]
		);

		$this->add_control(
			'input_date_format',
			[ 
				'label'       => esc_html__( 'Custom Date Format', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type date format here', 'bdthemes-element-pack' ),
				'default'     => '%a, %d %b',
				'condition'   => [ 
					'select_date_format' => 'custom',
				],
			]
		);

		$this->add_control(
			'show_country',
			[ 
				'label'        => esc_html__( 'Show Country', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'bdthemes-element-pack' ),
				'label_off'    => esc_html__( 'Hide', 'bdthemes-element-pack' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'input_country',
			[ 
				'label'       => esc_html__( 'Type Country name ', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example: Bangladesh', 'bdthemes-element-pack' ),
				'default'     => esc_html__( 'Bangladesh', 'bdthemes-element-pack' ),
				'condition'   => [ 
					'show_country' => 'yes',
				],

			]
		);

		$this->add_control(
			'timer_layout',
			[ 
				'label'      => esc_html__( 'Layout', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => [ 
					'top'    => [ 
						'title' => esc_html__( 'Top', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [ 
						'title' => esc_html__( 'Bottom', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'    => 'top',
				'toggle'     => false,
				'conditions' => [ 
					'relation' => 'or',
					'terms'    => [ 
						[ 
							'name'  => 'show_country',
							'value' => 'yes',
						],
						[ 
							'name'  => 'show_date',
							'value' => 'yes',
						],
						[ 
							'name'  => 'select_style',
							'value' => 'digital',
						]
					],
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[ 
				'label'     => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'left'   => [ 
						'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [ 
						'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .bdt-time-zone-timer' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'section_style_time',
			[ 
				'label' => esc_html__( 'Time', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'time_color',
			[ 
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .bdt-time-zone .bdt-time-zone-time' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'time_typography',
				'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-time',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_date',
			[ 
				'label'     => esc_html__( 'Date', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_date' => 'yes',
				],

			]
		);

		$this->add_control(
			'date_color',
			[ 
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .bdt-time-zone .bdt-time-zone-date' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'date_typography',
				'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-date',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_country',
			[ 
				'label'     => esc_html__( 'Country', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_country' => 'yes',
				],

			]
		);

		$this->add_control(
			'country_color',
			[ 
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .bdt-time-zone .bdt-time-zone-country' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'country_typography',
				'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-country',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['select_gmt'] == 'custom' ) {
			$select_gmt = $settings['input_gmt'];
		} else {
			$select_gmt = $settings['select_gmt'];
		}

		if ( $settings['show_country'] == 'yes' ) {
			$country = $settings['input_country'];
		} else {
			$country = 'emptyCountry';
		}

		if ( $settings['show_date'] == 'yes' ) {
			if ( $settings['select_date_format'] == 'custom' ) {
				$dateFormat = $settings['input_date_format'];
			} else {
				$dateFormat = $settings['select_date_format'];
			}
		} else {
			$dateFormat = 'emptyDate';
		}

		$this->add_render_attribute(
			[ 
				'bdt_time_zone_data' => [ 
					'data-settings' => [ 
						wp_json_encode(
							array_filter( [ 
								"id"         => 'bdt-time-zone-data-' . $this->get_id(),
								"style"      => $settings['select_style'],
								"gmt"        => $select_gmt,
								"timeHour"   => $settings['time_hour'],
								"country"    => $country,
								"dateFormat" => $dateFormat,
							] )
						),
					],
				],
			]
		);

		$this->add_render_attribute( 'bdt-time-zone', 'class', [ 
			'bdt-time-zone',
			'bdt-time-zone-style-' . $settings['select_style'],
			'bdt-time-zone-' . $settings['timer_layout'],
		] );

		?>

		<div <?php echo $this->get_render_attribute_string( 'bdt-time-zone' ); ?>>
			<?php if ( 'analog_1' !== $settings['select_style'] ) : ?>
				<div class="bdt-time-zone-timer  " id="bdt-time-zone-data-<?php echo $this->get_id(); ?>" <?php echo $this->get_render_attribute_string( 'bdt_time_zone_data' ); ?>>
				</div>
			<?php else : ?>
				<div class="bdt-clock-circle">
					<div class="bdt-clock-face">
						<div id="hour" class="bdt-clock-hour"></div>
						<div id="minute" class="bdt-clock-minute"></div>
						<div id="second" class="bdt-clock-second"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}
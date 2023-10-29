<?php

namespace ElementPack\Modules\RippleClickEffect;

use Elementor\Controls_Manager;
use ElementPack\Base\Element_Pack_Module_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function __construct() {
		parent::__construct();
		$this->add_actions();
	}

	public function get_name() {
		return 'bdt-ripple-click-effect';
	}

	public function register_section($element) {

		$element->start_controls_section(
			'ep_ripple_click_effect',
			[
				'label' => BDTEP_CP . esc_html__('Ripple Click Effect', 'bdthemes-element-pack') . BDTEP_NC,
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->end_controls_section();
	}

	public function register_controls($section, $args) {

		$section->add_control(
			'section_ripple_click_effect_on',
			[
				'label'        => esc_html__('Enable Ripple Click Effect', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'frontend_available' => true,
				'render_type'        => 'template',
			]
		);

		$section->add_control(
			'section_ripple_click_effect_selector',
			[
				'label'     => esc_html__('Ripple Click Effect For', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'widgets'    => 'Widgets',
					'buttons' => 'Widgets > Buttons',
					'images' => 'Widgets > Images',
					'both' => 'Widgets > Both',
				],
				'default'   => 'buttons',
				'frontend_available' => true,
				'render_type'        => 'template',
                'prefix_class'       => 'ep-ripple-click-effect-for-',
				'condition' => [
					'section_ripple_click_effect_on' => 'yes',
				],
			]
		);
	}	

	public function enqueue_scripts() {
        wp_enqueue_script('ep-ripple-click-effect-vendor', BDTEP_ASSETS_URL . 'vendor/js/paperRipple.jquery.min.js', [], '', true);
		wp_enqueue_script('ep-ripple-click-effect');
		wp_enqueue_style('ep-ripple-click-effect');
    }

	protected function add_actions() {

		add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
		add_action('elementor/element/section/ep_ripple_click_effect/before_section_end', [$this, 'register_controls'], 10, 2);


		add_action('elementor/element/container/section_layout/after_section_end', [$this, 'register_section']);
		add_action('elementor/element/container/ep_ripple_click_effect/before_section_end', [$this, 'register_controls'], 10, 2);

		// render scripts
        add_action('elementor/frontend/container/before_render', [$this, 'enqueue_scripts'], 10, 1);
		add_action('elementor/frontend/section/before_render', [$this, 'enqueue_scripts'], 10, 1);
        add_action('elementor/preview/enqueue_scripts', [$this, 'enqueue_scripts']);
	}
}

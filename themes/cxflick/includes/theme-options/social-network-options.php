<?php
global $prefix_theme_options;

// Create a section social network
CSF::createSection( $prefix_theme_options, array(
	'title'  => esc_html__( 'Mạng xã hội', 'cxflick' ),
	'icon'   => 'fab fa-hive',
	'fields' => array(
		array(
			'id'      => 'opt_social_network',
			'type'    => 'fieldset',
			'title'   => esc_html__( 'Mạng xã hội', 'cxflick' ),
			'fields'  => array(
                array(
					'id'      => 'facebook',
					'type'    => 'text',
					'title'   => esc_html__( 'Link Facebook', 'cxflick' ),
					'default' => '#'
				),

                array(
                    'id'      => 'instagrams',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Link Instagrams', 'cxflick' ),
                    'default' => '#'
                ),

                array(
                    'id'      => 'youtube',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Link Youtube', 'cxflick' ),
                    'default' => '#'
                ),
			),
		),
	)
) );

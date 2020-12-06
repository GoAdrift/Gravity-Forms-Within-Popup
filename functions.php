<?php

function gaws_form_pu($atts = [], $content = null, $tags = '')
{
	
add_filter( 'gform_confirmation_anchor', '__return_false' );
		// To use, input the following snippet instead of the Gravity Form snippet:
		// [gf_popup id="1" target="#button-vsl1a" title="true" description="true" ajax="true"]

    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	
    // override default attributes with user attributes
    $gfpu_atts = shortcode_atts([
		'id' 	=> 0,
		'target' 	=> null,
		'title' 	=> false,
		'description'	=> false,
		'ajax'	=>	false
	], $atts, $tag);
								 
		$form_id = esc_html__($gfpu_atts['id'], 'gf_popup');
		$target = esc_html__($gfpu_atts['target'], 'gf_popup');
		$title = esc_html__($gfpu_atts['title'], 'gf_popup');
		$description = esc_html__($gfpu_atts['description'], 'gf_popup');
		$ajax = esc_html__($gfpu_atts['ajax'], 'gf_popup');
	
	$content = '<div class="gf-popup" style="display: none;"><div id="gf_ga_close_div" style=""><a id="myLink" title="Close" href="#"><span class="dashicons dashicons-dismiss"></span></a></div>' .  do_shortcode( '[gravityform id="'.$form_id.'" title="'.$title.'" description="'.$description.'" ajax="'.$ajax.'"]
' ) . '</div><div id="end-element">&nbsp</div><div id="gaws_overlay" style="display: none;"></div>';

	?>
	<script>
		jQuery(document).ready(function($) {
			var target = "<?php echo $target; ?>";
			if( $('form').find('div.validation_error').length ){
				gf_ga_open_popup();
			}
			
			if( target !== null ){
				$(document).on('click focus', target, function(e){
					e.preventDefault();
					gf_ga_open_popup();
				});
				
				
			}
			
			$('#gaws_overlay').click(function(){
				gf_ga_close_popup( this );
				return false; 
			});
			
			$('#gf_ga_close_div #myLink').click(function(){
				gf_ga_close_popup(); 
				return false; 
			});
			
			function gf_ga_close_popup(){
				$( '.gf-popup' ).fadeOut( "fast" );
				$( '#gaws_overlay' ).fadeOut( "slow" );
			}
			
			function gf_ga_open_popup(){
				$( '.gf-popup' ).fadeIn( "fast" );
				$( '#gaws_overlay' ).fadeIn( "slow" );
			}


			
 		});
	</script>
	<style>
		.gf-popup{
		background: #FFFFFF !important;
			display:none;
			position: fixed; 
			z-index: 9999;
			overflow: auto;
			max-height: 90%;
		}
		
		.gaws_indexes{
			z-index: 0 !important;
		}
		
		#gaws_overlay{
			position: fixed;
			background-color: rgba(0, 0, 0, .5);
			top:0;
			left:0;
			width: 100vw;
			height: 100vw;
			z-index: 2;
		}

		#gf_ga_close_div{
			position: fixed; 
			right: 20px; 
			top: 20px;
		}

		@media screen and (min-width: 800px){
				.gf-popup{
				padding: 50px;
				left: 50%; 
				top: 50%;
				transform: translate(-50%, -50%);		
				}
			}
			
		@media screen and (max-width: 799px){
				.gf-popup{
				padding: 15px;
				left: 25%;
				top: 50%;
				right: -10%;
				transform: translate(-20%, -50%);
				}
				
				.gf-popup-mobile{
					transform: translate(-50%, -50%) !important;
				}

			}
	</style>
	<?php
 
    // always return
    return $content;
}
add_shortcode('gf_popup', 'gaws_form_pu');

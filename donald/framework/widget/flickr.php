<?php 



class donald_Flickr_Widget extends WP_Widget {



	function donald_Flickr_Widget() {



		//Constructor



		parent::__construct(false, $name = 'Donald Flickr', array(

			'classname' => 'widget_flickr',

			'description' => esc_html__('Displays your latest Flickr feed.', 'donald')



		));



	}



	function widget($args, $instance) {



		// outputs the content of the widget



		extract($args); // Make before_widget, etc available.







		$fli_name = empty($instance['title']) ? esc_html__('Flickr', 'donald') : apply_filters('widget_title', $instance['title']);



		$fli_type = $instance['type'];



		$fli_id = $instance['id'];



		$fli_number = $instance['number'];



		$unique_id = $args['widget_id'];







		echo htmlspecialchars_decode($before_widget);



		echo htmlspecialchars_decode($before_title) . $fli_name . htmlspecialchars_decode($after_title); ?>



		<div class="footer-wrap-3">



			<?php if($fli_type == 'user'): ?>

			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_attr($fli_number); ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo esc_attr($fli_id); ?>"></script>	

			<?php else: ?>

			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_attr($fli_number); ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=group&amp;group=<?php echo esc_attr($fli_id); ?>"></script>

			<?php endif; ?>



		</div>	



		<?php echo htmlspecialchars_decode($after_widget); ?>



	<?php }











	function update($new_instance, $old_instance) {



		//update and save the widget



		return $new_instance;



	}



	



	function form($instance) {



		// Get the options into variables, escaping html characters on the way



		$fli_name = isset( $instance['title'] ) ? $instance['title'] : 'Flickr Photos';



		$fli_type = isset( $instance['type']) ? $instance['type'] : '';



		$fli_id = isset( $instance['id']) ? $instance['id'] : '71865026@N00';



		$fli_number = isset( $instance['number']) ? $instance['number'] : 9;



		?>







			<p>



				<label for="<?php echo htmlspecialchars_decode($this->get_field_id('title')); ?>"><?php  esc_html_e('Flickr Name','donald'); ?>:



				<input id="<?php echo htmlspecialchars_decode($this->get_field_id('title')); ?>" name="<?php echo htmlspecialchars_decode($this->get_field_name('title')); ?>" type="text" class="widefat" value="<?php echo esc_attr($fli_name); ?>" /></label>



			</p>







			<p>



				<label for="<?php echo htmlspecialchars_decode($this->get_field_id('type')); ?>"><?php esc_html_e('Flickr Type:', 'donald'); ?></label>



				<select id="<?php echo htmlspecialchars_decode($this->get_field_id('type')); ?>" name="<?php echo htmlspecialchars_decode($this->get_field_name('type')); ?>">



					<option<?php if($fli_type == 'user') { echo " selected='selected'"; } ?> name="<?php echo htmlspecialchars_decode($this->get_field_name('type')); ?>" value="user"><?php esc_html_e('user', 'donald'); ?></option>



					<option<?php if($fli_type == 'group') { echo " selected='selected'"; } ?> name="<?php echo htmlspecialchars_decode($this->get_field_name('type')); ?>" value="group"><?php esc_html_e('group', 'donald'); ?></option>



				</select>



			</p>











			<p>



				<label for="<?php echo htmlspecialchars_decode($this->get_field_id('id')); ?>"><?php  esc_html_e('Flickr ID','donald'); ?>(<a target="_blank" href="http://www.idgettr.com">idGettr</a> ex: 71865026@N00):



				<input id="<?php echo htmlspecialchars_decode($this->get_field_id('id')); ?>" name="<?php echo htmlspecialchars_decode($this->get_field_name('id')); ?>" type="text" class="widefat" value="<?php echo esc_attr($fli_id); ?>" /></label>



			</p>











			<p>



				<label for="<?php echo htmlspecialchars_decode($this->get_field_id('number')); ?>"><?php esc_html_e('Number of photos:','donald'); ?>



				<input id="<?php echo htmlspecialchars_decode($this->get_field_id('number')); ?>" name="<?php echo htmlspecialchars_decode($this->get_field_name('number')); ?>" type="number" min="1" max="20" class="widefat" value="<?php echo esc_attr($fli_number); ?>" /></label>



			</p>







		<?php



	}



}



register_widget('donald_Flickr_Widget');
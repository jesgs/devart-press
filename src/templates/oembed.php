<?php
/**
 * @var array $deviation
 */
?>

<div class="media">
	<img class="media-object" src="<?php echo esc_url( $deviation['url'] ); ?> " width="<?php echo intval( $deviation['thumbnail_width'] ); ?>" height="<?php echo intval( $deviation['thumbnail_height'] ); ?>" />
	<div class="media-body">
		<strong class="media-title"><?php echo esc_html( $deviation['title'] );?> </strong>
		<div class="media-caption">&copy; <?php echo esc_html( $deviation['author_name'] ) ?>
		<a href="<?php echo esc_url( $deviation['author_url'] ); ?>">View on DeviantArt</a>
		</div>
	</div>
</div>
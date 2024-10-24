<?php

// Extract the block attributes
$imageDetails = isset($attributes['imageDetails']) ? $attributes['imageDetails'] : array();
$blockTitle = isset($attributes['blockTitle']) ? $attributes['blockTitle'] : '';

$blockCta = isset($attributes['furtherInfoLink']) ? $attributes['furtherInfoLink'] : '';
$blockCtaText = isset($attributes['ctaTitle']) ? $attributes['ctaTitle'] : '';

// Get the block wrapper attributes
$wrapper_attributes = get_block_wrapper_attributes();

// Extract the class names
preg_match('/class="([^"]+)"/', $wrapper_attributes, $matches);
$classes = isset($matches[1]) ? $matches[1] : '';
if (! empty($imageDetails)) {
?>
  <section class="<?php echo $classes; ?>">
    <div class="image-carousel-block wp-block-group">

      <!-- Wrapper for arrows and progress bar -->
      <div class="carousel-header">
        <p><?php echo $blockTitle; ?></p>

        <div class="carousel-controls">
          <!-- Progress Bar -->
          <div class="carousel-progress-bar">
            <div class="progress-bar-inner"></div>
          </div>

          <!-- Left Arrow -->
          <button class="carousel-arrow carousel-arrow-left">
            <svg width="67" height="11" viewBox="0 0 67 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="Group 2">
                <path id="Polygon 1" d="M66.9832 5.5L59.4957 9.83013L59.4957 1.16987L66.9832 5.5Z" fill="#C9C8C8" />
                <rect id="Rectangle 2" y="5" width="60" height="1" fill="#C9C8C8" />
              </g>
            </svg>
          </button>

          <!-- Right Arrow -->
          <button class="carousel-arrow carousel-arrow-right">
            <svg width="67" height="11" viewBox="0 0 67 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="Group 2">
                <path id="Polygon 1" d="M66.9832 5.5L59.4957 9.83013L59.4957 1.16987L66.9832 5.5Z" fill="#C9C8C8" />
                <rect id="Rectangle 2" y="5" width="60" height="1" fill="#C9C8C8" />
              </g>
            </svg>
          </button>
        </div>
      </div>

      <div class="image-carousel-slider">
        <?php foreach ($imageDetails as $index => $card) : ?>
          <div class="image-carousel-card">
            <div class="image-carousel-card-inner">
              <?php if (isset($card['mediaURL']) && ! empty($card['mediaURL'])) : ?>
                <img src="<?php echo esc_url($card['mediaURL']); ?>" alt="<?php echo esc_attr($card['cardTitle']); ?>" />
              <?php else : ?>
                <img src="https://via.placeholder.com/300" alt="Placeholder" />
              <?php endif; ?>
            </div>

            <div class="image-carousel-content">
              <?php if (isset($card['cardTitle']) && ! empty($card['cardTitle'])) : ?>
                <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
                  <div class="wp-block-button is-style-outline shorter is-style-outline--8ad42b7db9bb282d48baa009ed5df338">
                    <a href="<?php echo esc_url($card['pageLink']); ?>" class="wp-block-button__link wp-element-button">
                      <?php echo esc_html($card['cardTitle']); ?>
                    </a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="blockCTA">
        <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
          <div class="wp-block-button is-style-outline shorter is-style-outline--8ad42b7db9bb282d48baa009ed5df338">

            <a href="<?php echo $blockCta; ?>" class="wp-block-button__link wp-element-button">
              <?php echo $blockCtaText; ?>
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      var $slider = $('.image-carousel-slider').slick({
        infinite: false,
        arrows: false, // Disable Slick's default arrows
        slidesToShow: 4.5,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 3.5,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2.5,
              slidesToScroll: 1
            }
          }
        ]
      });

      // Calculate the progress and update the progress bar
      function updateProgressBar(currentSlide, totalSlides) {
        var progress = (currentSlide + 1) / totalSlides * 100;
        $('.carousel-progress-bar .progress-bar-inner').css('width', Math.min(progress, 100) + '%');
      }

      // Get total slides and adjust for fractional slides
      var totalSlides = Math.ceil($slider.slick('getSlick').slideCount / 1.75);

      // Initialize progress bar on first load
      updateProgressBar(0, totalSlides);

      // Update the progress bar on slide change
      $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        updateProgressBar(nextSlide, totalSlides);
      });

      // Custom navigation for arrows
      $('.carousel-arrow-left').on('click', function() {
        $slider.slick('slickPrev');
      });

      $('.carousel-arrow-right').on('click', function() {
        $slider.slick('slickNext');
      });
    });
  </script>
<?php
} else {
  echo '<p>' . esc_html__('No cards added.', 'image-carousel') . '</p>';
}

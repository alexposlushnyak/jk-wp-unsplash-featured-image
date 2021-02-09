<?php defined('ABSPATH') || exit;

$path = __DIR__;

class jk_wp_unsplash_featured_image
{

    public function panel_render()
    {

        $post_id = $_POST['post_id'];

        ?>

        <div class="components-panel__body unsplash-featured-image-panel">

            <h2 class="components-panel__body-title">

                <button type="button" aria-expanded="false" class="components-button components-panel__body-toggle">

                    <span aria-hidden="true">

                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             class="components-panel__arrow" role="img" aria-hidden="true" focusable="false">

                            <path d="M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"></path>

                        </svg>

                    </span>

                    <?php echo esc_html('Unsplash Featured Image'); ?>

                </button>

            </h2>

            <div class="unsplash-modal-button-wrapper">

                <div class="unsplash-image-placeholder"
                    <?php if (has_post_thumbnail($post_id)): ?>
                        style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url($post_id)); ?>)"<?php endif; ?>>

                </div>

                <button class="unsplash-modal-button">

                    <?php echo esc_html('Find Image'); ?>

                    <i class="fab fa-unsplash"></i>

                </button>

            </div>

        </div>

        <?php

        die();

    }

}

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

    public function modal_render()
    {

        ?>

        <div class="unsplash-images-modal hide-modal">

            <div class="modal-window">

                <div class="close-window-button">

                    <i class="fa fa-times"></i>

                </div>

                <div class="inner-wrapper">

                    <div class="search-form-wrapper">

                        <div class="unsplash-icon-logo">

                            <i class="fab fa-unsplash"></i>

                        </div>

                        <div class="search-form">

                            <input type="text" class="search-field"
                                   placeholder="<?php echo esc_html('Enter some keywords and press Enter...'); ?>"
                                   value="">

                        </div>

                    </div>

                    <div class="search-body-wrapper">

                        <div class="isotope-grid-wrapper">

                            <div class="isotope-grid">

                            </div>

                        </div>

                        <div class="image-modal-wrapper hide">

                            <div class="image-modal">

                                <div class="button-wrapper">

                                    <button class="jk-button set-button">

                                        <?php echo esc_html('Set as Featured'); ?>

                                        <i class="fab fa-unsplash"></i>

                                    </button>

                                </div>

                                <div class="image-inner">

                                </div>

                                <div class="close-image-window-button">

                                    <i class="fa fa-times"></i>

                                </div>

                            </div>

                            <div class="after-set-box hide">

                                <i class="fa fa-spinner"></i>

                            </div>

                        </div>

                        <div class="loading-message-wrapper hide">

                            <span class="loading-message">

                        <i class="fab fa-unsplash"></i>

                        <?php echo esc_html('Loading Images...'); ?>

                    </span>

                        </div>

                    </div>

                    <div class="modal-footer-wrapper">

                        <div class="footer-inner hide">

                            <button class="load-more-button">

                                <span class="text-part">

                                    <?php echo esc_html('Load More'); ?>

                                    <i class="fa fa-angle-down"></i>

                                </span>

                                <span class="loading-part hide">

                                    <i class="fas fa-spinner"></i>

                                </span>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php

        die();

    }

    public function search_render()
    {

        $query = urlencode($_POST['query']);

        $page = $_POST['page'];

        $response = JK_Unsplash_API_Handler::make_request_to_api(array(
            'token' => '5d139fKDQXGz8Rlj-ZRTyaDUf2zhL-4Z1zaI11vPGOE',
            'secret' => 'YhqdWDaG5ZwTSKI4ibSZHYWiVor4M-IeSHqgZ4AOo1s',
            'page' => $page,
            'per_page' => '50',
            'order_by' => 'popular',
            'query' => $query
        ));

        $items = $response->results;

        foreach ($items as $item):

            self::item_render($item);

        endforeach;

        die();

    }

    public static function item_render($item)
    {

        if (!empty($item)):

            $id = $item->id;

            $created_at = $item->created_at;

            $updated_at = $item->updated_at;

            $w = $item->width;

            $h = $item->height;

            $avarage_color = $item->color;

            $description = $item->description;

            $alt_description = $item->alt_description;

            $urls = $item->urls;

            $links = $item->links;

            $likes = $item->likes;

            $user_name = $item->user->name;

            $user_link = $item->user->links->html;

            $user_avatar = $item->user->profile_image->medium;

            $app_name = 'JK-Studio';

            $app_name = urlencode($app_name);

            ?>

            <div class="grid-item">

                <div class="grid-item-inner-wrapper"
                     data-item-download="<?php echo esc_html($links->download); ?>"
                     data-item-image="<?php echo esc_html($urls->regular); ?>"
                     data-item-name="<?php echo esc_html($id); ?>">

                    <span class="plus-icon">

                        <i class="fas fa-plus"></i>

                    </span>

                    <div class="author-wrapper">

                        <a class="author-avatar" href="<?php echo esc_url($user_link); ?>">

                            <img src="<?php echo esc_url($user_avatar); ?>" alt="<?php echo esc_attr($user_name); ?>">

                        </a>

                        <span class="author-name">

                            <?php echo esc_html('Photo by'); ?>

                            <a href="<?php echo esc_url($user_link); ?>">

                                <?php echo esc_html($user_name); ?>

                            </a>

                            <?php echo esc_html('on'); ?>

                            <a href="<?php echo esc_url('https://unsplash.com/?utm_source=' . $app_name . '&utm_medium=referral'); ?>">

                                <?php echo esc_html('Unsplash') ?>

                            </a>

                        </span>

                    </div>

                    <img src="<?php echo esc_url($urls->regular); ?>" alt="<?php echo esc_attr($alt_description); ?>">

                </div>

            </div>

        <?php

        endif;

    }

}

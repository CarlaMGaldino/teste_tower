<?php
/**
 *
 * @package SiteTesteTower
 */

$title_maps     = get_sub_field('title_maps');
$subtitle_maps  = get_sub_field('subtitle_maps');
$address_maps   = get_sub_field('address_maps');
$iframe_maps    = get_sub_field('iframe_maps');
?>
<section class="maps-decorated">
    <div class="container">
        <div class="maps-decorated__content">
            <div class="maps-decorated__content-text">
                <?php if ($title_maps || $subtitle_maps) : ?>
                    <div class="maps-decorated__content-title">
                        <?php if ($title_maps) : ?>
                            <h2><?php echo esc_html($title_maps); ?></h2>
                        <?php endif; ?>
                        <?php if ($subtitle_maps) : ?>
                            <p><?php echo esc_html($subtitle_maps); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ($address_maps) : ?>
                    <div class="maps-decorated__content-address">
                        <div class="maps-decorated__content-icon">
                            <i class="icon-arrow-green"></i>
                        </div>
                        <address><?php echo wp_kses_post($address_maps); ?></address>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($iframe_maps) : ?>
                <div class="maps-decorated__content-iframe">
                    <?php
                    echo wp_kses(
                        $iframe_maps,
                        array(
                            'iframe' => array(
                                'src'             => true,
                                'width'           => true,
                                'height'          => true,
                                'style'           => true,
                                'frameborder'     => true,
                                'allow'           => true,
                                'allowfullscreen' => true,
                                'loading'         => true,
                                'referrerpolicy'  => true,
                            ),
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

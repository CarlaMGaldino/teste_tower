<?php
$imagem_de_fundo = get_sub_field('imagem_de_fundo');
$imagem_principal = get_sub_field('imagem_principal');
$titulo_sobre_imagem = get_sub_field('titulo_sobre_imagem');
$tipos_de_apartamento = get_sub_field('tipos_de_apartamento');
$metragens = get_sub_field('metragens');
$endereco = get_sub_field('endereco');
$cta = get_sub_field('cta');

if (!$imagem_de_fundo || !$imagem_principal) {
  return;
}
?>

<section class="hero-banner" style="background-image: url('<?php echo esc_url($imagem_de_fundo['url']); ?>');">
  <div class="hero-banner__overlay"></div>
  <div class="container">
    <div class="hero-banner__content">
      <div class="hero-banner__left">
        <!-- Conteúdo da esquerda: Logo, tipos, endereço, CTA -->
        <div class="hero-banner__logo">
          <?php the_custom_logo(); ?>
        </div>

        <?php if ($tipos_de_apartamento) : ?>
          <ul class="hero-banner__types">
            <?php foreach ($tipos_de_apartamento as $tipo) : ?>
              <li><?php echo esc_html($tipo['tipo']); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <div class="hero-banner__details">
          <div class="hero-banner__area">
            <span><?php echo esc_html($metragens); ?></span>
          </div>
        </div>

        <div class="hero-banner__address">
          <p><?php echo esc_html($endereco); ?></p>
        </div>

        <?php if ($cta) : ?>
          <a href="<?php echo esc_url($cta['url']); ?>" target="<?php echo esc_attr($cta['target']); ?>" class="btn btn--primary">
            <?php echo esc_html($cta['title']); ?>
          </a>
        <?php endif; ?>

      </div>
      <div class="hero-banner__right">
        <!-- Conteúdo da direita: Imagem e título sobreposto -->
        <div class="hero-banner__image-wrapper">
          <img src="<?php echo esc_url($imagem_principal['url']); ?>" alt="<?php echo esc_attr($imagem_principal['alt']); ?>">
          <?php if ($titulo_sobre_imagem) : ?>
            <h1 class="hero-banner__title"><?php echo nl2br(esc_html($titulo_sobre_imagem)); ?></h1>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
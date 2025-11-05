<?php
/**
 *
 * @package SiteTesteTower
 */

$form_title = get_sub_field( 'form_title' );
$form_bg_image = get_sub_field( 'form_bg_image' );
?>

<section class="opportunity-section">

    <div class="container">
        <div class="opportunity-wrapper">
            <div class="opportunity-image">
                <img src="<?php echo esc_url( $form_bg_image ); ?>" alt="Building">
                <div class="image-overlay">
                    <h2><?php echo esc_html( $form_title ); ?></h2>
                    <span class="arrow">➜</span>
                </div>
            </div>

            <div class="opportunity-form">
                <form action="#" method="post">
                    <div class="form-field">
                        <input type="text" name="name" placeholder="NOME" required>
                    </div>
                    <div class="form-field">
                        <input type="tel" name="phone" placeholder="CELULAR" required>
                    </div>
                    <div class="form-field">
                        <input type="email" name="email" placeholder="E-MAIL" required>
                    </div>
                    <div class="form-field">
                        <select name="purpose" required>
                            <option value="">Você está procurando imóveis para:</option>
                            <option value="live">Morar</option>
                            <option value="invest">Investir</option>
                        </select>
                    </div>

                    <div class="checkbox-field">
                        <label>
                            <input type="checkbox" required>
                            Declaro que li e concordo com a Política de Privacidade e autorizo o tratamento dos meus dados para o fim especificado.
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">
                        CADASTRAR <span>↗</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

</section>
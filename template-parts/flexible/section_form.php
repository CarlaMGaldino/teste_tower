<?php
/**
 *
 * @package SiteTesteTower
 */

?>

<section class="opportunity-section">
  <div class="opportunity-wrapper">
    <div class="opportunity-image">
      <img src="img/opportunity.jpg" alt="Building">
      <div class="image-overlay">
        <h2>LEARN MORE ABOUT<br>THIS OPPORTUNITY.</h2>
        <span class="arrow">➜</span>
      </div>
    </div>

    <div class="opportunity-form">
      <form action="#" method="post">
        <div class="form-field">
          <input type="text" name="name" placeholder="NAME" required>
        </div>
        <div class="form-field">
          <input type="tel" name="phone" placeholder="PHONE" required>
        </div>
        <div class="form-field">
          <input type="email" name="email" placeholder="E-MAIL" required>
        </div>
        <div class="form-field">
          <select name="purpose" required>
            <option value="">LOOKING FOR PROPERTIES TO:</option>
            <option value="live">Live</option>
            <option value="invest">Invest</option>
          </select>
        </div>

        <div class="checkbox-field">
          <label>
            <input type="checkbox" required>
            I declare that I have read and agree with the Privacy Policy and authorize the processing of my data for the specified purpose.
          </label>
        </div>

        <button type="submit" class="btn-submit">
          SUBMIT <span>↗</span>
        </button>
      </form>
    </div>
  </div>
</section>

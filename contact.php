<?php
include 'includes/db.php';
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | FROSTO</title>
    <link rel="stylesheet" href="css/style.css">

      <section class="page-section">
    <h2>Contact Us</h2>
    <form class="contact-form">
      <input type="text" placeholder="Your Name" required />
      <input type="email" placeholder="Your Email" required />
      <textarea rows="5" placeholder="Your Message" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </section>

  <section class="store-location">
  <h2>Our Store Location</h2>
  <p>Visit us at our physical store for in-person shopping!</p>

  <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.575840369662!2d80.03899797475609!3d6.821329093176446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2523b05555555%3A0x546c34cd99f6f488!2sNSBM%20Green%20University!5e0!3m2!1sen!2slk!4v1752944764335!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</section>

  <footer>
    <div class="footer-logos">
      <a href=""><img src="images/ig.png" alt="Instagram"></a>
      <a href=""><img src="images/fb.png" alt="Facebook"></a>
      <a href=""><img src="images/wa.png" alt="Whatsapp"></a>
    </div>
    <p>&copy; 2025 FROSTO | All Rights Reserved</p>
  </footer>
  <script src="dark.js"></script>

</body>
</html>
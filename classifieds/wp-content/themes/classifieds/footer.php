<?php

/* 
 * Author       : Jai K
 * Purpose      : Main Footer file
 * Created On   : 2020-02-10 19:33
 */
?>
      
      <footer>
          <div class="container">
            <div class="row text-center">
                <div id="bottom-nav" class="col-md-12">
                    <a href="<?php echo SITE_URL(); ?>/contact-us" class="pip"><span>Contact Us</span></a>
                  <a href="<?php echo SITE_URL(); ?>/about-us" class="pip"><span>About Us</span></a>
                  <a href="<?php echo SITE_URL(); ?>/privacy-statement" class="pip"><span>Privacy Statement</span></a>
                  <a href="<?php echo SITE_URL(); ?>/terms-and-conditions" class="pip"><span>Terms and Conditions</span></a>
                  <a href="<?php echo SITE_URL(); ?>/cookies-policy"><span>Cookies Policy</span></a>
                </div>
            </div>
            <div class="row text-center">
                <div id="copyright-row" class="col-md-12">
                    <a href="http://hyproid.com" target="_blank"  class="pip"><span>www.hyproid.com</span></a>
                    <span>&copy; <?php echo date("Y"); ?> - All rights are reserved</span>
                </div>

            </div>
            <input type="file" id="file-dialog-opener" style="display: none;" />
            <i id="scroll-up-btn" class="fa fa-chevron-circle-up"></i>
            <div class="dim-cover"></div>
          </div>
      </footer>

    </div> <!-- #page -->
  </body>
  <script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/jquery-3.4.0.min.js"></script>
  <script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/fontawesome-all.min.js"></script>
  <script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/script.js"></script>
  <script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/menu.js"></script>
  <script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/app.js"></script>
  <!--<script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/graph.js"></script>-->
</html>


<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title>Pangkalan Data P2E LIPI</title>

        <!-- Included CSS Files (Compressed) -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/jquery.ui.all.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/foundation4/css/foundation.min.css"/>
        <!--<link rel="stylesheet" href="<?php echo base_url() ?>assets/foundation4/css/app.css" />-->

        <!-- Included JS Files (Compressed) -->
        <!--  <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.js"></script> -->
        <script src="<?php echo base_url() ?>assets/jquery-ui/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url() ?>assets/jquery-ui/ui/jquery-ui.js"></script>

        <!-- Initialize JS Plugins -->
        <script src="<?php echo base_url(); ?>assets/foundation4/js/foundation.min.js"></script>

        <!--<script src="<?php echo base_url(); ?>assets/foundation4/js/modernizr.foundation.js"></script>-->
        <!--<script src="<?php echo base_url(); ?>assets/foundation4/js/foundation.forms.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>


        <!-- IE Fix for HTML5 Tags -->
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="row">
            <div class="twelve columns">
                <h2>Pangkalan Data</h2>
                <!--<p>This is Beta Version<strong>1.0.1</strong> generated on Dec 15, 2012.</p>-->
                <hr />
            </div>
        </div>

        <div class="row">
            <div class="eight columns">
                <!-- Grid Example -->
                <div class="row">
                    <div class="twelve columns">
                        <div class="panel">
                            <?php $this->load->view($tpl); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="four columns">
                <h4>Main Menu</h4>
                <ul class="disc">
                    <li><a href="<?php // echo site_url('vw_member/vw_member/profile'); ?>">Profile</li>
                    <?php
                    /**
                     * tutup dulu
                     */
                    /*
                    $level = $this->session->userdata('levelid');
                    if ($level == 1 OR $level == 2) {
                        ?>
                        <li><a href="<?php // echo site_url('club/club'); ?>">Club</li>
                        <?php
                    }
                    if ($level == 1 OR $level == 2) {
                        ?>
                        <li><a href="<?php // echo site_url('vw_member/vw_member'); ?>">Member</li>
                        <?php
                    }
                    if ($level == 1) {
                        ?>
                        <li><a href="<?php // echo site_url('mobile/mobile'); ?>">Mobil</li>
                        <?php
                    }
                    if ($level == 1) {
                        ?>
                        <li><a href="">SIM</li>
                        <?php
                    }
                     * 
                     */
                    ?>
                    <li><a href="<?php echo site_url('login/logout'); ?>">Logout</li>
                </ul>
            </div>
        </div>


        <!-- 
        <div class="row">
          <div class="six columns">
            <div class="panel">
              <p>Six columns</p>
            </div>
          </div>
          <div class="six columns">
            <div class="panel">
              <p>Six columns</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="four columns">
            <div class="panel">
              <p>Four columns</p>
            </div>
          </div>
          <div class="four columns">
            <div class="panel">
              <p>Four columns</p>
            </div>
          </div>
          <div class="four columns">
            <div class="panel">
              <p>Four columns</p>
            </div>
          </div>
        </div>
        -->
        <!-- 
        <h3>Tabs</h3>
        <dl class="tabs">
          <dd class="active"><a href="#simple1">Simple Tab 1</a></dd>
          <dd><a href="#simple2">Simple Tab 2</a></dd>
          <dd><a href="#simple3">Simple Tab 3</a></dd>
        </dl>
  
        <ul class="tabs-content">
          <li class="active" id="simple1Tab">This is simple tab 1's content. Pretty neat, huh?</li>
          <li id="simple2Tab">This is simple tab 2's content. Now you see it!</li>
          <li id="simple3Tab">This is simple tab 3's content. It's, you know...okay.</li>
        </ul>
          <h3>Buttons</h3>
  
        <div class="row">
          <div class="six columns">
            <p><a href="#" class="small button">Small Button</a></p>
            <p><a href="#" class="button">Medium Button</a></p>
            <p><a href="#" class="large button">Large Button</a></p>
          </div>
          <div class="six columns">
            <p><a href="#" class="small alert button">Small Alert Button</a></p>
            <p><a href="#" class="success button">Medium Success Button</a></p>
            <p><a href="#" class="large secondary button">Large Secondary Button</a></p>
          </div>
        </div>
        
      </div>
  
      
        -->
        <!--  
        <div class="row">
          <div class="twelve columns">
            <h3>Orbit</h3>
            <div id="featured">
              <img src="http://placehold.it/1200x250&text=Slide_1" alt="slide image">
              <img src="http://placehold.it/1200x250&text=Slide_2" alt="slide image">
              <img src="http://placehold.it/1200x250&text=Slide_3" alt="slide image">
            </div>
          </div>
        </div>
      
        <div class="row">
          <div class="twelve columns">
            <h3>Reveal</h3>
            <p><a href="#" data-reveal-id="exampleModal" class="button">Example modal</a></p>
          </div>
        </div>
        
        <div id="exampleModal" class="reveal-modal">
          <h2>This is a modal.</h2>
          <p>
            Reveal makes these very easy to summon and dismiss. The close button is simple an anchor with a unicode 
            character icon and a class of <code>close-reveal-modal</code>. Clicking anywhere outside the modal will 
            also dismiss it.
          </p>
          <a class="close-reveal-modal">�</a>
        </div>
        -->

        <!-- Included JS Files (Uncompressed) -->
        <!--  
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.mediaQueryToggle.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.forms.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.reveal.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.orbit.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.navigation.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.buttons.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.tabs.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.tooltips.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.accordion.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.placeholder.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.alerts.js"></script>
        <script src="<?php echo base_url() ?>assets/foundation/javascripts/jquery.foundation.topbar.js"></script>
        -->


    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

  <main class="d-flex align-items-center">
    <div class="container">
        <div id="wizard">
          <h3><?php echo esc_html__( 'Manage Endpoints' ,'customize-my-account-for-woocommerce'); ?></h3>
          <section>
          	<h5 class="bd-wizard-step-title"><?php echo esc_html__( 'Manage Endpoints' ,'customize-my-account-for-woocommerce'); ?></h5>

          	<div class="row">

          		

          		<div class="col-md-6">
          			<p class="mb-4 dashlinks_p"><span id="enteredFirstName"><?php echo esc_html__( 'Hide/show core endpoints , Rename/Reorder them easily, Add icons to endpoints and many more features.' ,'customize-my-account-for-woocommerce'); ?></span></p>

          			<a target="_blank" href="<?php echo wcmamtx_redirect_URL; ?>" type="button" class="btn btn-warning wcmactx_wizard_action_button"><?php echo esc_html__( 'Manage Endpoints' ,'customize-my-account-for-woocommerce'); ?></a>
          		</div>

          		<div class="col-md-6">
          			<img src="<?php  echo wcmamtx_PLUGIN_URL; ?>assets/images/endpoints.png" alt="branding" class="label-icon-default-links">
          		</div>




          		

          	</div>

          </section>
          <h3><?php echo esc_html__( 'My Account Navigation Widget' ,'customize-my-account-for-woocommerce'); ?></h3>
          <section>
          	<h5 class="bd-wizard-step-title"><?php echo esc_html__( 'Navigation Widget' ,'customize-my-account-for-woocommerce'); ?></h5>

          	<div class="row">

          		<div class="col-md-6">
          			<img src="<?php  echo wcmamtx_PLUGIN_URL; ?>assets/images/widget.png" alt="branding" class="label-icon-default-links">
          		</div>

          		<div class="col-md-6">
          			<p class="mb-4 dashlinks_p"><span id="enteredFirstName"><?php echo esc_html__( 'Your chosen Endpoints/links you can show on My Account menu widget, you can simply inject widget into your any menu location your theme supports.' ,'customize-my-account-for-woocommerce'); ?></span>
                  <?php echo esc_html__('Alternatively you can enable it from ','customize-my-account-for-woocommerce'); ?> <a target="_blank" href="nav-menus.php"><?php echo esc_html__('Appearance/Menu','customize-my-account-for-woocommerce'); ?></a>
                </p>

          			<a target="_blank" href="<?php echo wcmamtx_redirect_URL; ?>&tab=wcmamtx_plugin_options" type="button" class="btn btn-warning wcmactx_wizard_action_button"><?php echo esc_html__( 'Enable Menu widget' ,'customize-my-account-for-woocommerce'); ?></a>
          		</div>
                
                
          		

          	</div>

          </section>
          <h3><?php echo esc_html__( 'Dashboard Links' ,'customize-my-account-for-woocommerce'); ?></h3>
          <section>
          	<h5 class="bd-wizard-step-title"><?php echo esc_html__( 'Dashboard Links' ,'customize-my-account-for-woocommerce'); ?></h5>

          	<div class="row">

          		<div class="col-md-6">
          			<p class="mb-4 dashlinks_p"><span id="enteredFirstName"><?php echo esc_html__( 'Display your Endpounts as nicely looking links on dashboard page.If your theme already have this feature , keep this feature disabled' ,'customize-my-account-for-woocommerce'); ?></span></p>

          			 <a target="_blank" href="<?php echo wcmamtx_redirect_URL; ?>&tab=wcmamtx_plugin_options" type="button" class="btn btn-warning wcmactx_wizard_action_button"><?php echo esc_html__( 'Enable Dashboard links' ,'customize-my-account-for-woocommerce'); ?></a>
          		</div>

          		<div class="col-md-6">
          			<img src="<?php  echo wcmamtx_PLUGIN_URL; ?>assets/images/dashlinks.png" alt="branding" class="label-icon-default-links">
          		</div>

          		
               
          		

          	</div>

          </section>

          <h3><?php echo esc_html__( 'Default Endpoint' ,'customize-my-account-for-woocommerce'); ?></h3>
          <section>
          	<h5 class="bd-wizard-step-title"><?php echo esc_html__( 'Default Endpoint' ,'customize-my-account-for-woocommerce'); ?></h5>

          	<div class="row">

          		<div class="col-md-6">
          			<img src="<?php  echo wcmamtx_PLUGIN_URL; ?>assets/images/default_menu.png" alt="branding" class="label-icon-default-links">
          		</div>

          		<div class="col-md-6">
          			<p class="mb-4 dashlinks_p"><span id="enteredFirstName"><?php echo esc_html__( 'Display your Endpounts as nicely looking links on dashboard page.If your theme already have this feature , keep this feature disabled' ,'customize-my-account-for-woocommerce'); ?></span></p>

          			<a target="_blank" href="<?php echo wcmamtx_redirect_URL; ?>&tab=wcmamtx_plugin_options" type="button" class="btn btn-warning wcmactx_wizard_action_button"><?php echo esc_html__( 'Change default Endpoint' ,'customize-my-account-for-woocommerce'); ?></a>
          		</div>

          		

          	</div>

          </section>
        </div>
    </div>
  </main>
<?php wp_enqueue_script( 'wcmtx_steps_jquery', ''.wcmamtx_PLUGIN_URL.'assets/js/jquery-3.4.1.min.js',array(), '1.0.0', true ); ?>
</body>
</html>
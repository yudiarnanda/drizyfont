<?php 

// Single Font Tester Shortcode
function font_buying_options_shortcode() { 

	ob_start(); 

	?>

	<?php //if ($product->is_type( 'variable' )) : ?>
		<div class="buying-options-container">

			<div class="buying-option-head">
				<ul class="buying-options-tabs">
					<li><a href="#family"><?php _e( 'Family package', 'drizy' ); ?></a></li>
					<li><a href="#individual"><?php _e( 'Individual purchase', 'drizy' ); ?></a></li>
				</ul>
			</div>

			<div class="buying-options-tab-container">
				<!-- family -->
				<div id="family" class="tab-content">
					<div class="row">
						<div class="col-sm-6">
							<div class="font-family-style-lists">
								<div class="font-family-head">
									<div class="font-family-title">
										<?php _e( 'Gatermon - Family Package', 'drizy' ); ?>
									</div>
									<div class="font-family-count">
										<span><?php _e( '8 fonts', 'drizy' ); ?></span>
									</div>
									<div class="font-family-badge">
										<?php echo drizy_svg('star'); ?>
										<span><?php _e( 'Best Value', 'drizy' ); ?></span>
									</div>
								</div>
								<div class="font-family-style-wrapper"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="font-list-license">
								<div class="tab-content-vertical-family">
									<div class="license-wrapper">
										<div class="lisence-list-wrapper">
											<div class="lisence-list active">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Personal', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$12
												</div>
											</div>
											<div class="lisence-list-description default">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For <strong>non-commercial personal use:</strong></span>
														<ul>
															<li>installing on computers</li>
															<li>non-monetized social media</li>
															<li>non-monetized blogs</li>
															<li>non-monetized websites</li>
															<li>digital banners</li>
															<li>print</li>
															<li>portfolios</li>
															<li>merchandise</li>
															<li>etc.</li>
														</ul>
													</div>
													<div class="license-desc-lists-use">
														<div class="row">
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-user'); ?>
																	</div>
																	<div class="text">
																		<span>Users:</span>
																		<span>Maximum 1</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-project'); ?>
																	</div>
																	<div class="text">
																		<span>Personal Projects:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-computer'); ?>
																	</div>
																	<div class="text">
																		<span>Computer Installation:</span>
																		<span>5 Devices</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-social'); ?>
																	</div>
																	<div class="text">
																		<span>Social Media:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-website'); ?>
																	</div>
																	<div class="text">
																		<span>Websites:</span>
																		<span>5 web / blog</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-end-product'); ?>
																	</div>
																	<div class="text">
																		<span>End Product:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-non-comm'); ?>
																	</div>
																	<div class="text">
																		<span>Not for Commercial Use</span>
																		<span></span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-not-resale'); ?>
																	</div>
																	<div class="text">
																		<span>End Product Not For Resale</span>
																		<span></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Freelance', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$150
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For <strong>freelance professionals</strong> who handle small-scale commercial projects:</span>
														<ul>
															<li>webfonts</li>
															<li>logos</li>
															<li>packaging</li>
															<li>books</li>
															<li>ePubs</li>
															<li>websites</li>
															<li>digital ads</li>
															<li>social media ads</li>
															<li>monetized social media</li>
															<li>ect.</li>
														</ul>
													</div>
													<div class="license-desc-lists-use">
														<div class="row">
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-user'); ?>
																	</div>
																	<div class="text">
																		<span>Users:</span>
																		<span>Maximum 5</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-project'); ?>
																	</div>
																	<div class="text">
																		<span>Commercial Projects: </span>
																		<span>1</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-computer'); ?>
																	</div>
																	<div class="text">
																		<span>Computer Installation:</span>
																		<span>5 Devices</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-company'); ?>
																	</div>
																	<div class="text">
																		<span>Company Size:</span>
																		<span>Up to 50 Employees</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-end-product'); ?>
																	</div>
																	<div class="text">
																		<span>End Product:</span>
																		<span>500,000</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-not-resale'); ?>
																	</div>
																	<div class="text">
																		<span>End Product Not For Resale</span>
																		<span></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Commercial', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$500
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For <strong>commercial usage</strong> including freelance projects, professional work, and agencies serving medium-scale clients (SMEs) with purposes:</span>
														<ul>
															<li>webfonts</li>
															<li>logos</li>
															<li>packaging</li>
															<li>books</li>
															<li>ePubs</li>
															<li>websites</li>
															<li>digital ads</li>
															<li>social media ads</li>
															<li>video commercials</li>
															<li>monetized blogs</li>
															<li>monetized social media</li>
															<li>commercial printing</li>
															<li>merchandise</li>
															<li>ect.</li>
														</ul>
													</div>
													<div class="license-desc-lists-use">
														<div class="row">
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-user'); ?>
																	</div>
																	<div class="text">
																		<span>Users:</span>
																		<span>Maximum 10</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-project'); ?>
																	</div>
																	<div class="text">
																		<span>Commercial Projects: </span>
																		<span>1</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-computer'); ?>
																	</div>
																	<div class="text">
																		<span>Computer Installation:</span>
																		<span>10 Devices</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-trademark'); ?>
																	</div>
																	<div class="text">
																		<span>Logo / Trademark: </span>
																		<span>Yes</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-company'); ?>
																	</div>
																	<div class="text">
																		<span>Company Size:</span>
																		<span>Up to 150 Employees</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-end-product'); ?>
																	</div>
																	<div class="text">
																		<span>End Product:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-not-resale'); ?>
																	</div>
																	<div class="text">
																		<span>End Product Not For Resale</span>
																		<span></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Enterprise', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For use in <strong> large-scale projects:</strong></span>
														<ul>
															<li>public figures</li>
															<li>national</li>
															<li>multinational corporate companies</li>
															<li>servers</li>
															<li>applications</li>
															<li>games</li>
															<li>websites</li>
															<li>films</li>
															<li>editorials</li>
															<li>digital media</li>
															<li>print media</li>
															<li>broadcasting</li>
															<li>embedding</li>
															<li>modifications</li>
															<li>more.</li>
														</ul>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /family -->

				<!-- individual -->
				<div id="individual" class="tab-content">
					<div class="row">
						<div class="col-sm-6">
							<div class="font-list-style">
								<ul class="buying-options-tabs-vertical">
									<li>
										<a href="#thin">
											<div class="font-style">
												<div class="font-style-name-small">
													<?php _e( 'Thin', 'drizy' ); ?>
												</div>
												<div class="font-style-name">
													<?php _e( 'Gastermos Thin', 'drizy' ); ?>
												</div>
											</div>
											<span class="icon-check"></span>
										</a>
									</li>
									<li>
										<a href="#thin-italic">
											<div class="font-style">
												<div class="font-style-name-small">
													<?php _e( 'Thin Italic', 'drizy' ); ?>
												</div>
												<div class="font-style-name">
													<?php _e( 'Gastermos Thin Italic', 'drizy' ); ?>
												</div>
											</div>
											<span class="icon-check"></span>
										</a>
									</li>
									<li>
										<a href="#extra-thin-italic">
											<div class="font-style">
												<div class="font-style-name-small">
													<?php _e( 'Extra Thin Italic', 'drizy' ); ?>
												</div>
												<div class="font-style-name">
													<?php _e( 'Gastermos Extra Thin Italic', 'drizy' ); ?>
												</div>
											</div>		
											<span class="icon-check"></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="font-list-license">
								<div id="thin" class="tab-content-vertical">
									<div class="license-wrapper">
										<div class="lisence-list-wrapper">
											<div class="lisence-list active">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Personal', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$12
												</div>
											</div>
											<div class="lisence-list-description default">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For <strong>non-commercial personal use:</strong></span>
														<ul>
															<li>installing on computers</li>
															<li>non-monetized social media</li>
															<li>non-monetized blogs</li>
															<li>non-monetized websites</li>
															<li>digital banners</li>
															<li>print</li>
															<li>portfolios</li>
															<li>merchandise</li>
															<li>etc.</li>
														</ul>
													</div>
													<div class="license-desc-lists-use">
														<div class="row">
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-user'); ?>
																	</div>
																	<div class="text">
																		<span>Users:</span>
																		<span>Maximum 1</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-project'); ?>
																	</div>
																	<div class="text">
																		<span>Personal Projects:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-computer'); ?>
																	</div>
																	<div class="text">
																		<span>Computer Installation:</span>
																		<span>5 Devices</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-social'); ?>
																	</div>
																	<div class="text">
																		<span>Social Media:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-website'); ?>
																	</div>
																	<div class="text">
																		<span>Websites:</span>
																		<span>5 web / blog</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-end-product'); ?>
																	</div>
																	<div class="text">
																		<span>End Product:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-non-comm'); ?>
																	</div>
																	<div class="text">
																		<span>Not for Commercial Use</span>
																		<span></span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-not-resale'); ?>
																	</div>
																	<div class="text">
																		<span>End Product Not For Resale</span>
																		<span></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Freelance', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$150
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For <strong>freelance professionals</strong> who handle small-scale commercial projects:</span>
														<ul>
															<li>webfonts</li>
															<li>logos</li>
															<li>packaging</li>
															<li>books</li>
															<li>ePubs</li>
															<li>websites</li>
															<li>digital ads</li>
															<li>social media ads</li>
															<li>monetized social media</li>
															<li>ect.</li>
														</ul>
													</div>
													<div class="license-desc-lists-use">
														<div class="row">
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-user'); ?>
																	</div>
																	<div class="text">
																		<span>Users:</span>
																		<span>Maximum 5</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-project'); ?>
																	</div>
																	<div class="text">
																		<span>Commercial Projects: </span>
																		<span>1</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-computer'); ?>
																	</div>
																	<div class="text">
																		<span>Computer Installation:</span>
																		<span>5 Devices</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-company'); ?>
																	</div>
																	<div class="text">
																		<span>Company Size:</span>
																		<span>Up to 50 Employees</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-end-product'); ?>
																	</div>
																	<div class="text">
																		<span>End Product:</span>
																		<span>500,000</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-not-resale'); ?>
																	</div>
																	<div class="text">
																		<span>End Product Not For Resale</span>
																		<span></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Commercial', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$500
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For <strong>commercial usage</strong> including freelance projects, professional work, and agencies serving medium-scale clients (SMEs) with purposes:</span>
														<ul>
															<li>webfonts</li>
															<li>logos</li>
															<li>packaging</li>
															<li>books</li>
															<li>ePubs</li>
															<li>websites</li>
															<li>digital ads</li>
															<li>social media ads</li>
															<li>video commercials</li>
															<li>monetized blogs</li>
															<li>monetized social media</li>
															<li>commercial printing</li>
															<li>merchandise</li>
															<li>ect.</li>
														</ul>
													</div>
													<div class="license-desc-lists-use">
														<div class="row">
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-user'); ?>
																	</div>
																	<div class="text">
																		<span>Users:</span>
																		<span>Maximum 10</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-project'); ?>
																	</div>
																	<div class="text">
																		<span>Commercial Projects: </span>
																		<span>1</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-computer'); ?>
																	</div>
																	<div class="text">
																		<span>Computer Installation:</span>
																		<span>10 Devices</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-trademark'); ?>
																	</div>
																	<div class="text">
																		<span>Logo / Trademark: </span>
																		<span>Yes</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-company'); ?>
																	</div>
																	<div class="text">
																		<span>Company Size:</span>
																		<span>Up to 150 Employees</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-end-product'); ?>
																	</div>
																	<div class="text">
																		<span>End Product:</span>
																		<span>Unlimited</span>
																	</div>
																</div>
																<div class="license-desc-list-use">
																	<div class="icon">
																		<?php echo drizy_svg('license-not-resale'); ?>
																	</div>
																	<div class="text">
																		<span>End Product Not For Resale</span>
																		<span></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Enterprise', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													<div class="license-desc-use">
														<span>For use in <strong> large-scale projects:</strong></span>
														<ul>
															<li>public figures</li>
															<li>national</li>
															<li>multinational corporate companies</li>
															<li>servers</li>
															<li>applications</li>
															<li>games</li>
															<li>websites</li>
															<li>films</li>
															<li>editorials</li>
															<li>digital media</li>
															<li>print media</li>
															<li>broadcasting</li>
															<li>embedding</li>
															<li>modifications</li>
															<li>more.</li>
														</ul>
													</div>
													<div class="contact-us">
														<span>For uses not written above, higher requirements, or need a different license:consult</span>
														<span><a href="#">consult</a></span>
													</div>
													<div class="add-to-cart">
														<button class="elementor-button">
															<div class="button-inner">
																<span><?php _e( 'Add to Cart', 'drizy' ); ?></span>
																<span><?php echo drizy_svg('cart'); ?></span>
															</div>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="thin-italic" class="tab-content-vertical">
									<div class="license-wrapper">
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Personal', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$12
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Freelance', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$150
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Commercial', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$500
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Enterprise', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Thin', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="extra-thin-italic" class="tab-content-vertical">
									<div class="license-wrapper">
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Personal', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Extra Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$12
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Freelance', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Extra Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$150
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Commercial', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Extra Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
													$500
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
										<div class="lisence-list-wrapper">
											<div class="lisence-list">
												<div class="font-license-check">
													<span class="icon-check"><span></span></span>
												</div>
												<div class="font-license-name-wrapper">
													<div class="font-license-name">
														<?php _e( 'Enterprise', 'drizy' ); ?>
													</div>
													<div class="font-license-name-small">
														<?php _e( 'Gastermos Extra Thin Italic', 'drizy' ); ?>
													</div>
												</div>
												<div class="font-license-price">
												</div>
											</div>
											<div class="lisence-list-description">
												<div class="font-license-desc-title"><?php _e( 'Font licenses', 'drizy' ); ?></div>
												<div class="font-license-desc">
													Text
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /individual -->
			</div>

		</div>
	<?php //endif; ?>

	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode( 'font_buying_options', 'font_buying_options_shortcode' );

?>
<?php 

// Select font preview text product cat

// Personal
function personal_license_shortcode() { 

    ob_start(); ?>

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

    <?php $content = ob_get_clean();
    return $content;
}
add_shortcode( 'personal_license', 'personal_license_shortcode' );


// Freelancer
function freelance_license_shortcode() { 

    ob_start(); ?>

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
                        <span class="has-tooltip">500,000 
                            <span class="tooltip">
                                <?php echo drizy_svg('tooltip-icon'); ?>
                                <span class="tooltiptext"><?php esc_html_e( 'Products, Print, Sales, Impression, Page Views, and Images.', 'drizy' ); ?></span>
                            </span> 
                        </span>
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

    <?php $content = ob_get_clean();
    return $content;
}
add_shortcode( 'freelance_license', 'freelance_license_shortcode' );


// Commercial
function commercial_license_shortcode() { 

    ob_start(); ?>

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
                        <span class="has-tooltip">Unlimited
                            <span class="tooltip">
                                <?php echo drizy_svg('tooltip-icon'); ?>
                                <span class="tooltiptext"><?php esc_html_e( 'Products, Print, Sales, Impression, Page Views, and Images.', 'drizy' ); ?></span>
                            </span> 
                        </span>
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

    <?php $content = ob_get_clean();
    return $content;
}
add_shortcode( 'commercial_license', 'commercial_license_shortcode' );


// Enterprise
function enterprise_license_shortcode() { 

    ob_start(); ?>

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

    <?php $content = ob_get_clean();
    return $content;
}
add_shortcode( 'enterprise_license', 'enterprise_license_shortcode' );
<?php 
/**
 * name: Default
 * description: Default theme for Hotaru CMS
 * version: 0.1
 * author: shibuya246
 * authorurl: http://hotarucms.org/member.php?1-Nick
 *
 * PHP version 5
 *
 * LICENSE: Hotaru CMS is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License as 
 * published by the Free Software Foundation, either version 3 of 
 * the License, or (at your option) any later version. 
 *
 * Hotaru CMS is distributed in the hope that it will be useful, but WITHOUT 
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE. 
 *
 * You should have received a copy of the GNU General Public License along 
 * with Hotaru CMS. If not, see http://www.gnu.org/licenses/.
 * 
 * @category  Content Management System
 * @package   HotaruCMS
 * @author    shibuya246 <admin@hotarucms.org>
 * @copyright Copyright (c) 2010, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://hotarucms.org/
 */

// set a custom home page:
$h->setHome();

// get language
$h->includeThemeLanguage();

// get settings:
$h->vars['theme_settings'] = $h->getThemeSettings();

// plugins work here before anything is displayed. Return if overriding.
if ($h->pluginHook('theme_index_top')) { return false; };

// display header if not overriden by a plugin
if (!$h->pluginHook('theme_index_header')) { $h->displayTemplate('header'); }
?>

<body>

	<?php $h->pluginHook('post_open_body'); ?>	

        <!-- NAVIGATION -->
        <?php echo $h->displayTemplate('navigation'); ?>
	
        <?php if ($announcements = $h->checkAnnouncements()) { ?>
		<div id="announcement">
			<?php $h->pluginHook('announcement_first'); ?>
			<?php foreach ($announcements as $announcement) { echo $announcement . "<br />"; } ?>
			<?php $h->pluginHook('announcement_last'); ?>
		</div>
	<?php } ?>
		
	<div class="container<?php if ($h->vars['theme_settings']['fullWidth']) echo '-fluid'; ?>">
            <div class="row<?php if ($h->vars['theme_settings']['fullWidth']) echo '-fluid'; ?>">

                <div id="header_end" class="container<?php if ($h->vars['theme_settings']['fullWidth']) echo '-fluid'; ?>">
                        <!-- CATEGORIES, ETC -->
                        <?php $h->pluginHook('header_end'); ?>
                </div>

		<div id="content">

			<?php $width = ($h->sidebars) ? '9' : '12'; ?>
			<div id="main_container" class="span<?php echo $width; ?>">
				<div id="main">

					<!-- BREADCRUMBS -->
					<ul class='breadcrumb'>
						<?php echo $h->breadcrumbs("/"); ?>
					</ul>
					
					<!-- POST BREADCRUMBS -->
					<?php $h->pluginHook('theme_index_post_breadcrumbs'); ?>
					
					<!-- FILTER TABS -->
					<?php $h->pluginHook('theme_index_pre_main'); ?>
					
					<!-- MAIN -->
					<?php if (!$h->pluginHook('theme_index_main')) { $h->displayTemplate($h->pageName); } ?>
                                        <?php 
                                        
                                        $postCount = $h->postStats('total');
                                        
                                        if ($postCount && $postCount < 1) { ?>
                                            <div style="padding:15px 25px;" class="hero-unit">
                                                    <h2>Welcome to Hotaru CMS</h2>
                                                    <p>It looks like you are just getting started with your new Hotaru CMS website. Why not submit your first post and publish it to the homepage straight away.</p>
                                                    <p><a href="/submit/" class="btn btn-primary">Submit Your First Post</a></p>
                                            </div>
                                        <?php } ?>
                                        
					<div class="clear"></div>
				</div>
			</div>

			<!-- SIDEBAR -->
			<?php if ($h->sidebars) { ?>
                            <div class="span3">
                            <?php if (!$h->pluginHook('theme_index_sidebar')) { $h->displayTemplate('sidebar'); } ?>					
                            </div>
                        <?php } ?>

		</div> <!-- close "content" -->
                
            </div>

            <hr/>
		<!-- FOOTER -->
		<footer>
			<?php if (!$h->pluginHook('theme_index_footer')) { $h->displayTemplate('footer'); } ?>
		</footer>
        </div>
	

	<?php $h->pluginHook('pre_close_body'); ?>

</body>
</html>
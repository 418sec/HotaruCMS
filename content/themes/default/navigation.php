<?php 
/**
 * Theme name: default
 * Template name: navigation.php
 * Template author: Nick Ramsay
 *
 * This file looks a bit ugly because whitespace between LI tags 
 * renders as spaces, so I had to squash all the lines together
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
 * @author    Nick Ramsay <admin@hotarucms.org>
 * @copyright Copyright (c) 2010, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://hotarucms.org/
 */
?>

<!-- Navigation Bar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo SITEURL; ?>"><?php echo SITE_NAME; ?></a>
            <span class="btn-navbar">
            <?php	if ($h->currentUser->loggedIn) {
				if($h->isActive('avatar')) {
					$h->setAvatar($h->currentUser->id, 24, 'g', 'img-circle');
					echo  $h->linkAvatar();
				}
			} ?>
            </span>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php if ($h->currentUser->loggedIn) {
                            if($h->isActive('avatar')) {
                                    $h->setAvatar($h->currentUser->id, 22, 'g', 'img-circle');
                                    echo '<li class="visible-desktop">' . $h->linkAvatar() . '</li>';
                            }
                    } ?>
                    
                    <?php if ($h->pageName == $h->home) { $status = "id='navigation_active'"; } else { $status = ""; } ?>
                    <li <?php echo $status; ?>><a href="<?php echo SITEURL; ?>"><?php echo $h->lang["main_theme_navigation_home"]; ?></a></li><?php $h->pluginHook('navigation'); ?>
                    <?php // RSS Link and icon if a type "base" plugin is active
                        if ($h->isActive('base')) { ?>
                            <li>
                                <a href="<?php echo $h->url(array('page'=>'rss')); ?>">RSS 
                                        <img src="<?php echo SITEURL; ?>content/themes/<?php echo THEME; ?>images/rss_16.png" alt="RSS" />
                                </a>
                            </li>
                        <?php } ?>
                </ul>
                <ul class="nav nav-pills pull-right">
               
                    <?php
                    if (!$h->isActive('signin')) { 
		
			if ($h->currentUser->loggedIn == true) { 
			
				if ($h->isAdmin) { $status = "id='navigation_active'"; } else { $status = ""; }
				echo "<a href='" . $h->url(array(), 'admin') . "'>" . $h->lang["main_theme_navigation_admin"] . "</a>";
			
				if ($h->pageName == 'logout') { $status = "id='navigation_active'"; } else { $status = ""; }
				echo "<a href='" . $h->url(array('page'=>'admin_logout'), 'admin') . "'>" . $h->lang["main_theme_navigation_logout"] . "</a>";
			} else { 
				if ($h->pageName == 'login') { $status = "id='navigation_active'"; } else { $status = ""; }
				echo "<a href='" . $h->url(array(), 'admin') . "'>" . $h->lang["main_theme_navigation_login"] . "</a>";
			}
                    } else {
                            $h->pluginHook('navigation_users'); // ensures login/logout/register are last.
                    }
                ?>
                </ul>
               
            </div>
        </div>
    </div>
</div>




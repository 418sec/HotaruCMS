<?php

/**
 * Includes settings and constructs Hotaru.
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
 * @link      http://www.hotarucms.org/
 */
// includes
if( file_exists('config/settings.php') && file_exists('Hotaru.php')) {
	require_once('config/settings.php');
        //require_once('config/application.php');

//        try
//        {
//                // Process the HTTP request using only the routers we need for this application.
//                $fc = new Lvc_FrontController();
//                $fc->addRouter(new Lvc_RegexRewriteRouter($regexRoutes));
//                $fc->processRequest(new Lvc_HttpRequest());
//        }
//        catch (Lvc_Exception $e)
//        {
//                // Log the error message
//                error_log($e->getMessage());
//
//                // Get a request for the 404 error page.
//                $request = new Lvc_Request();
//                $request->setControllerName('error');
//                $request->setActionName('view');
//                $request->setActionParams(array('error' => '404'));
//
//                // Get a new front controller without any routers, and have it process our handmade request.
//                $fc = new Lvc_FrontController();
//                $fc->processRequest($request);
//        }
//        catch (Exception $e)
//        {
//                // Some other error, output "technical difficulties" message to user?
//                error_log($e->getMessage());
//        }

//print_r($regexRoutes); 
 
        require_once('Hotaru.php');
	$h = new Hotaru();
	$h->start('main');
        
        } else {
	if( file_exists('install/index.php') ) {
		echo 'Hotaru is having trouble starting. You may need to install the system before you can proceed further.<br/><br/>';
		echo 'Help is available in the <a href="http://forums.hotarucms.org/">Hotaru CMS Forums</a>.';
	} else {
		echo 'Hotaru is having trouble starting.';
	}
}
?>

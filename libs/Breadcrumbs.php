<?php
/**
 * Breadcrumb functions
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
 * @author    Hotaru CMS Team
 * @copyright Copyright (c) 2009 - 2013, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://www.hotarucms.org/
 */
namespace Libs;

class Breadcrumbs extends Prefab
{
	/**
	 * Build breadcrumbs
	 */
	public function buildBreadcrumbs($h, $sep)
	{
		$output = '';		
		
		// Admin only:
		if ($h->adminPage) {
			$output .= "<a href='" . $h->url(array(), 'admin') . "'>";
			$output .= $h->lang('admin_theme_main_admin_cp') . "</a>\n";
		} else {
			$output .= "<a href='" . SITEURL . "'>" . $h->lang('main_theme_breadcrumbs_home') . "</a>&nbsp;"; 
		}

		// plugin hook:
		$crumbs = $h->pluginHook('breadcrumbs');
                // TODO review and tighten OOP
                //print_r($crumbs);
		if ($crumbs) {
			$crumbs = array_reverse($crumbs); // so the last one gets used.
			foreach ($crumbs as $key => $value) {
                                $output .=  '<span class="divider">' . $sep . '</span>&nbsp;' . $value. '&nbsp;';
				
                                // maybe a hook here so we can add a button on right of breadcrumb
//                                if ($h->pageType == 'post') {
//                                    $output .= '<button class="btn btn-xs btn-default pull-right">Next <i class="fa fa-arrow-right"></i><span>';
//                                }
                                
                                return $output; // we only want the first result so return now.
			}
		} 
		
		// in case of no plugins:
		$output .= '<span class="divider">' . $sep . '</span>&nbsp;' . $h->pageTitle . '&nbsp;';
                
		// plugin settings
                if ($h->cage->get->testAlnumLines('plugin')) $output .= '<span class="divider">' . $sep . '</span>&nbsp;' . ucfirst ($h->cage->get->testAlnumLines('plugin')) . '&nbsp;';
                
		// theme settings
		if ($h->cage->get->testAlnumLines('theme')) $output .= '<span class="divider">' . $sep . '</span>&nbsp;' . ucfirst ($h->cage->get->testAlnumLines('theme')) . '&nbsp;';
                
		return $output;
	}
	
	
	/**
	 * prepares the RSS breadcrumbs link
	 *
	 * @param string $status - post status, e.g. new, top, etc.
	 * @param array $vars - array of key -> value pairs
	 * @return string
	 */    
	public function rssBreadcrumbsLink($h, $status = '', $vars)
	{
		if ($status) {
			$url_array = array('page'=>'rss', 'status'=>$status);
		} else {
			$url_array = array('page'=>'rss'); // defaults to all
		}
		
		foreach ($vars as $k => $v) {
			$url_array[$k] = $v;
		}
		$rss = "<a href='" . $h->url($url_array) . "'>";
		$rss .= '<i class="fa fa-rss-square rss-icon"></i>';
                $rss .= "</a>";
		return $rss;
	}
}

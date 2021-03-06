<?php
/*
Plugin Name: Bamboo
Plugin URI: http://bambooplugin.com
Description: Bamboo: sell your digital content online, generate license keys, manage downloads, collect cash, feed the panda.
Author: Fat Panda, LLC
Author URI: http://fatpandadev.com
Version: 1.0
License: GPL2
*/

/*
Copyright (C)2011-2012 Fat Panda, LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

@define( BAMBOO, __FILE__);
@define( BB_DIR, dirname(__FILE__));
@define( BB_URL, plugins_url('', __FILE__));
@define( BB_DEBUG, false);

#bootstrap
require(BB_DIR.'/includes/data.php');
require(BB_DIR.'/includes/api.php');
require(BB_DIR.'/includes/bamboo.php');
<?php
$GLOBALS['config'] = [];

/**
   What kind of environment is this?
   * 'devel' : Development. Non-minimal CSS and JS libraries and PHP
   code with information return.
   * 'prod' : Production. Minimal CSS and JS libraries and PHP
   without development output.
 */
$GLOBALS['environment']='devel';

/**
   Where I can store temporary files?

   For executing Racer, I need to store the OWLlink file, where I
   should do this?

   Remember: Apache (represented as httpd, apache or www-data user in
   some systems) should have write perms there.
 */
$GLOBALS['config']['temporal_path'] = '/var/www/html/t-crowd/';
$GLOBALS['config']['public_html'] = '/var/www/html/';
$GLOBALS['config']['t-crowd-main'] = 'it.gilia.tcrowd.cli.TCrowd';
$GLOBALS['config']['t-crowd-client'] = '/home/gab/Documentos/t-crowd/t-crowd-lib/target/dependency/t-crowd-cli-4.0.0-SNAPSHOT.jar';

/**
   Where is the reasoner?

   By default we provide a Racer and a konclude program inside the temporal_path
   (at wicom/run/), but if you want to use another program you
   have to set this value with the path.
 */
$GLOBALS['config']['t-nusmv_path'] = $GLOBALS['config']['temporal_path'];

/**
   @name Database Configuration.
*/
//@{
/**
   Database host.

   For specify the port use "HOST:PORT".

   Example: `localhost:3000`

   @see http://php.net/manual/en/mysqli.construct.php
*/
$GLOBALS['config']['db']['host'] = 'localhost';

/**
   Database user name.
 */

$GLOBALS['config']['db']['user'] = 'DB username';

/**
   Database password
 */
$GLOBALS['config']['db']['password'] = 'DB password here';

/**
   Database name.
 */
$GLOBALS['config']['db']['database'] = 'crowd';

$GLOBALS['config']['db']['charset'] = 'utf8';
//@}

?>

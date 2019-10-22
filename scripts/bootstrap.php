<?php
/**
 * This is the autoloader for the classes
 *
 * PHP version 7.2
 *
 * @category Bootstrap
 * @package  Bootstrap_File
 * @author   Benson Imoh <benson@stbensonimoh.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @version  GIT: 1.0
 * @link     https://opensource.org/licenses/MIT
 */

 // Load the configuration file
$config = include '../config.php';

// autoload the classes
require '../autoload.php';

//Instantiate the Database connection
$db = new DB(
    $config['database']['host'],
    $config['database']['name'],
    $config['database']['user'],
    $config['database']['password']
);

// RavePay Key
$raveKey = $config['ravepay']['public_key'];
$raveSecKey = $config['ravepay']['secret_key'];

// Transaction Reference
$prefix = "GTA-";
$suffix = rand(1000000, 7000000);
$transactionRef = $prefix.$suffix;

// Bulk SMS Token
$smstoken = $config['smstoken'];

// Instantiate the SMS class
$SMS = new SMS($smstoken);

// Mailgun Credentials
$apikey = $config['mailgun']['apikey'];
$domain = $config['mailgun']['domain'];
$list = $config['mailgun']['list_alias'];

// Instantiate the Mailgun Class
$mg = new Mailgun($apikey, $domain, $list);
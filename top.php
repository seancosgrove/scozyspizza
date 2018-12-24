<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);

?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Scozy's Pizza</title>
        
        <meta charset='utf-8'>
        <meta name='author' content='Sean Cosgrove'>
        <meta name='description' content='Final project for CS 8.'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="../css/scozyspizza.css" type="text/css" media="screen">
        
        
        <?php
        $debug = false;
        
        
        
        if (isset($_GET['debug'])) {
            $debug = true;
        }
        
// =============================================================================
//
// PATH SETUP
//
        
$domain = '//';
        
$server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');

$domain .= $server;           
        
        
        if ($debug) {
            
            print '<p>php Self: ' . $phpSelf;
            print '<p>Path Parts<pre>';
            print_r($path_parts);
            print '</pre></p>';
        }
        
// =============================================================================
//
// include all libraries.
//
// Common mistake: not have the lib folder with these files.
// Google the difference between require and include
//
        print PHP_EOL . '<!-- include libraries -->' . PHP_EOL;
        
        require_once('../lib/security.php'); 
        
        // notice this if statemtent only includes the functions if it is 
        // form page. A common mistake is to make a form and call the page
        // join.php which means you need to change it below (or delete the if)
        if ($path_parts['filename'] == "order") {
            print PHP_EOL . '<!-- include form libraries -->' . PHP_EOL;
            include '../lib/validation-functions.php';
            include '../lib/mail-message.php';
        }
        
        if ($path_parts['filename'] == "catering") {
            print PHP_EOL . '<!-- include form libraries -->' . PHP_EOL;
            include '../lib/validation-functions.php';
            include '../lib/mail-message.php';
        }
        
        
        
        
        
        print PHP_EOL . '<!-- finished including libraries -->' . PHP_EOL;
        ?>
        
    </head>
    <!-- =====================   Body Section   ============================ -->
    
    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    
    include 'header.php';
    include 'nav.php';
    
    if ($debug) {
        print '<p>DEBUG MODE IS ON</p>';
    }
    ?>
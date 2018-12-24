<?php
include "top.php";

$orders = '';

$caterings = '';

if(isset($_GET['orders'])) {
    $orders = htmlentities($_GET['orders'], ENT_QUOTES, "UTF-8");
}

if(isset($_GET['caterings'])) {
    $caterings = htmlentities($_GET['caterings'], ENT_QUOTES, "UTF-8");
}

$debug = false;

if(isset($_GET['debug'])) {
    $debug = true;
}

$myFolder = '';

$myFileName = 'orders';

$fileExt = '.csv';

$filename = $myFolder . $myFileName . $fileExt;

if ($debug) {
    print '<p>filename is ' . $filename;
}

$file = fopen($filename, 'r');

if ($debug) {
    if ($file) {
        print '<p>File Opened Successful.</p>';
    } else{
        print '<p>File Open Failed.</p>';
    }
}

if ($file) {
    if ($debug) {
        print '<p>Begin reading data into an array.</p>';
    }
    
    $headers[] = fgetcsv($file);
    
    if($debug) {
        print '<p>Finnished reading headers.</p>';
        print '<p>My header array</p><pre>';
        print_r($headers);
        print '</pre>';
    }
    
    while (!feof($file)) {
        $orders[] = fgetcsv($file);
    }
    
    if ($debug) {
        print '<p>Finnished reading data. File closed.</p>';
        print '<p>My data array<p><pre>';
        print_r($orders);
        print '</pre></p>';
    }
}

fclose($file);


$myFolder2 = '';

$myFileName2 = 'catering';

$fileExt2 = '.csv';

$filename2 = $myFolder2 . $myFileName2 . $fileExt2;

if ($debug) {
    print '<p>filename is ' . $filename2;
}

$file2 = fopen($filename2, 'r');

if ($debug) {
    if ($file2) {
        print '<p>File Opened Successful.</p>';
    } else{
        print '<p>File Open Failed.</p>';
    }
}

if ($file2) {
    if ($debug) {
        print '<p>Begin reading data into an array.</p>';
    }
    
    $nheaders[] = fgetcsv($file2);
    
    if($debug) {
        print '<p>Finnished reading headers.</p>';
        print '<p>My header array</p><pre>';
        print_r($nheaders);
        print '</pre>';
    }
    
    while (!feof($file2)) {
        $caterings[] = fgetcsv($file2);
    }
    
    if ($debug) {
        print '<p>Finnished reading data. File closed.</p>';
        print '<p>My data array<p><pre>';
        print_r($caterings);
        print '</pre></p>';
    }
}

fclose($file2);
?>
<article id='main'>
    
    <h1>Track Your Order</h1>
    
    <table>
        <?php
        foreach ($headers as $header) {
            print '<tr>';
            print '<th>Pizza Orders</th>';
            print '<th>' . $header[1] . '</th>';
            print '<th>' . $header[6] . '</th>';
            print '<th>' . $header[30] . '</th>';
            print '</tr>' . PHP_EOL;
        }
        
        foreach ($orders as $order) {
            print '<tr>';
            print '<td>' . $order[0] . '</td>';
            print '<td>' . $order[1] . '</td>';
            if (empty($order[0])) {
                print '<td></td>';
            } elseif (empty($order[6])) {
                print '<td>Toppings Included</td>';
            } else {
                print '<td>' . $order[6] . '</td>';
            }
            if (empty($order[30])) {
                print '<td></td>';
            } else {
                print '<td>' . $order[30] . '</td>'; }
            print '</tr>' . PHP_EOL;
        }
        
        foreach ($nheaders as $nheader) {
            print '<tr>';
            print '<th>Catering Orders</th>';
            print '<th>' . $nheader[1] . '</th>';
            print '<th>' . $nheader[5] . '</th>';
            print '<th>' . $nheader[31] . '</th>';
            print '</tr>' . PHP_EOL;
        }
        
        foreach ($caterings as $catering) {
            print '<tr>';
            print '<td>' . $catering[0] . '</td>';
            print '<td>' . $catering[1] . '</td>';
            if (empty($catering[0])) {
                print '<td></td>';
            } elseif (empty($catering[6])) {
                print '<td>Toppings Included</td>';
            } else {
                print '<td>' . $catering[6] . '</td>';
            }
            if (empty($catering[31])) {
                print '<td></td>';
            } else {
                print '<td>' . $catering[31] . '</td>'; }
            print '</tr>' . PHP_EOL;
        }
        
        ?>
    </table>
    
</article>

<?php include "footer.php"; ?>

</body>
</html>
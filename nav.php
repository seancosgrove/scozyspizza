<!-- =====================   Main Navigation   ============================= -->
<hr>
<nav>
    <ol>
        <?php
        print'<li class="';
        if ($path_parts['filename'] == "index") {
            print ' activePage ';
        }
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';
        
        print'<li class="';
        if ($path_parts['filename'] == "menu") {
            print ' activePage ';
        }
        print '">';
        print '<a href="menu.php">Menu</a>';
        print '</li>';
        
        print'<li class="';
        if ($path_parts['filename'] == "order") {
            print ' activePage ';
        }
        print '">';
        print '<a href="order.php">Order Online</a>';
        print '</li>';
        
        print'<li class="';
        if ($path_parts['filename'] == "catering") {
            print ' activePage ';
        }
        print '">';
        print '<a href="catering.php">Catering</a>';
        print '</li>';
        
        print'<li class="';
        if ($path_parts['filename'] == "tracker") {
            print ' activePage ';
        }
        print '">';
        print '<a href="tracker.php">Order Tracker</a>';
        print '</li>';
        
        print'<li class="';
        if ($path_parts['filename'] == "contact") {
            print ' activePage ';
        }
        print '">';
        print '<a href="contact.php">About Us</a>';
        print '</li>';
        
        ?>
    </ol>
</nav>
<hr>
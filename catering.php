<?php
include "top.php";
//------------------------------------------------------------------------------
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
//
if ($debug){
    print '<p>Post Array:</p><pre>';
    print_r($_POST);
    print '</pre>';
}
    
//------------------------------------------------------------------------------
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a
    
$thisURL = $domain . $phpSelf;
    
    
//------------------------------------------------------------------------------
//
// SECTION: 1c form varaibles
//
// Initialize variables one for each form element
// in the order they appear on the form

$pizza = "Build Your Own";

$size = "XX Large";

$amount = 1;

$ingredients = "Normal Ingredients";

$gluten = "Gluten";

$noToppings = true;

$extraCheese = false;

$basil = false;

$lettuce = false;

$tomato = false;

$mushrooms = false;

$onions = false;

$blackOlives = false;

$greenPeppers = false;

$spinach = false;

$broccoli = false;

$jalapeño = false;

$garlic = false;

$pepperoni = false;

$bacon = false;

$sausage= false;

$meatball = false;

$ham = false;

$grilledChicken = false;

$buffaloChicken = false;

$bbqChicken = false;

$firstName = "";

$phoneNumber = "";
    
$email = "";

if(isset($_POST['btnDelivery'])) $address = "";

if(isset($_POST['btnDelivery'])) $city = "";

if(isset($_POST['btnDelivery'])) $state = "";

if(isset($_POST['btnDelivery'])) $zipCode = "";

$day = "Monday";

$time = "12:00 P.M.";
    
//------------------------------------------------------------------------------
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.

$pizzaERROR = false;

$sizeERROR = false;

$amountERROR = false;

$ingredientsERROR = false;

$glutenERROR = false;

$toppingsERROR = false;
$totalChecked = 0;

$firstNameERROR = false;

$phoneNumberERROR = false;
    
$emailERROR = false;

if(isset($_POST['btnDelivery'])) $addressERROR = false;

if(isset($_POST['btnDelivery'])) $cityERROR = false;

if(isset($_POST['btnDelivery'])) $stateERROR = false;

if(isset($_POST['btnDelivery'])) $zipCodeERROR = false;

$dayERROR = false;

$timeERROR = false;
    
//------------------------------------------------------------------------------
//
// SECTION: 1e misc variables
//
// create array to hold error messages
$errorMsg = array();
    
// array used to hold form values that will be written to a CSV file
$dataRecord = array ();
    
// have we mailed the information to the user?
$mailed = false;
    
//------------------------------------------------------------------------------
//
// SECTION: 2 Process for when the form in submitted
//
if (isset($_POST["btnSubmit"])) {
    
    //--------------------------------------------------------------------------
    //
    // SECTION: 2a Security
    //
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page. ';
        $msg = 'Security breach detected and reported.</p>';
        die($msg);
    }
    
    
    //--------------------------------------------------------------------------
    //
    // SECTION: 2b Sanitize (clean) data
    // remove any potential JavaScript or html code from users input on the
    // form. Follow same order as declared in section 1c.
    
    $pizza = htmlentities($_POST["lstPizzaSelection"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $pizza;
    
    $size = htmlentities($_POST["lstPizzaSize"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $size;
    
    $amount = htmlentities($_POST["txtPizzaAmount"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $amount;
    
    $ingredients = htmlentities($_POST['radIngredients'], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $ingredients;
    
    $gluten = htmlentities($_POST['radIngredients'], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gluten;
    
    if(isset($_POST["chkNoToppings"])) {
        $noToppings = true;
        $dataRecord[] = htmlentities($_POST["chkNoToppings"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $noToppings = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkExtraCheese"])) {
        $extraCheese = true;
        $dataRecord[] = htmlentities($_POST["chkExtraCheese"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $extraCheese = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkBasil"])) {
        $basil = true;
        $dataRecord[] = htmlentities($_POST["chkBasil"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $basil = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkLettuce"])) {
        $lettuce = true;
        $dataRecord[] = htmlentities($_POST["chkLettuce"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $lettuce = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkTomato"])) {
        $tomato = true;
        $dataRecord[] = htmlentities($_POST["chkTomato"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $tomato = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkMushrooms"])) {
        $mushrooms = true;
        $dataRecord[] = htmlentities($_POST["chkMushrooms"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $mushrooms = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkOnions"])) {
        $onions = true;
        $dataRecord[] = htmlentities($_POST["chkOnions"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $onions = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkBlackOlives"])) {
        $blackOlives = true;
        $dataRecord[] = htmlentities($_POST["chkBlackOlives"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $blackOlives = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkGreenPeppers"])) {
        $greenPeppers = true;
        $dataRecord[] = htmlentities($_POST["chkGreenPeppers"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $greenPeppers = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkSpinach"])) {
        $spinach = true;
        $dataRecord[] = htmlentities($_POST["chkSpinach"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $spinach = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkBroccoli"])) {
        $broccoli = true;
        $dataRecord[] = htmlentities($_POST["chkBroccoli"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $broccoli = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkJalapeño"])) {
        $jalapeño = true;
        $dataRecord[] = htmlentities($_POST["chkJalapeño"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $jalapeño = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkGarlic"])) {
        $garlic = true;
        $dataRecord[] = htmlentities($_POST["chkGarlic"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $garlic = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkPepperoni"])) {
        $pepperoni = true;
        $dataRecord[] = htmlentities($_POST["chkPepperoni"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $pepperoni = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkBacon"])) {
        $bacon = true;
        $dataRecord[] = htmlentities($_POST["chkBacon"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $bacon = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkSausage"])) {
        $sausage = true;
        $dataRecord[] = htmlentities($_POST["chkSausage"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $sausage = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkMeatball"])) {
        $meatball = true;
        $dataRecord[] = htmlentities($_POST["chkMeatball"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $meatball = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkHam"])) {
        $ham = true;
        $dataRecord[] = htmlentities($_POST["chkHam"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $ham = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkGrilledChicken"])) {
        $grilledChicken = true;
        $dataRecord[] = htmlentities($_POST["chkGrilledChicken"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $grilledChicken = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkBuffaloChicken"])) {
        $buffaloChicken = true;
        $dataRecord[] = htmlentities($_POST["chkBuffaloChicken"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $buffaloChicken = false;
        $dataRecord[] = "";
    }
    
    if(isset($_POST["chkBBQChicken"])) {
        $bbqChicken = true;
        $dataRecord[] = htmlentities($_POST["chkBBQChicken"], ENT_QUOTES, "UTF-8");
        $totalChecked++;
    } else {
        $bbqChicken = false;
        $dataRecord[] = "";
    }
    
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    
    $phoneNumber = htmlentities($_POST["txtPhoneNumber"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $phoneNumber;
    
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;
    
    if(isset($_POST['btnDelivery'])) {
        $address = htmlentities($_POST["txtAddress"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $address; }
    
    if(isset($_POST['btnDelivery'])) {
        $city = htmlentities($_POST["txtCity"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $city; }
    
    if(isset($_POST['btnDelivery'])) {
        $state = htmlentities($_POST["txtState"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $state; }
    
    if(isset($_POST['btnDelivery'])) {
        $zipCode = htmlentities($_POST["txtZipCode"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $zipCode; }
        
    $day = htmlentities($_POST['lstDay'], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $day;
    
    $time = htmlentities($_POST["lstTime"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $time;
    
    //--------------------------------------------------------------------------
    //
    // SECTION: 2c Validation
    //
    
    if ($pizza == ""){
        $errorMsg[] = "Please choose a pizza!";
        $pizzaERROR = true;
    }   
    
    if ($size == ""){
        $errorMsg[] = "Please choose a size!";
        $sizeERROR = true;
    }
    
    if ($amount < 1){
        $errorMsg[] = "You must order at least one pizza!";
        $amountERROR = true;
    }
    
    if ($ingredients != "Normal Ingredients" AND $ingredients != "Vegetarian Ingredients" AND $ingredients != "Vegan Ingredients"){
        $errorMsg[] = "Please choose an ingredient preference.";
        $ingredientsERROR = true;
    }
    
    if ($totalChecked < 1){
        $errorMsg[] = "Please choose 'No Toppings' or select desired toppings.";
        $activityERROR = true;
    }
    
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name.";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character(s).";
        $firstNameERROR = true;
    }
    
    if ($phoneNumber == "") {
        $errorMsg[] = "Please enter your phone number.";
        $phoneNumberERROR = true;
    } elseif (!verifyPhone($phoneNumber)) {
        $errorMsg[] = "Please enter a valid phone number.";
        $phoneNumberERROR = true;
    }
    
    if ($email == "") {
        $errorMsg[] = "Please enter your email address.";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Enter a valid email address.';
        $emailERROR = true;
    }
    
    if(isset($_POST['btnDelivery'])) {
        if ($address == "") {
            $errorMsg[] = "Please enter your street address.";
            $addressERROR = true;
        }
    }
    
    if(isset($_POST['btnDelivery'])) {
        if ($city == "") {
            $errorMsg[] = "Please enter your city/town.";
            $cityERROR = true;
        } elseif (!verifyAlphaNum($city)) {
            $errorMsg[] = "Your city/town appears to have extra character(s).";
            $cityERROR = true;
        }
    }
    
    if(isset($_POST['btnDelivery'])) {
        if ($state == "") {
            $errorMsg[] = "Please enter your state.";
            $stateERROR = true;
        } elseif (!verifyAlphaNum($state)) {
            $errorMsg[] = "Your state appears to have extra character(s).";
            $stateERROR = true;
        }
    }
    
    if(isset($_POST['btnDelivery'])) {
        if ($zipCode == "") {
            $errorMsg[] = "Please enter your zip code.";
            $zipCodeERROR = true;
        } elseif (!verifyNumeric($zipCode)) {
            $errorMsg[] = "Please enter a valid zip code.";
            $zipCodeERROR = true;
        }
    }
    
    if ($day == ""){
        $errorMsg[] = "Please choose the day you need your order.";
        $dayERROR = true;
    }
    
    if ($time == ""){
        $errorMsg[] = "Please choose the time you need your order.";
        $timeERROR = true;
    }
    
    //--------------------------------------------------------------------------
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation
    //
    if (!$errorMsg) {
        if ($debug)
            print PHP_EOL . '<p>Form is valid</p>';
        
        
        //----------------------------------------------------------------------
        //
        // SECTION: 2e Save Data
        //
        // Save data to CSV file
        $myFolder = '';
        
        $myFileName = 'catering';
        
        $fileExt = '.csv';
        
        $filename = $myFolder . $myFileName . $fileExt;
        if ($debug) print PHP_EOL . '<p>filename is ' . $filename;
        
        // Open file for append
        $file = fopen($filename, 'a');
        
        // Write information
        fputcsv($file, $dataRecord);
        
        // Close file
        fclose($file);
        
        //----------------------------------------------------------------------
        //
        // SECTION: 2f Create Message
        //
        
        
        
        
        $message = '<h2>Your Order</h2>';
        
        foreach ($_POST as $htmlName => $value) {
            
            $message .= '<p>';
            // breaks up form names into words
            // ex: txtFirstName -> First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));
            
            foreach ($camelCase as $oneWord) {
                $message .= $oneWord . ' ';
            }
            
            $message .= ' : ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
                    
        }
        
        //----------------------------------------------------------------------
        //
        // SECTION: 2g Mail to User
        //
        // Process for mailing a message which contains the forms data
        // message was built in section 2f.
        $companyEmail = 'scozyspizza@gmail.com';
        $to = $email; // the person who filled out the form
        $cc = $companyEmail;
        $bcc = '';
        
        $from = "ScozysPizza";
        
        // subject of mail should make sense to your form
        $subject = "Order Confirmation from Scozys Pizza";
        
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        
        
    } // end form is valid
        
} // ends if form was submitted


//------------------------------------------------------------------------------
//
// SECTION: 3 Display Form
//
?>
<article id='main'>
    
    <?php
    //--------------------------------------------------------------------------
    //
    // SECTION: 3a
    //
    // If it is the first time coming to the form or there are any errors
    // Display the form
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
        print '<h2>Thank you for placing your order.</h2>';
        
        print '<p>A confirmation email has ';
        
        if (!$mailed) {
            print "not ";           
        }
        print 'been sent:</p>';
        print '<p> To: ' . $email . '</p>';
        
        print $message;
    } else {
        
        print '<h1>Catering Order</h1>';
        print '<p class="form-heading">All orders must have 24 hour notice. Orders that fail to do so will be denied.</p>';
        
        //----------------------------------------------------------------------
        //
        // SECTION: 3b Error Messages
        //
        // display any error messages before we print out the form
        
        if ($errorMsg) {
            print '<div id="errors">' . PHP_EOL;
            print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
            print '<ol>' . PHP_EOL;
            
            foreach($errorMsg as $err) {
                print '<li>' . $err . '</li>' . PHP_EOL;
            }
        
            print '</ol>' . PHP_EOL;
            print '</div>' . PHP_EOL;
        }    
    
    //--------------------------------------------------------------------------
    //
    // SECTION: 3c HTML Form
    //
    // Display the html form
    
    

        
        
        
        
        
        
        
    ?>
    
    <form action="<?php print $phpSelf; ?>"
              id ="frmRegister"
              method="post">
        
            <fieldset class="button">
                <legend>Picking Up or Delivery?</legend>
                <input class="button" id="btnPickingUp" name="btnPickingUp" tabindex="80" type="submit" value="Picking Up" >
                <input class="button" id="btnDelivery" name="btnDelivery" tabindex="90" type="submit" value="Delivery" >
            </fieldset>
        
            <fieldset id="pizzaOrder" class=" <?php if ($pizzaERROR) print ' mistake'; ?>">
                <legend>Pizza</legend>
                <p> 
                    <select id="lstPizzaSelection"
                            name="lstPizzaSelection"
                            tabindex="10"
                            class="marginRightSmall">
                        <option <?php if($pizza=="Build Your Own") print " selected "; ?>
                            value="Build Your Own">Build Your Own ($10.00)</option>
                        
                        <option <?php if($pizza=="Margherita Pizza") print " selected "; ?>
                            value="Margherita Pizza">Margherita Pizza ($10.00)</option>
                        
                        <option <?php if($pizza=="Three Cheese Pizza") print " selected "; ?>
                            value="Three Cheese Pizza">Three Cheese Pizza ($10.00)</option>
                        
                        <option <?php if($pizza=="BLT Pizza") print " selected "; ?>
                            value="BLT Pizza">BLT Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Buffalo Chicken Pizza") print " selected "; ?>
                            value="Buffalo Chicken Pizza">Buffalo Chicken Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Chicken Alfredo Pizza") print " selected "; ?>
                            value="Chicken Alfredo Pizza">Chicken Alfredo Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Meat Lover's Pizza") print " selected "; ?>
                            value="Meat Lover's Pizza">Meat Lover's Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Chicken Bacon Ranch Pizza") print " selected "; ?>
                            value="Chicken Bacon Ranch Pizza">Chicken Bacon Ranch Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Honolulu Hawaiian Pizza") print " selected "; ?>
                            value="Honolulu Hawaiian Pizza">Honolulu Hawaiian Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Mac n Cheese Pizza") print " selected "; ?>
                            value="Mac n Cheese Pizza">Mac n Cheese Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Shrimp Scampi Pizza") print " selected "; ?>
                            value="Shrimp Scampi Pizza">Shrimp Scampi Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Vegan Deep Dish Pizza") print " selected "; ?>
                            value="Vegan Deep Dish Pizza">Vegan Deep Dish Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Vegan Thai Pizza") print " selected "; ?>
                            value="Vegan Thai Pizza">Vegan Thai Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Vegan BBQ Sweet Potato Pizza") print " selected "; ?>
                            value="Vegan BBQ Sweet Potato Pizza">Vegan BBQ Sweet Potato Pizza ($12.50)</option>
                        
                        <option <?php if($pizza=="Vegan Buffalo Chickpea Pizza") print " selected "; ?>
                            value="Vegan Buffalo Chickpea Pizza">Vegan Buffalo Chickpea Pizza ($12.50)</option>
                    </select>
                </p>
                  
                <p>
                    <select id="lstPizzaSize"
                            name="lstPizzaSize"
                            tabindex="11"
                            class="marginRightSmall">
                        <option <?php if($size=="XX Large") print " selected "; ?>
                            value="XX Large">XX Large (10x20 inch, +$10.00)</option>
                        
                        <option <?php if($size=="Individual") print " selected "; ?>
                            value="Individual">XXX Large (15x30 inch, +$15.00)</option>    
                    </select>
                </p>
                
                <p>
                    <label class="marginRightSmall">
                        <input
                            id="txtPizzaAmount"
                            name="txtPizzaAmount"
                            tabindex="12"
                            type="number"
                            value="0"></label>
                </p>
                  
                <p class='toppings'>All toppings are +$1.00</p>
                
                <article class="marginRightSmall marginTopRadio">
                    <p>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radNormalIngredients"
                                   name="radIngredients"
                                   value="Normal Ingredients"
                                   tabindex="15"
                                   <?php if ($ingredients == 'Normal Ingredients') echo ' checked="checked" '; ?>>
                        Normal Ingredients</label>
                    </p>

                    <p>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radVegetarianIngredients"
                                   name="radIngredients"
                                   value="Vegetarian Ingredients"
                                   tabindex="16"
                                   <?php if ($ingredients == 'Vegetarian Ingredients') echo ' checked="checked" '; ?>>
                        Vegetarian Ingredients</label>
                    </p>

                    <p>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radVeganIngredients"
                                   name="radIngredients"
                                   value="Vegan Ingredients"
                                   tabindex="17"
                                   <?php if ($ingredients == 'Vegan Ingredients') echo ' checked="checked" '; ?>>
                        Vegan Ingredients</label>
                    </p>
                
                </article>
                
                <article class="marginRightSmall marginTopRadio">
                    <p>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radGlutenY"
                                   name="radGluten"
                                   value="Gluten"
                                   tabindex="18"
                                   <?php if ($gluten == 'Gluten') echo ' checked="checked" '; ?>>
                        Gluten</label>
                    </p>

                    <p>
                        <label class="radio-field">
                            <input type="radio"
                                   id="radGlutenFree"
                                   name="radGluten"
                                   value="Gluten Free"
                                   tabindex="19"
                                   <?php if ($gluten == 'Gluten Free') echo ' checked="checked" '; ?>>
                        Gluten Free</label>
                    </p>
                </article>
                
                <ul class="columnsCheckBox noIndent marginTopNegative2">
                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($noToppings) print " checked "; ?>
                                id="chkNoToppings"
                                name="chkNoToppings"
                                tabindex="20"
                                type="checkbox"
                                value="No Toppings">No Toppings</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($extraCheese) print " checked "; ?>
                                id="chkExtraCheese"
                                name="chkExtraCheese"
                                tabindex="30"
                                type="checkbox"
                                value="Extra Cheese">Extra Cheese</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($basil) print " checked "; ?>
                                id="chkBasil"
                                name="chkBasil"
                                tabindex="40"
                                type="checkbox"
                                value="Basil">Basil</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($lettuce) print " checked "; ?>
                                id="chkLettuce"
                                name="chkLettuce"
                                tabindex="50"
                                type="checkbox"
                                value="Lettuce">Lettuce</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($tomato) print " checked "; ?>
                                id="chkTomato"
                                name="chkTomato"
                                tabindex="60"
                                type="checkbox"
                                value="Tomato">Tomato</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($mushrooms) print " checked "; ?>
                                id="chkMushrooms"
                                name="chkMushrooms"
                                tabindex="70"
                                type="checkbox"
                                value="Mushrooms">Mushrooms</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($onions) print " checked "; ?>
                                id="chkOnions"
                                name="chkOnions"
                                tabindex="80"
                                type="checkbox"
                                value="Onions">Onions</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($blackOlives) print " checked "; ?>
                                id="chkBlackOlives"
                                name="chkBlackOlives"
                                tabindex="90"
                                type="checkbox"
                                value="Black Olives">Black Olives</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($greenPeppers) print " checked "; ?>
                                id="chkGreenPeppers"
                                name="chkGreenPeppers"
                                tabindex="100"
                                type="checkbox"
                                value="Green Peppers">Green Peppers</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($spinach) print " checked "; ?>
                                id="chkSpinach"
                                name="chkSpinach"
                                tabindex="110"
                                type="checkbox"
                                value="Spinach">Spinach</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($broccoli) print " checked "; ?>
                                id="chkBroccoli"
                                name="chkBroccoli"
                                tabindex="120"
                                type="checkbox"
                                value="Broccoli">Broccoli</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($jalapeño) print " checked "; ?>
                                id="chkJalapeño"
                                name="chkJalapeño"
                                tabindex="130"
                                type="checkbox"
                                value="Jalapeño">Jalapeño</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($garlic) print " checked "; ?>
                                id="chkGarlic"
                                name="chkGarlic"
                                tabindex="140"
                                type="checkbox"
                                value="Garlic">Garlic</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($pepperoni) print " checked "; ?>
                                id="chkPepperoni"
                                name="chkPepperoni"
                                tabindex="150"
                                type="checkbox"
                                value="Pepperoni">Pepperoni</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($bacon) print " checked "; ?>
                                id="chkBacon"
                                name="chkBacon"
                                tabindex="160"
                                type="checkbox"
                                value="Bacon">Bacon</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($sausage) print " checked "; ?>
                                id="chkSausage"
                                name="chkSausage"
                                tabindex="170"
                                type="checkbox"
                                value="Sausage">Sausage</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($meatball) print " checked "; ?>
                                id="chkMeatball"
                                name="chkMeatball"
                                tabindex="180"
                                type="checkbox"
                                value="Meatball">Meatball</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($ham) print " checked "; ?>
                                id="chkHam"
                                name="chkHam"
                                tabindex="190"
                                type="checkbox"
                                value="Ham">Ham</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($grilledChicken) print " checked "; ?>
                                id="chkGrilledChicken"
                                name="chkGrilledChicken"
                                tabindex="200"
                                type="checkbox"
                                value="Grilled Chicken">Grilled Chicken</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($buffaloChicken) print " checked "; ?>
                                id="chkBuffaloChicken"
                                name="chkBuffaloChicken"
                                tabindex="210"
                                type="checkbox"
                                value="Buffalo Chicken">Buffalo Chicken</label> 
                    </li>

                    <li class="noIndent">
                        <label class="check-field">
                            <input <?php if ($bbqChicken) print " checked "; ?>
                                id="chkBBQChicken"
                                name="chkBBQChicken"
                                tabindex="220"
                                type="checkbox"
                                value="BBQ Chicken">BBQ Chicken</label> 
                    </li>
                </ul>
                
            </fieldset>
        
            <fieldset class="contact">
                <legend>Contact Information</legend>
                <p>
                    <label class="required text-field" for ="txtFirstName">First Name:</label>
                    <input autofocus
                    <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                           id ="txtFirstName"
                           maxlength="45"
                           name="txtFirstName"
                           onfocus="this.select()"
                           placeholder="Enter your first name"
                           tabindex="500"
                           type="text"
                           value="<?php print $firstName; ?>"
                           >
                </p>

                <p>
                    <label class="required text-field" for ="txtPhoneNumber">Phone Number:</label>
                    <input
                    <?php if ($phoneNumberERROR) print 'class="mistake"'; ?>
                        id ="txtPhoneNumber"
                        maxlength="45"
                        name="txtPhoneNumber"
                        onfocus="this.select()"
                        placeholder="Enter your phone number"
                        tabindex="510"
                        type="text"
                        value="<?php print $phoneNumber; ?>"
                        >
                </p>

                <p>
                    <label class="required text-field" for="txtEmail">Email:</label>
                    <input
                    <?php if ($emailERROR) print 'class="mistake"'; ?>
                        id ="txtEmail"
                        maxlength="45"
                        name="txtEmail"
                        onfocus="this.select()"
                        placeholder="Enter your email address"
                        tabindex="520"
                        type="text"
                        value="<?php print $email; ?>"
                        >
                </p>
            </fieldset>
            
            <?php if(isset($_POST['btnDelivery'])) {
                include 'delivery.php';
            } ?>
        
        <fieldset class='listbox dayAndTime' <?php if ($dayERROR) print ' mistake'; ?>">
            <legend>Day and Time of Order Completion</legend>
            <p>
                <label class='required text-field' for='lstDay'>Day:</label>
                <select id='lstDay'
                        name='lstDay'
                        tabindex="600" >
                    <option <?php if($day == "Monday") print " selected "; ?>
                        value='Monday'>Monday</option>
                    <option <?php if($day == "Tuesday") print " selected "; ?>
                        value='Tuesday'>Tuesday</option>
                    <option <?php if($day == "Wednesday") print " selected "; ?>
                        value='Wednesday'>Wednesday</option>
                    <option <?php if($day == "Thursday") print " selected "; ?>
                        value='Thursday'>Thursday</option>
                    <option <?php if($day == "Friday") print " selected "; ?>
                        value='Friday'>Friday</option>
                    <option <?php if($day == "Saturday") print " selected "; ?>
                        value='Saturday'>Saturday</option>
                    <option <?php if($day == "Sunday") print " selected "; ?>
                        value='Sunday'>Sunday</option>
                </select>
            </p>
            
            <p>
                <label class='required text-field' for='lstTime'>Time:</label>
                <select id='lstTime'
                        name='lstTime'
                        tabindex="610" >
                    <option <?php if($time == "12:00 P.M.") print " selected "; ?>
                        value='12:00 P.M.'>12:00 P.M.</option>
                    <option <?php if($time == "1:00 P.M.") print " selected "; ?>
                        value='1:00 P.M.'>1:00 P.M.</option>
                    <option <?php if($time == "2:00 P.M.") print " selected "; ?>
                        value='2:00 P.M.'>2:00 P.M.</option>
                    <option <?php if($time == "3:00 P.M.") print " selected "; ?>
                        value='3:00 P.M.'>3:00 P.M.</option>
                    <option <?php if($time == "4:00 P.M.") print " selected "; ?>
                        value='4:00 P.M.'>4:00 P.M.</option>
                    <option <?php if($time == "5:00 P.M.") print " selected "; ?>
                        value='5:00 P.M.'>5:00 P.M.</option>
                    <option <?php if($time == "6:00 P.M.") print " selected "; ?>
                        value='6:00 P.M.'>6:00 P.M.</option>
                    <option <?php if($time == "7:00 P.M.") print " selected "; ?>
                        value='7:00 P.M.'>7:00 P.M.</option>
                    <option <?php if($time == "8:00 P.M.") print " selected "; ?>
                        value='8:00 P.M.'>8:00 P.M.</option>
                    <option <?php if($time == "9:00 P.M.") print " selected "; ?>
                        value='9:00 P.M.'>9:00 P.M.</option>
                    <option <?php if($time == "10:00 P.M.") print " selected "; ?>
                        value='10:00 P.M.'>10:00 P.M.</option>
                    <option <?php if($time == "11:00 P.M.") print " selected "; ?>
                        value='11:00 P.M.'>11:00 P.M.</option>
                    <option <?php if($time == "12:00 A.M.") print " selected "; ?>
                        value='12:00 A.M.'>12:00 A.M.</option>
                </select>
            </p>
        </fieldset>
        
            <fieldset class="button">
                <legend></legend>
                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register" >
            </fieldset>
        </form>
    
<?php
    } // end body submit
?>
    
</article>

<?php include "footer.php"; ?>

</body>
</html>
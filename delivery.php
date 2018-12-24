<fieldset class="delivery">
    <legend>Delivery Address Information</legend>
    <p>
        <label class="required text-field" for ="txtAddress">Street Address:</label>
        <input
        <?php if ($addressERROR) print 'class="mistake"'; ?>
            id ="txtAddress"
            maxlength="25"
            name="txtAddress"
            onfocus="this.select()"
            placeholder="Enter your street address"
            tabindex="530"
            type="text"
            value="<?php print $address; ?>"
            >
    </p>

    <p>
        <label class="required text-field" for ="txtCity">City/ Town:</label>
        <input
        <?php if ($cityERROR) print 'class="mistake"'; ?>
            id="txtCity"
            maxlength="25"
            name="txtCity"
            onfocus="this.select()"
            placeholder="Enter your city/ town"
            tabindex="540"
            type="text"
            value="<?php print $city; ?>"
            >
    </p>

    <p>
        <label class="required text-field" for ="txtState">State:</label>
        <input
        <?php if ($stateERROR) print 'class="mistake"'; ?>
            id="txtState"
            maxlength="25"
            name="txtState"
            onfocus="this.select()"
            placeholder="Enter your state"
            tabindex="550"
            type="text"
            value="<?php print $state; ?>"
            >
    </p>

    <p>
        <label class="required text-field" for ="txtZipCode">Zip Code:</label>
        <input
        <?php if ($zipCodeERROR) print 'class="mistake"'; ?>
            id="txtZipCode"
            maxlength="25"
            name="txtZipCode"
            onfocus="this.select()"
            placeholder="Enter your zip code"
            tabindex="560"
            type="text"
            value="<?php print $zipCode; ?>"
            >
    </p>

</fieldset>
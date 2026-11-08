
<div class="field">
    <label for="surname">Surname</label>
    <input type="text" id="surname" name="surname" size="31"
        value="<?php echo htmlspecialchars($_POST['surname'] ?? ''); ?>">

    <?php
    if (isset($errors['surname'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['surname']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" size="31"
        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

    <?php
    if (isset($errors['email'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['email']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" size="31">

    <?php
    if (isset($errors['password'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['password']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <label for="street_address">Street Address</label>
    <textarea id="street_address" name="street_address" rows="3" cols="22"><?php echo htmlspecialchars($_POST['street_address'] ?? ''); ?></textarea>

    <?php
    if (isset($errors['street_address'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['street_address']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <label for="state">State</label>
    <select id="state" name="state">
        <?php
        $states = [
            "-1" => "[Choose Your State]",
            "1" => "Australian Capital Territory",
            "2" => "Queensland",
            "3" => "Victoria",
            "4" => "New South Wales",
            "5" => "Tasmania",
            "6" => "South Australia",
            "7" => "Western Australia",
            "8" => "Northern Australia"
        ];

        foreach ($states as $value => $name) {
            $selected = (($_POST['state'] ?? '-1') == $value) ? 'selected' : '';
            echo "<option value='$value' $selected>$name</option>";
        }
        ?>
    </select>

    <?php
    if (isset($errors['state'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['state']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <input type="hidden" name="country" value="Australia">

    <?php
    if (isset($errors['country'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['country']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <label>Gender</label>

    <input type="radio" name="gender" value="male"
        <?php if (($_POST['gender'] ?? '') == 'male') echo 'checked'; ?>>
    Male

    <input type="radio" name="gender" value="female"
        <?php if (($_POST['gender'] ?? '') == 'female') echo 'checked'; ?>>
    Female

    <?php
    if (isset($errors['gender'])) {
        echo '<span style="color:red">' . htmlspecialchars($errors['gender']) . '</span>';
    }
    ?>
</div>

<div class="field">
    <label for="vegetarian">Vegetarian</label>
    <input type="checkbox" id="vegetarian" name="vegetarian"
        <?php if (isset($_POST['vegetarian'])) echo 'checked'; ?>>
</div>

<div class="field">
    <label>&nbsp;</label>
    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</div>

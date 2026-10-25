
<?php
function validateName(&$errors, $field_list, $field_name) {
    $pattern = "/^[a-zA-Z'-]+$/";

    if (!isset($field_list[$field_name]) ||
        trim($field_list[$field_name]) == '') {
        $errors[$field_name] = 'Nama wajib diisi';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Nama hanya boleh berisi huruf, tanda petik, dan tanda hubung';
    }
}

function validateEmail(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) ||
        trim($field_list[$field_name]) == '') {
        $errors[$field_name] = 'Email wajib diisi';
    } else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'Format email tidak valid';
    }
}

function validatePassword(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) ||
        $field_list[$field_name] == '') {
        $errors[$field_name] = 'Password wajib diisi';
    } else if (strlen($field_list[$field_name]) < 8) {
        $errors[$field_name] = 'Password minimal 8 karakter';
    }
}

function validateAddress(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) ||
        trim($field_list[$field_name]) == '') {
        $errors[$field_name] = 'Alamat wajib diisi';
    }
}

function validateState(&$errors, $field_list, $field_name) {
    $validStates = ['1', '2', '3', '4', '5', '6', '7', '8'];

    if (!isset($field_list[$field_name]) ||
        $field_list[$field_name] == '-1') {
        $errors[$field_name] = 'Silakan pilih state';
    } else if (!in_array($field_list[$field_name], $validStates, true)) {
        $errors[$field_name] = 'State tidak valid';
    }
}

function validateGender(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = 'Silakan pilih gender';
    } else if (!in_array($field_list[$field_name], ['male', 'female'], true)) {
        $errors[$field_name] = 'Gender tidak valid';
    }
}

function validateCountry(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) ||
        $field_list[$field_name] !== 'Australia') {
        $errors[$field_name] = 'Negara tidak valid';
    }
}
?>

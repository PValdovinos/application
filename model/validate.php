<?php

// Return true if name is all alphabetic and at least 2 characters long
function validName($name)
{
    return ctype_alpha($name) && strlen(trim($name)) >= 2;
}

// Return true if email address is valid
function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Return true if phone number is valid (numeric and optional specific format)
function validPhone($phone)
{
    // Check if phone number contains only digits and is 10 digits long
    return preg_match("/^[0-9]{10}$/", $phone);
}

// Return true if years of experience is a valid numeric value
function validExperience($experience)
{
    return is_numeric($experience);
}

// Return true if GitHub URL is valid
function validGithub($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

# FVSS - Form Validation Server-Side for PHP

FVSS (Form Validation Server-Side) is a PHP library designed to streamline and simplify the process of server-side form validation. It offers a comprehensive set of validation functions catering to common input data types found in web forms. FVSS ensures that the data submitted by users adheres to predefined criteria, enhancing the security and reliability of form submissions.

## Features

- **Validation Types:**
  - `alphanum` (Alphabet & Numeric)
  - `alpha`
  - `num`
  - `date`
  - `email`
  - `url`
  
- **Additional Parameters:**
  - `space`: Allowing or disallowing spaces in the input.
  - `length`: Specifying the minimum length for certain types of validation.
  - `punct`: Allowing or disallowing punctuation marks in the input.

## Installation

Install FVSS using Composer:

```bash
composer require refkinscallv/fvss
```

## Usage Example

```php
<?php

/**
 * Preparation
 */

// Import FVSS classes into the global namespace
use CG\FVSS\Fvss;

// Load composer autoloader
require "path/to/folder/Fvss.php";

/**
 * How To Use
 */

$fvss = new Fvss(); // or $fvss = new \CG\FVSS\Fvss();

// Example of a request for validation
$req = [
    [
        "value"   => "Jhon Doe",
        "label"   => "Name",
        "type"    => "alpha",
        "length"  => false,
        "space"   => true,
        "punct"   => false,
    ], [
        "value"   => "0888888888",
        "label"   => "Phone Number",
        "type"    => "num",
        "length"  => 10, // minimum length
        "space"   => false,
        "punct"   => false,
    ], [
        "value"   => "2000-02-09",
        "label"   => "Date of Birth",
        "type"    => "date",
        "length"  => false,
        "space"   => false,
        "punct"   => false,
    ], [
        "value"   => "mail@mail.com",
        "label"   => "Email",
        "type"    => "email",
        "length"  => false,
        "space"   => false,
        "punct"   => false,
    ], [
        "value"   => "https://www.facebook.com",
        "label"   => "Social Media URL",
        "type"    => "url",
        "length"  => false,
        "space"   => false,
        "punct"   => false,
    ]
];

// Validation process
$validate = $fvss->validate($req);

// Output of the validation process is a boolean: true or false
// If the output is false, then the $validate->message object variable will have the value of the error message
if ($validate->status) {
    echo "So far so good";
} else {
    echo $validate->message;
}
```
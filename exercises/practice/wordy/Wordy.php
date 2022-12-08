<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

// declare(strict_types=1);

function calculate(string $input): int
{
    preg_match_all('/([a-zA-Z ]+)([-\d]+)?/', $input, $matches);
    $digits = $matches[2];  // matches[0] whole statement, matches[1] first bit of text, matches[2] number to evaluate
    print_r($matches);
    
    if(empty($digits[0])) {
        echo 'Invalid input';
    }

    $running_total = 0;
    for ($i = 0; $i < count($digits); $i++) {
        $val = $digits[$i];
        if ($i === 0) {
            $running_total = $val;
            continue;
        }
        $operation = $matches[1][$i]; // looks at operational statement at index i in $digits
        // matches index 0 => whole statement, @index 1 = middle text, @index 2 the numbers
        // echo $matches[1][$i];
        switch ($operation) {
            case ' plus ':  // 'plus' !== ' plus '
                $running_total += $val;
            break;
            case ' minus ':
                $running_total -= $val;
            break;
            case ' multiplied by ':
                $running_total = $running_total * $val;
            break;
            case ' divided by ':
                $running_total = $running_total / $val;
            break;
        }
    }
    echo $running_total;
    return $running_total;
}

calculate('What is 5 plus 7 multiplied by 18 divided by 9 minus 10');
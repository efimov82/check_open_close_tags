<?php

/**
 * Check string for correct open and close pairs 
 * Support pairs: (), {}, [], <>
 *
 * @param string $str
 * @return bool | trow Exception
 */
function checkString($str) {
  if (!$str)
    return true;

  $stack = [];
  $pairs = [ '(' => ')',
            '[' => ']',
            '{' => '}',
            '<' => '>',
            ];
 
    $str = (string)$str;
 
    for ($i = 0; $i < strlen($str); $i++) {
        $ch = $str[$i];
        switch ($ch) {
            case '(':
            case '[':
            case '{':
            case '<':
                array_push($stack, $pairs[$ch]);
            break;
 
            case ')':
            case ']':
            case '}':
            case '>':
                if (!$stack) {
                    throw new Exception('Find close tag"' . $ch . '", but not find open tag');
                }
 
                if ($ch != end($stack)) {
                    throw new Exception('Waiting "' . end($stack) . '", but find "' . $ch . '"');
                }
 
                array_pop($stack);
        }
    }
 
    if ($stack) {
        throw new Exception('Not closed tags: "' . join('", "', array_reverse($stack)) . '"');
    }
 
    return true;
}

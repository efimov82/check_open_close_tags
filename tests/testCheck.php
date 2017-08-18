<?php

/*
 * Test cases
 */

require_once __DIR__ . '/../simpletest/autorun.php';
include __DIR__.'/../functions.php';

class TestCheckFunction extends UnitTestCase {
  
  function TestEmptyString() {
    $res = checkString('');

    $this->assertEqual($res, true);
  }

  function TestSimpleString() {
    $res = checkString('tesdt string');

    $this->assertEqual($res, true);
  }

  function TestNotCloseTag() {
    try {
      $res = checkString('test [string');
      
    } catch(Exception $e) {
      $this->assertEqual($e->getMessage(), 'Not closed tags: "]"');
    }
  }

  function TestNotOpenTag() {
    try {
      $res = checkString('test string)');
      
    } catch(Exception $e) {
      $this->assertEqual($e->getMessage(), 'Find close tag")", but not find open tag');
    }
  }

  function TestCorrectStringTag() {
    $res = checkString('[t<es>t (string)]');
    $this->assertEqual($res, true);      
    
  }

}

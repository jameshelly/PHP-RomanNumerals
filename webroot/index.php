<?php
/**
 * Roman Numerals Exercise
 * romannumerals.bbc.local
 * openTag/RomanNumeral
 *
 * @category   openTag, RomanNumeral
 * @package    RomanNumeral 
 * @copyright  Copyright (c) 2013 openTag
 * @license    ?
 */
 
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set("display_errors", false);

//Statics.

// include '..'. DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'RomanNumeral' . DIRECTORY_SEPARATOR . 'RomanNumeral.php';
include '../library/_autoload.php';

use RomanNumeral\RomanNumeral as RomanNumeral;

//No POST / GET SUPERGLOBAL AutoGeneration.
$posted = array();
parse_str($HTTP_RAW_POST_DATA, $posted);
$conversion = str_replace("submit=Submit","", $posted["conversion"]);
// $conversion

$RomanNumeral = new RomanNumeral($conversion);
?><!DOCTYPE html>
<html>
  <head>
    <title>Roman Numerals Exercise</title>
  </head>
  <body>
    <header>
      <h2>Roman Numeral Conversion</h2>
    </header>
    <section class="main">
      <article>
        <p>Type either a Numeric Value or a Roman Numeral</p>
        <form action="" enctype="text/plain" method="post">
          <fieldset>
            <label for="conversion">Value:
              <input type="text" id="conversion" name="conversion" value="<?php echo $conversion; ?>" placeholder="Enter value (Roman or Numeric)" />
            </label>
            <label for="submit">Get Conversion:
              <input type="submit" id="submit" name="submit" value="Submit" />
            </label>
          </fieldset>
        </form>
      </article>
    </section>
    <aside>
      <h2>Results section</h2>
      <p><?php if($conversion!=''){ echo $RomanNumeral->execute(); } ?></p>
    </aside>
    <footer>
      <p>Copyright 2013 James A Helly</p>
    </footer>
  </body>
</html>

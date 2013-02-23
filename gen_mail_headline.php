<?php
/**
 * Generates a Daily Mail headline.
 * 
 * @author Damien Walsh <me@damow.net>
 * @version 1.0
 * @package dm
 */
/**
 * Generate a headline worthy of appearance in "The Daily Mail"
 *
 * @return string A viciously right-wing headline.
 */
function gen_dm_headline()
{
  // ------------------------------------------------------
  // Load the "sadface" database...
  // ------------------------------------------------------
  $sads = (array)json_decode(file_get_contents('sads.json'));

  // Convert to array
  foreach($sads as $key => & $value)
  {
    $sads[$key] = (array)$value;
  }

  // ------------------------------------------------------
  // Randomise
  // ------------------------------------------------------
  shuffle($sads['victims']);
  shuffle($sads['badguys']);
  shuffle($sads['forms']);
  shuffle($sads['ailments']);
  shuffle($sads['quotes']);
  shuffle($sads['materials']);
  shuffle($sads['objects']);
  shuffle($sads['badsynonyms']);

  // ------------------------------------------------------
  // Perform replacements
  // ------------------------------------------------------
  $form = current($sads['forms']);
  $form = str_replace('%victim', strtoupper(current($sads['victims'])), $form);
  $form = str_replace('%badguy', ucfirst(current($sads['badguys'])), $form);
  $form = str_replace('%mat', current($sads['materials']), $form);
  $form = str_replace('%object', strtoupper(current($sads['objects'])), $form);
  $form = str_replace('%quote', ucfirst(current($sads['quotes'])), $form);
  $form = str_replace('%ailment', ucfirst(current($sads['ailments'])), $form);
  $form = str_replace('%lowrand', rand(2, 15), $form);
  $form = str_replace('%badsynonym', strtoupper(current($sads['badsynonyms'])), $form);

  return $form;
}

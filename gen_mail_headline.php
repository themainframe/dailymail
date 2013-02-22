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
    $sads[$key] = (array)$value;

  // ------------------------------------------------------
  // Define the extremely limited set of writing styles...
  // ------------------------------------------------------
  $sads['forms'] = array(
    'Inside %badguy\'s secret %mat den: scam leaves %victim out of pocket by £100,000',
    '"%quote" - %victim suffers at the hands of loud-mouth %badguy',
    'The sad story of the %victim with %ailment: %badguy denies compensation payoff.',
    '%badguy kills %lowrand people in surprise attack: %victim tells their story.',
    '%victim killed on their way home - %badguy still at large',
    "New research says: %objects now cause %ailment",
    "%objects linked to rise in %ailments. %victim outraged!"
  );

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

  // ------------------------------------------------------
  // Perform replacements
  // ------------------------------------------------------
  $form = current($sads['forms']);
  $form = str_replace('%victim', strtoupper(current($sads['victims'])), $form);
  $form = str_replace('%badguy', ucfirst(current($sads['badguys'])), $form);
  $form = str_replace('%mat', current($sads['materials']), $form);
  $form = str_replace('%object', current($sads['objects'], $form));
  $form = str_replace('%quote', ucfirst(current($sads['quotes'])), $form);
  $form = str_replace('%ailment', ucfirst(current($sads['ailments'])), $form);
  $form = str_replace('%lowrand', rand(2, 15), $form);

  return $form;
}


print gen_dm_headline();
<?php
function sanitize($input)
{
  return htmlspecialchars(trim((string)$input), ENT_QUOTES, 'UTF-8');
}

function parseDate($value)
{
  if (empty($value)) {
    return null;
  }
  $date = DateTime::createFromFormat("Y-m-d", (string)$value);
  return ($date && $date->format("Y-m-d") === $value) ? $value : null;
}
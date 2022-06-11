<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class OrderSettings extends Settings
{
  public array $appointement_days;
  public string $appointement_start;
  public string $appointement_end;

  public static function group(): string
  {
    return 'order';
  }
}

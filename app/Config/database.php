<?php
if (env('RLHZRD_ENV') === null) {
  config('Database/production');
} else {
  config('Database/' . env('RLHZRD_ENV'));
}

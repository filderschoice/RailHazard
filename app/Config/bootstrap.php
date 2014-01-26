<?php
if (env('RLHZRD_ENV') === null) {
  config('Bootstrap/production');
} else {
  config('Bootstrap/' . env('RLHZRD_ENV'));
}

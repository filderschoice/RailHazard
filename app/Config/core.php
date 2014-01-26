<?PHP

if (env('RLHZRD_ENV') === null) {
  config('Core/production');
} else {
  config('Core/' . env('RLHZRD_ENV'));
}


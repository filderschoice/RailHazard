<?php
echo 'please input string: ';
$stdin = fgets(STDIN,4096);
 
// salt
$salt = sha1($stdin);
 
// seed
$seed = '';
for ($i = 0; $i < 30; $i++) {
    $seed .= mt_rand(0, 9);
};
 
echo "**************************************\n";
echo sprintf("Security.salt:       %s\n", $salt);
echo sprintf("Security.cipherSeed: %s\n", $seed);
echo "**************************************";

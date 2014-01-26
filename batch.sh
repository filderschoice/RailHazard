#!/bin/sh
echo '*' > app/tmp/.gitignore
echo '*' > app/tmp/cache/.gitignore
echo '*' > app/tmp/cache/models/.gitignore
echo '*' > app/tmp/cache/persistent/.gitignore
echo '*' > app/tmp/cache/views/.gitignore
echo '*' > app/tmp/logs/.gitignore
echo '*' > app/tmp/sessions/.gitignore
echo '*' > app/tmp/tests/.gitignore
git add -f app/tmp/.gitignore app/tmp/cache/.gitignore 
git add -f app/tmp/cache/models/.gitignore 
git add -f app/tmp/cache/persistent/.gitignore 
git add -f app/tmp/cache/views/.gitignore 
git add -f app/tmp/logs/.gitignore 
git add -f app/tmp/sessions/.gitignore 
git add -f app/tmp/tests/.gitignore

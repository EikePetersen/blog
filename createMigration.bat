@echo off

php bin/console doctrine:migrations:diff
pause
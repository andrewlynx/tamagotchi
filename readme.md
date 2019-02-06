Test task: Simple tamagotchi-like game on Laravel

For correct pet lifecycle you need to add cron task:

* * * * * php /var/www/tamagotchi/artisan schedule:run >> /dev/null 2>&1

where /var/www/tamagotchi/ is path to project
# Tamagotchi on Laravel
### Test task: Simple tamagotchi-like game on Laravel

## Installation
1. Project cloning
2. Updating composer
3. Updating npm and make it run for dev or production
4. Copy .env file and set MySQL and Pusher creds
5. Run db migration
6. Generate app key
7. For correct pet lifecycle you need to add cron task:

`* * * * * php /var/www/tamagotchi/artisan schedule:run >> /dev/null 2>&1`

where /var/www/tamagotchi/ is path to project
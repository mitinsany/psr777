## Solution for test task

### Prepare environment
Install composer dependencies by command
```bash
composer install
```
Copy `.env.example` file to `.env` by command
```bash
cp .env.example .env
```

and add you exchange rates api key at end of first line, after `access_key=`
### Starting application
You can start application by command
```bash
php app.php input.txt
```
and get output some like it:
```
1
0.5
200
2.6
20
```
### Starting tests
You cant start tests by command
```bash
composer tests
```
and get
```
> vendor/bin/phpunit tests
PHPUnit 11.2.6 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.21

......                                                              6 / 6 (100%)

Time: 00:00.018, Memory: 8.00 MB

OK (6 tests, 6 assertions)

```

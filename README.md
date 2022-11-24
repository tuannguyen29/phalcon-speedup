# Phalcon Speedup CMS Application

[Phalcon][1] is a web framework delivered as a C extension providing high
performance and lower resource consumption.

Phalcon Speedup CMS - open source content management system (CMS). Written in
Phalcon PHP Framework (version 5.x supported).
Please write us if you have any feedback.

Thanks.

## NOTE

The master branch will always contain the latest stable version. If you wish
to check older versions or newer ones currently under development, please
switch to the relevant branch.

## Get Started

### Requirements

* PHP >= 7.4
* [Apache][2] Web Server with [mod_rewrite][3] enabled or [Nginx][4] Web Server
* Latest stable [Phalcon Framework release][5] extension enabled
* [MySQL][6] >= 5.7

### Installation

1. Copy project to local environment - `git clone git@github.com:tuannguyen29/phalcon-speedup.git`
2. Copy file `cp .env.example .env`
3. Edit .env file with your DB connection information

### Migrations

1. Show list `vendor/bin/phalcon-migrations list --config=migrations.php`
2. Generate `vendor/bin/phalcon-migrations generate --config=migrations.php`
3. Run create db `vendor/bin/phalcon-migrations migration run --config=migrations.php`


## License

Invo is open-sourced software licensed under the [New BSD License][8]. © Phalcon Framework Team and contributors

[1]: https://phalcon.io/
[2]: http://httpd.apache.org/
[3]: http://httpd.apache.org/docs/current/mod/mod_rewrite.html
[4]: http://nginx.org/
[5]: https://github.com/phalcon/cphalcon/releases
[6]: https://www.mysql.com/
[7]: https://github.com/phalcon/invo/blob/master/CONTRIBUTING.md
[8]: https://github.com/phalcon/invo/blob/master/docs/LICENSE.md
[9]: https://docs.docker.com/engine/install/
[10]: https://docs.docker.com/compose/install/

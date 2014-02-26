# Webstalk

Webstalk is a simple web app for viewing [beanstalkd](https://github.com/kr/beanstalkd)
server and tube statistics.

At [PMG](http://pmg.co) we use a lot of beanstalkd and we needed to give our
non-technical people a way to check on queue server stats that didn't involve
telnet. Webstalk serves that purpose.

There are two ways to use webstalk: as a stand alone app or as a library. In
both cases webstalk requires PHP 5.4+ and [composer](https://getcomposer.org/).

Additionally, webstalk uses...

- Silex
- Twig
- Pheanstalk
- The Symfony Twig Bridge

## Stand Alone App

[Bower](http://bower.io/) is required to grab our UI dependencies (JS & CSS
files).

1. Clone this repository or grab it's zip file and extract it
1. Navigate to the directory where the Webstalk files are
1. Run `composer install`
1. Run `bower install`
1. Ensure that your beanstalkd server is running
1. `php -S 127.0.0.1:8005 -t web` to run the app (or set up your server)

## As a Library

Add `pmg/webstalk` to your `composer.json` and install. See `web/index.php` for
an example of the required service providers and how to mount the webstalk URLs.

If you intend to use webstalks built in styling, please be aware that it expects
some static files in your document root's `vendor` folder as if they were
installed by bower. See `bower.json` for those dependencies.

More likely, however, you'll want to integrate webstalk in your larger
application -- this is how PMG uses it.

Webstalk uses twig, and it registers a directory in Silex's `twig.loader.filesystem`
just for its files. To use your own templates, extend `twig.loader.filesystem`
and prepend a new webstalk directory.

    $app['twig.loader.filesystem'] = $app->share(
        $app->extend('twig.loader.filesystem', function ($loader) {
            $loader->prependPath('/path/to/your/templates/webstalk', 'webstalk');
            return $loader;
        })
    );

Once that's done, create a `servers.html.twig` and a `tubes.html.twig` file in
your new webstalk templates directory. See `src/PMG/Webstalk/Resources/views`
for how those files might work and to get an idea of the context variables
passed in.

## Running the Tests

Webstalk has two sets of tests: unit and integration. Unit tests cover all of
its internal code. Integration tests cover the areas where webstalk touches the
outside world (this includes external libraries, which are wrapped up in adapters).

Composer install with `--dev` flag (the default behavior). Then run
`/vendor/bin/phpunit`. This will run both test suites.

You'll probably see some tests skipped, those are tests that require a local
copy of beanstalkd running. So start it up! If it's running on localhost with
the default port (11300), that's all you'll need to do: just run the tests again.

If not, set the `BEANSTALKD_HOST` and `BEANSTALKD_PORT` environment variables
and running the tests.

    $ BEANSTALKD_PORT=11301 ./vendor/bin/phpunit

You can also just run a single test suite:

    $ ./vendor/bin/phpunit --testsuite Unit
    $ ./vendor/bin/phpunit --testsuite Integration

# Requirements summary

You need the following on your system to run the build commands described later.

1. [Phing](http://www.phing.info/)
2. [phpDocumentor2](http://www.phpdoc.org/)
3. [CURL](http://curl.haxx.se/) binaries (not a PHP extension, but a real one).

# Building instructions

Build is being made by [Phing](http://www.phing.info), which you should have installed in your machine.
All build targets are described in the `build.xml` config.
Build configuration resides in the `build.properties` config.
It contains a definitions of pathnames in case we change project structure someday and the current project version.

## Packaging a distributive

Distributive is an archived bundle of all source files which end-user can install to his own application.
Files included in the distrib are currently contents of `src` directory and README, CHANGELOG and INSTALL
auxiliary documents.

Release is made by issuing `phing dist` or simply `phing` from the root of codebase.
If you don't have a special property named _project.version_ in the `build.properties` config,
then you'll be prompted for the value of it.

Packed distributive will be placed into the `dist` subdirectory as a ZIP archive as a lowest common denominator
and be signed with current project version specified.

## Generating a documentation

### API-level documentation

API is being documented by [phpDocumentor2](http://www.phpdoc.org/). You should install it yourself.

To generate an API-level documentation, you should issue `phing api` from the root of codebase.

Documentaion will be placed into the `doc/api` runtime folder in the codebase.
You can point your browser to the `doc/api/index.html` file in it to start reading.

### Annotated source code documentation

As an addition to the usual API docs, we have a means to make an annotated source code similar to [Docco](http://jashkenas.github.io/docco/).
In fact, it uses the [Pinnocchio](https://github.com/ncuesta/pinocchio) documentation generator which is the port of Docco.

To generate an annotated source code documentation, you should issue `phing annotated` from the root of codebase.
Please note that this command will make a lot of actions when launched in a clean codebase.
In short, before making use of Pinnocchio, it'll first check it's presence, and, if it's not available, then it'll be installed.

Documentation will be placed into the `doc/annotated` runtime folder in the codebase.
You can point your browser to the `doc/annotated/index.html` file in it to start reading.

## Installing and removing Composer

This project is Composer-ready and uses several libraries installable by it.

For convenience when you run any phing target which rely on the Composer-managed library it'll install everything needed automatically.

You can fetch Composer binary manually by issuing `phing install-composer`.

You can trigger Composer to install everything installable by Composer by issuing `phing install-composer-libraries`.
There's no way to install libraries separately, so e. g. if you want to run `phploc` and you have a totally clean codebase then Composer will fetch
`phploc` along with `phpunit` and `pinocchio` and `phpcpd`.
That's a shortcoming of Composer, just bear with it.

You can purge Composer and everything it installed by issuing `phing purge-composer` from the root of codebase.
It'll remove the Composer `vendor` directory along with everything installed in it and the `composer.phar` itself.

## Cleaning the codebase

You can clean all runtime directories which gets created by other build routines by issuing `phing clean` from the root of codebase.
For now it'll remove the `vendor`, `doc`, `reports` and `dist` directories from the codebase.
You can not bother creating them manually, build tasks create them themselves when needed.

## Running tests

We have a suite of automated unit tests now.
It's currently quite rudimentary, but number of tests is expected to be growing.

**WARNING: I SAID IT'S RUDIMENTARY, DO NOT RELY ON IT YET!**

To run all tests currently present in the project, you should issue `phing test` from the root of codebase.
It outputs test results to the console and generate a set of reports in the `./reports` runtime directory as well.

Note that this build target generates a global code coverage report accessible from `./reports/coverage/index.html`,
using which you can easily see which parts of codebase are uncovered.

Please note that PHPUnit instance which gets launched for tests is the one installed by Composer into the `vendor` directory,
not the systemwide one you can possibly have on your workstation.

## Getting static analysis of the codebase

You can check the [PHPLOC](https://github.com/sebastianbergmann/phploc) statistics by issuing `phing loc` from the root of codebase.

You can check the code style using [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) by issuing `phing cs` from the root of codebase.
Coding standard used for checking is [Yii](https://github.com/Ardem/yii-coding-standard) for now.

You can probe the codebase for duplicated code using [PHP Copy-Paste Detector](https://github.com/sebastianbergmann/phpcpd) by issuing `phing cpd` from the root of codebase.
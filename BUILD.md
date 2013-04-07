# Building instructions

Build is being made by [Phing](http://www.phing.info), which you should have installed in your machine.

## Making a release

Release is a archived bundle of all source files which end-user can install to his own application.
Files included in the release are currently contents of `src` directory and README, CHANGELOG, INSTALL and LICENSE
auxiliary documents.

Release is made by issuing `phing release` from the root of codebase.
If you don't have a special property named _project.version_ in the `build.properties` config,
then you'll be prompted for the value of it.

Complete release will be placed into the `dist` subdirectory as a ZIP archive as a lowest common denominator
and be signed with release version specified.

## Generating a documentation

### API-level documentation
API is being documented by [phpDocumentor2](http://www.phpdoc.org/). You should install it yourself.

To generate an API-level documentation, you should issue `phing api` from the root of codebase.

Documentaion will be placed into the `doc/api` runtime folder in the codebase.
You can point your browser to the `doc/api/index.html` file in it to start reading.

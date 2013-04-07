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

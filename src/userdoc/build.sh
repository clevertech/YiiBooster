# This will convert all XML documentation to PHP views which can be pasted to documentation website.
# This file is my (hijarian) system-bounded, so you need to change path to Saxon jar file yourself.
for path in ./*
do
    dir=`basename $path`
    if [ -d $dir ]
        then
          java -jar ~/systems/saxon/saxon9he.jar \
            -s:$dir/$dir.xml \
            -xsl:userdoc.php.xsl \
            -o:$dir/$dir.php && sed -i 's/<?xml version="1.0" encoding="UTF-8"?>//' $dir/$dir.php
    fi
done

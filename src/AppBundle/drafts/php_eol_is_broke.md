# PHP_EOL is Broken (Sometimes)

![php logo](/img/php.png "php logo")

### What is PHP_EOL?

Introduced in version 5.0.2 of php, `PHP_EOL` is a string constant that represents the correct end of line symbol for 
the platform that you are running php on.
So on Windows this should be set to `"\r\n"` (carriage return and line feed) and on a *nix system it should be set to
`"\n"` (only line feed).

### Where is it Used?
You **SHOULD** use it when programmatically creating a text file via php.

```php
$text = 'Line one' . PHP_EOL;
$text .= 'Line two' . PHP_EOL;
 
$file = fopen('file.txt', 'w');
fputs($file, $text);
fclose($file);
```
This will create a platform correct end of line separator, and ensure portability in a project.

### Okay, So How is it Broken?
Usually when one is working with strings that contain multiple lines and they want to create an array that consists of
each individual line they will use: 
```php
$array = explode(PHP_EOL, $string);
```
*However,* in the last couple of weeks I've been bitten by two different bugs caused by the very simple line of code above.

##### Bug #1
The first was when I was working on my [Web Log Viewer Bundle](https://github.com/eidsonator/WebLogViewerBundle) project
which is a [Symfony](https://symfony.com/) bundle for viewing log files created by a Symfony project online, so logging 
in to the server to view them in not necessary.  This project parses log files, formats the lines, and displays them
in an HTML table.  I was using `$array = explode(PHP_EOL, $string);`, but when running this on a Windows box, my string 
was not exploding correctly and I was getting `$array = [$string]` instead of `$array = [line1, line2, line3, ...]`. 

Symfony uses [monolog](https://github.com/Seldaek/monolog), and I didn't investigate how monolog writes its end of line
symbols in an attempt to determine the root cause of this bug, but I did need to find a fix.
*Help me stackoverflow, you're my only hope.*

##### Bug #2   
I've recently started using [Magallanes](http://www.magephp.com/) to deploy my projects, instead of my old hacky way of
using a git post commit hook to push my changes to a git repo on the production server and then logging in to the production
server and manually performing 5 or 6 steps to update dependencies, build assets, and clear caches. I did have to make 
a handful of really small changes to make it work in a Windows environment, but oh, man, was it worth it. Lots more on
how I improved my deployment process with Magallanes in later posts.

I mentioned that I had to make some changes to make Magallanes work in a Windows environment, and I thought that I had 
everything worked out until I noticed this next bug.  I use the "releases" option of Magallanes that uploads the current
release to a timestamp-based-name directory inside of the `releases` directory and then creates a symlink named `current`
that points to the newest directory in the `releases` folder.  In the Magallanes config file, there is a parameter named
`releases` that indicates the number of previous releases that should be kept on the server, in case there is a need to 
rollback to an earlier release.  I noticed that in one of my `releases` directory, there were about 10 previous releases,
when I had this configuration parameter set to 5.  Something was broken.

I went looking through the [cleanup task code](https://github.com/andres-montanez/Magallanes/blob/master/src/Task/BuiltIn/Deploy/Release/CleanupTask.php)
and discovered that it was using `ls -1` via ssh to get a string of all the directories inside of the `releases` directory
and then using my recent archnemesis `$releases = explode(PHP_EOL, trim($releases));` to turn that string into an array
and doing all the work on the array.  I was pretty confident that the bug was in the explode statment, due to my recent
experience with Bug #1.  After stepping through the code using xdebug, my hunch was confirmed, and I knew just where to 
find the fix.   


### The Fix
> Some people, when confronted with a problem, think "I know, I'll use regular expressions."
> Now they have two problems. -  Jamie Zawinski

After discovering Bug #1, I fired up my trusty google machine and went in search to a solution for this problem.
Sure enough, the first search result was a [stackoverflow answer](https://stackoverflow.com/a/5053394) that fixed the bug.
It was the following simple, one-line, cross-platform fix: 

*Replace:*
```php
$lines = explode(PHP_EOL, $str);
```
*With:*
```php
$lines = preg_split('/\n|\r\n?/', $str);
```

So, of course, I knew the perfect fix when I came across Bug #2, just a few short weeks later.

### Conclusion

Although I was more concerned with fixing the bugs than I was with finding the root cause of the bugs, which would have 
required I solve the riddle "when is the end of line not the end of the line?", I was able to implement a nice and easy
cross-platform solution and come to the conclusion that PHP_EOL is Broken (Sometimes).


  
# Editing Shared Libraries in PhpStorm with Composer and git

![Composer logo](/img/logo-composer-transparent4.png "Composer Logo")

## The "Old" Workflow

When I started my current position way back in the winter of 2013 as the sole Application Developer in a
corporate/enterprise environment, I was tasked with maintaining existing web applications, porting Visual Basic
apps into a web environment, as well as creating new applications.  Each of the php applications that I had inherited
had several shared dependencies that were maintained independently in their separate project directories.
Any bug that was found and fixed in one of these 'libraries' had to be copied manually to the other projects
that were using this library.  Seeing this as a clear violation of the DRY (don't repeat yourself) principle,
I decided to move the libraries into a central location that could be shared among the different projects via the 
php include path.  This approach worked fine, until I wanted to start introducing changes that broke backwards
compatibility for the benefit of one project.  It would break the other projects until they had been updated to 
use the newer version of the library.  (I was still using manual deployment, no unit testing, no frameworks, it was a
dark and dreary time.)

## Take Two

It was about this time that I realized that it would indeed be best to keep individual copies of the libraries 
with each project, to prevent the aforementioned problems with backwards compatibility breaking changes, but these
libraries needed to be managed from a central location.  I had recently convinced my manager that we should switch
from svn to git, and I thought that maybe using [git-submodule](https://git-scm.com/docs/git-submodule) would be 
the answer to the question of how to manage these dependencies.  It wasn't.  It was messy.  It was broken.  It was
the worst idea I had had in a long series of bad ideas in trying to tackle this problem.  It was also about this
time that I had realized that what I was trying to do was write my own framework.  I had a database connection library,
a library that auto-wired my templating engine, an ldap connection library... I needed to stop trying to reinvent the
wheel and just learn and use a real framework.  

## Composer to the Rescue

I decided to learn and implement the [Symfony Framework](https://symfony.com/).  Learning Symfony included learning
about [Composer](https://getcomposer.org/) which I was vaguely familiar with, but totally unaware of how powerful it is.
In hindsight I should have realized that a "Dependency Manager" was exactly what I needed to manage my dependencies.
I soon learned that I could include my own repositories in my projects via the Composer configuration.  Using this I
could make changes to my library inside of my project, copy these changes to my library repository, upload the changes
to my central repository and then get the changes in my other projects by using `composer update`.  This was a couple
extra steps than I wanted to take, but it was the workflow I had been looking for all along.

## Composer, git, and PhpStorm

I soon realized that when one includes a repository with a type of 'vcs' through composer, you not only get a copy
of the files in that project, you get a copy of the entire repo, up to and including the `.git` directory.  So basically
I could make changes to my repo from inside of my `vendor` directory and commit and push to my central repository
straight from there.  When I learned that I could inform my favorite IDE [PhpStorm](https://www.jetbrains.com/phpstorm/)
about these 'sub' repositories and commit and push directly from the user interface my current workflow was concreted
and perfected (for now).

## Steps to implement this process

- In the project's `composer.json` file add a `repositories` section pointing to your shared library.
- Add your repository as a dependency in the `require` section
  - This will also work if use [satis](https://github.com/composer/satis) to require your repositories

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:greenskies/WebLogViewerBundle.git"
        }
    ],
    "require": {
        // other dependencies
        "greenskies/web-log-viewer-bundle": "dev-master"
    }
}
```
- Open up the settings in PhpStorm via File > Settings or `ctrl + alt + s` (in Windows or Linux)
- Click on the `Version Control` tab

<p>
    <img src="/img/Settings.png" alt="PhpStorm Settings" title="PhpStorm" style="width: 100%">
</p>

- Click on the green `+` (plus sign) in the upper right hand corner of the dialog to add another vcs path
- Add the path to your library inside of your vendor folder - PhpStorm should select the `git` vcs type for you

![Add VCS Directory Mapping](/img/Add_VCS_Directory_Mapping.png "Add VCS Directory Mapping")

<p>
    <img src="/img/Add_VCS_Directory_Mapping.png" alt="Add VCS Directory Mapping" title="Add VCS Directory Mapping" style="width: 100%">
</p>


- Now, anytime you make any change to your shared library, you can select "git > Commit file" or "Commit Directory" to 
commit and push your changes!  (You can also use git from the command line/terminal from inside of shared library to commit & push)

Do you have any tips and tricks to integrate git, Composer, and PhpStorm into your worklow? If so, please share
them in the comments.

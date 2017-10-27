# Code Highlighting in HTML

![alt text](/img/computer_code.png "Highlighted Code")

I've been wanting to start blogging for quite some time now, and I figured there is no time like the present.
I am familiar with both [WordPress](https://wordpress.com) and [Drupal](https://www.drupal.org/), but I wanted to "roll my own" both for flexibility and as a learning experience.
Since this blog is  going to be code heavy, one thing that was really important to me was code highlighting in the display.
I really like the code highlighting on the [Symfony documentation pages](http://symfony.com/doc/current/setup.html), and I've used that in some of my own documentation pages,
however, that is using [Sphinx](http://www.sphinx-doc.org/en/stable/) and `.rst` files, which requires a compilation step. I was looking for a way to have markdown files parsed by a real-time HTML converter to give me syntax highlighted code in HTML.
That's how I discovered [highlightjs](https://highlightjs.org/).

*highlightjs* will take any code that inside of an element that has a class of `{language-name}`, `lang-{language-name}`, or `language-{language-name}`
and wrap keywords, built-ins, and strings/numbers in spans that have highlighting classes assigned to them.
There is a cdn version available that has support for 23 of the most popular languages that can be added to your project in
3 easy steps.

- First add the stylesheet to the `head` section of the HTML page.
```html
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
```

- Next add the JavaScript to the end of your `body` element.
```html
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
```

- Finally, after the JavaScript is loaded, fire off the `initHighlightingOnLoad()` function to add the formatting. 
```html
<script>hljs.initHighlightingOnLoad();</script>
```

Now that the css and JavaScript is loaded and the OnLoad function is taken care of, we can throw some code at it to be
highlighted.

- In a markdown file, any text that is encased in triple backticks will be treated as code upon parsing, the language
can be added after the opening set of backticks.  If the language is not present *highlightjs* will make a best guess 
to which language it is. 

````markdown
```javascript
    var s = "JavaScript syntax highlighting";
    window.alert(s);
    var num = 42;
```
````

- The parsed HTML will appear as such.  *The class is derived from the language appended to the triple backticks in the above step*
(This will also work on raw HTML written as below, if it is not being parsed from a markdown file)

```html
<pre>
    <code class="language-javascript">
        var s = "JavaScript syntax highlighting";
        window.alert(s);
        var num = 42;
    </code>
</pre>
```

- The highlighted results of the parsed markdown will appear like this:

```javascript
var s = "JavaScript syntax highlighting";
window.alert(s);
var num = 42;
```

It is really quite simple to implement this powerful code highlighting library, and if the 23 languages included in the
hosted version don't cover a particular language that you need to highlight you can go to their [download](https://highlightjs.org/download/)
page to build a custom version which can include support for any of 176 different languages, which is what I'll be switching
to as soon as I write my first post that requires highlighting for the twig templating language.



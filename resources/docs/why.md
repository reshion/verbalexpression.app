## Why?

There are so many developers coding real world apps without knowing how to build a simple regular expression.

With [VerbalExpression](http://verbalexpressions.github.io/) the coders have tried to solve this problem programmatically 
and sure many developers around the world are using the library converted for the various programming languages.

This application is based on VerbalExpressionPHP and aims to make the generation of regular expressions 
available for everyone.

> Verbalise your expression and speak your pattern loud in your head. The rest is magic.

### Example

Maybe the described goal clarifies with a simple example.

For this example we want to build an regular expression to validate an input against an URL-pattern.

Let us note the pattern for a valid url below. 

`Start of Line` `then` 'http' `maybe` 's' `then` '://' `maybe` 'www.' `anything but` [space] `End of Line`
    
With the VerbalExpressionPHP Library it's an ease to generate this regular expression programmatically,
but maybe there is the case, I don't want to code a single line to get this regex. There are two options for this.

> Create the regular expression by yourself

or

> Use this application.


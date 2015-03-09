## Exceptions

* [Introduction](#Introduction)
* [ValidationException](#ValidationException)
* [InvalidArgumentException](#InvaliArgumentException)
* [KeywordNotFoundException](#KeywordNotFoundException)
* [RegexException](#RegexException)

### Introduction{#Introduction} 

When communicating with the integrated API you may encounter some exceptions. Possibles exceptions are listed below.
All exceptions extends the base exception class `VerbalExpressionException`.

Exceptions are returned as JSON and always returns the HTTP Response Code `500`

### ValidationException{#ValidationException}
The ValidationException throws when you pass parameters to the API which not match the specific criteria. For example, if you not pass the required parameters.

The `message_internal`property of the exception object provides detailed information.

*Example*

````
    'type' => 'danger',
    'code' => 0,
    'exception' => 'ValidationException',
    'message' => 'The validation for provided input failed',
    'message_internal' => [
            'expression' => ['The expression field is required']
        ],
    'more_info' => ''
```

### InvalidArgumentException{#InvalidArgumentException}
The InvalidArgumentException throws when the provided input passed the main validation process, but an error occurred by handling the given data.

**Note:** `message_internal is optional

*Example*
````
    'type' => 'danger',
    'code' => 0,
    'exception' => 'InvalidArgumentException',
    'message' => "Arguments for keyword range are invalid: Number of args must be even",
    'message_internal' => '',
    'more_info' => ''
```

### KeywordNotFoundException{#KeywordNotFoundException}
The KeywordNotFoundException throws when an non-existing keyword is passed. The API is unable to resolve one or more passed keywords.
 
Please have a look at the keyword section.

*Example*
````
    'type' => 'danger',
    'code' => 0,
    'exception' => 'KeywordNotFoundException',
    'message' => "The given Keyword doesn't exist!",
    'message_internal' => '',
    'more_info' => ''
```

### RegexException{#RegexException}
The RegexExceptions throws when something is wrong with the transmitted regular expression, because something went wrong passing your arguments to the internal PHP functions like `preg_match()`.

*Example*

````
    'type' => 'danger',
    'code' => 0,
    'exception' => 'RegexException',
    'message' => "The regular expression is invalid.",
    'message_internal' => "preg_match(): No ending delimiter '/' found",
    'more_info' => ''
```

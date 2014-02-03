Form Fields object lass library
=================================

This library provides the ability to create form and element objects programatically using OO.

Notes:
================================

If you are using xedbug and have large collections of child objects, you may need to add this into your php.ini:
`
xdebug.max_nesting_level=200
`
This is because of the amount of recursion necessary to render parent/child objects so the amount of function calls may exceed the default amount.

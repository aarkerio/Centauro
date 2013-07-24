
This is the GeSHi plugin for CKEditor!

It enables you to add output from the awesome GeSHi hightlighting class to your posts using CKEditor.

For a quick example :
Copy the folder GeSHi into the CKEditor plugins directory
Copy the files index.php and GeSHiConfig into the CKEditor directory
Visit the ckeditor folder on your php enabled server.

You will need a copy of GeSHi and it can be found here :
http://qbnz.com/highlighter/

A huge big fat WARNING!
The file GeSHi/dialogs/dialog.php is an example. You should adapt that file to your own needs especially for security.
Under no circumstances must you enable this plugin for use by untrusted users without first securing the code in dialog.php.
You would need to validate the input, prevent get bombs, etc for example.

To add this plugin to your existing CKEditor configuration, you would add :

config.extraPlugins = 'GeSHi';

to your CKEDITOR.editorConfig function (Usually found in config.js) and you also need to add a toolbar entry named
strangely enough : 'GeSHi'
to your CKEDITOR.editorConfig function. Investigate GeSHiConfig.js for an example.

This plugin is licensed under the gnu gpl v3 and comes with absolutely no support or warranty of any kind.

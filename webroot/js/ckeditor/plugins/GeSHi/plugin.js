// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @file GeSHi Syntax Highlighter
 */

/* Register a plugin named "GeSHi". */
CKEDITOR.plugins.add( 'GeSHi',
{

	requires: [ 'iframedialog' ],
	lang : [ 'en' ],

	init : function( editor )
	{

		var pluginName = 'GeSHi';

		/* Register the dialog. */
		CKEDITOR.dialog.addIframe('GeSHiDialog', 'GeSHi Parser',this.path + 'dialogs/dialog.php',500,300,function(){ /* oniframeload */ })

		var command = editor.addCommand( 'GeSHi', new CKEDITOR.dialogCommand( 'GeSHiDialog' ) );
		command.modes = { wysiwyg:1, source:1 };
		command.canUndo = false;

		/* Set the language and the command */
		editor.ui.addButton( 'GeSHi',
			{
				label : editor.lang.langGeSHi.label,
				command : pluginName,
				icon: this.path + 'GeSHi.gif'
			});

	},

})


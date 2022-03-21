<button title="Bold" type="button" onclick="doRichEditCommand('bold')"><i class="fad fa-bold"></i></button>
<button title="Italic" type="button" onclick="doRichEditCommand('italic')"><i class="fad fa-italic"></i></button>
<button title="Underline" type="button" onclick="doRichEditCommand('underline')"><i class="fad fa-underline"></i></button>
<button title="Strikethrough" type="button" onclick="doRichEditCommand('strikeThrough')"><i class="fad fa-strikethrough"></i></button>
<!--<button title="Subscript" type="button" onclick="doRichEditCommand('subscript')"><i class="fad fa-subscript"></i></button>
<button title="Superscript" type="button" onclick="doRichEditCommand('superscript')"><i class="fad fa-superscript"></i></button>-->

<button title="Left" type="button" onclick="doRichEditCommand('justifyLeft')"><i class="fad fa-align-left"></i></button>
<button title="Center" type="button" onclick="doRichEditCommand('justifyCenter')"><i class="fad fa-align-center"></i></button>
<button title="Right" type="button" onclick="doRichEditCommand('justifyRight')"><i class="fad fa-align-right"></i></button>
<button title="Justify" type="button" onclick="doRichEditCommand('justifyFull')"><i class="fad fa-align-justify"></i></button>
<!--<button title="Outdent" type="button" onclick="doRichEditCommand('outdent')"><i class="fad fa-outdent"></i></button>
<button title="Indent" type="button" onclick="doRichEditCommand('indent')"><i class="fad fa-indent"></i></button>-->

<button title="Unordered List" type="button" onclick="doRichEditCommand('insertunorderedlist')"><i class="fad fa-list-ul"></i></button>
<button title="Ordered List" type="button" onclick="doRichEditCommand('insertorderedlist')"><i class="fad fa-list-ol"></i></button>
<button title="Blockquote" type="button" onclick="doRichEditCommandWithArg('formatblock','blockquote')"><i class="fad fa-quote-right"></i></button>

<!--<select title="Header" onchange="doRichEditCommandWithArg('formatBlock', this.value)">
  <option value="H1">H1</option>
  <option value="H2">H2</option>
  <option value="H3">H3</option>
  <option value="H4">H4</option>
  <option value="H5">H5</option>
  <option value="H6">H6</option>
</select>-->

<button title="Header" type="button" onclick="doRichEditCommandWithArg('formatBlock', 'H2')"><i class="fad fa-heading"></i></button>

<!--<button title="Horizontal Line" type="button" onclick="doRichEditCommand('insertHorizontalRule')"><i class="fad fa-ruler-horizontal"></i></button>-->
<button title="Link" type="button" onclick="doRichEditCommandWithArg('createLink', prompt('Enter an URL', 'http://'))"><i class="fad fa-link"></i></button>
<button title="Unlink" type="button" onclick="doRichEditCommand('unlink')"><i class="fad fa-unlink"></i></button>
<button title="Insert image" type="button" onclick="doRichEditCommandWithArg('insertImage', prompt('Enter an URL'))"><i class="fad fa-image"></i></button>

<!--<input title="Change text color" type="color" onchange="doRichEditCommandWithArg('foreColor', this.value)">
<input title="Change background color" type="color" onchange="doRichEditCommandWithArg('hiliteColor', this.value)">-->

<!--<select title="Font" onchange="doRichEditCommandWithArg('fontName', this.value)">
  <option value="Arial">Arial</option>
  <option value="Courier">Courier</option>
  <option value="Times New Roman">Times New Roman</option>
  <option value="Verdana">Verdana</option>
  <option value="Agency FB">Agency FB</option>
</select>-->

<!--<select title="Font Size" onchange="doRichEditCommandWithArg('fontSize', this.value)">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
</select>-->

<!--<button title="Cut" type="button" onclick="doRichEditCommand('cut')"><i class="fad fa-cut"></i></button>
<button title="Copy" type="button" onclick="doRichEditCommand('copy')"><i class="fad fa-copy"></i></button>-->
<button title="Remove Format" type="button" onclick="doRichEditCommand('removeFormat')"><i class="fad fa-eraser"></i></button>

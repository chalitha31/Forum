<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <title>Rich Text Editor</title> -->
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/text-edit.css" />
</head>

<body>
    <div class="container">
        <div class="options">
            <!-- Text Format -->
            <button id="bold" class="b option-button format">
                <i class="fa-solid fa-bold"></i>
            </button>
            <button id="italic" class="b boption-button format">
                <i class="fa-solid fa-italic"></i>
            </button>
            <button id="underline" class="b option-button format">
                <i class="fa-solid fa-underline"></i>
            </button>
            <button id="strikethrough" class="b option-button format">
                <i class="fa-solid fa-strikethrough"></i>
            </button>
            <button id="superscript" class="b option-button script">
                <i class="fa-solid fa-superscript"></i>
            </button>
            <button id="subscript" class="b option-button script">
                <i class="fa-solid fa-subscript"></i>
            </button>

            <!-- List -->
            <button id="insertOrderedList" class="b option-button">
                <div class="fa-solid fa-list-ol"></div>
            </button>
            <button id="insertUnorderedList" class="b option-button">
                <i class="fa-solid fa-list"></i>
            </button>

            <!-- Undo/Redo -->
            <button id="undo" class="b option-button">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
            <button id="redo" class="b option-button">
                <i class="fa-solid fa-rotate-right"></i>
            </button>

            <!-- Link -->
            <button id="createLink" class="b adv-option-button">
                <i class="fa fa-link"></i>
            </button>
            <button id="unlink" class="b option-button">
                <i class="fa fa-unlink"></i>
            </button>

            <!-- Alignment -->
            <button id="justifyLeft" class="b option-button align">
                <i class="fa-solid fa-align-left"></i>
            </button>
            <button id="justifyCenter" class="b option-button align">
                <i class="fa-solid fa-align-center"></i>
            </button>
            <button id="justifyRight" class="b option-button align">
                <i class="fa-solid fa-align-right"></i>
            </button>
            <button id="justifyFull" class="b option-button align">
                <i class="fa-solid fa-align-justify"></i>
            </button>
            <button id="indent" class="b option-button spacing">
                <i class="fa-solid fa-indent"></i>
            </button>
            <button id="outdent" class="b option-button spacing">
                <i class="fa-solid fa-outdent"></i>
            </button>

            <!-- Headings -->
            <select id="formatBlock" class="adv-option-button">
                <option value="H1">H1</option>
                <option value="H2">H2</option>
                <option value="H3">H3</option>
                <option value="H4">H4</option>
                <option value="H5">H5</option>
                <option value="H6">H6</option>
            </select>

            <!-- Font -->
            <select id="fontName" class="adv-option-button"></select>
            <select id="fontSize" class="adv-option-button"></select>

            <!-- Color -->
            <div class="input-wrapper">
                <input type="color" id="foreColor" class="adv-option-button" />
                <label for="foreColor">Font Color</label>
            </div>
            <div style="display: none;" class="input-wrapper">
                <input type="color" id="backColor" class="adv-option-button" />
                <label for="backColor">Highlight Color</label>
            </div>
        </div>
        <div class="tectCin" id="text-input" contenteditable="true"></div>
        <!-- <textarea name="" id="text-input" cols="30" rows="10"></textarea> -->
    </div>
    <!--Script-->
    <script src="js/text-edit.js"></script>
    <script>
        const editableDiv = document.getElementById('text-input');

        editableDiv.addEventListener('paste', (event) => {
            event.preventDefault();
            const clipboardData = event.clipboardData || window.clipboardData;
            const pastedText = clipboardData.getData('text/plain');
            const plainText = stripHtmlTags(pastedText);
            insertPlainText(plainText);
        });

        function stripHtmlTags(text) {
            const tempElement = document.createElement('div');
            tempElement.innerHTML = text;
            return tempElement.textContent || tempElement.innerText || '';
        }

        function insertPlainText(text) {
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                range.deleteContents();
                range.insertNode(document.createTextNode(text));
            }
        }
    </script>

</body>

</html>
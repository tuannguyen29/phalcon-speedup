(function($) {
    "use strict"; // Start of use strict

    /* ---------------------------------------------
    Scripts ready
    --------------------------------------------- */
    var $document = $(document);
    var path_absolute = '/';
    var options = {
        prefix: path_absolute + 'admin/thezil-media/',
    };

    // Setting tinymce editor.
    tinymce.init({
        selector: "#textarea-content",
        theme: "modern",
        width: 'auto',
        height: 300,
        relative_urls: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor code codesample blockquote mycode toc"
        ],
        codesample_languages: [
            { text: 'HTML/XML', value: 'markup' },
            { text: 'JavaScript', value: 'javascript' },
            { text: 'CSS', value: 'css' },
            { text: 'PHP', value: 'php' },
            { text: 'Ruby', value: 'ruby' },
            { text: 'Python', value: 'python' },
            { text: 'Java', value: 'java' },
            { text: 'C', value: 'c' },
            { text: 'C#', value: 'csharp' },
            { text: 'C++', value: 'cpp' }
        ],
        extended_valid_elements : "emstart,emend",
        custom_elements: "emstart,emend",
        toolbar: "insertfile undo redo toc| styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | codesample | blockquote mycode",
        toolbar2: "| link unlink anchor | image media | forecolor backcolor  | print preview code ",
        style_formats: [
            { title: "Bold text", inline: "b" },
            { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
            { title: "H1 header", block: "h1", classes: "ui dividing header" },
            { title: "H2 header", block: "h2", classes: "ui dividing header" },
            { title: "H3 header", block: "h3", classes: "ui dividing header" },
            { title: "H4 header", block: "h4", classes: "ui dividing header" },
            { title: "H5 header", block: "h5", classes: "ui dividing header" },
            // { title: "Example 1", inline: "span", classes: "example1" },
            // { title: "Example 2", inline: "span", classes: "example2" },
            // { title: "Table styles" },
            // { title: "Table row 1", selector: "tr", classes: "tablerow1" }
        ],
        image_class_list: [
            {title: 'None', value: 'aligncenter'},
            {title: 'Align Center', value: 'aligncenter full-width img-responsive'},
            {title: 'Align Right', value: 'alignright img-responsive'},
            {title: 'Align Left', value: 'alignleft img-responsive'},
        ],
        image_caption: true,
        init_instance_callback: function(editor) {
            editor.on('KeyDown', function(e) {
                if (e.keyCode == 27) {
                    let editor = tinyMCE.activeEditor
                    const dom = editor.dom
                    const parentBlock = tinyMCE.activeEditor.selection.getSelectedBlocks()[0]
                    const containerBlock = parentBlock.parentNode.nodeName == 'BODY' ? dom.getParent(parentBlock, dom.isBlock) : dom.getParent(parentBlock.parentNode, dom.isBlock)
                    let newBlock = tinyMCE.activeEditor.dom.create('p')
                    newBlock.innerHTML = '<br data-mce-bogus="1">';
                    dom.insertAfter(newBlock, containerBlock)
                    let rng = dom.createRng();
                    newBlock.normalize();
                    rng.setStart(newBlock, 0);
                    rng.setEnd(newBlock, 0);
                    editor.selection.setRng(rng);
                }
            });
        },
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = options.prefix + '?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    });
    tinymce.PluginManager.add('mycode', function(editor, url) {
        editor.addButton('mycode', {
            text: '</>',
            onclick: function() {
                // Open window
                editor.windowManager.open({
                    title: 'Please input text',
                    body: [
                        {type: 'textbox', name: 'description', label: 'Code'}
                    ],
                    onsubmit: function(e) {
                        // Insert content when the window form is submitted
                        editor.insertContent('<code>' + e.data.description + '</code>');
                    }
                });
            }
        });
    });
    tinymce.PluginManager.add('blockquote', function(editor, url) {
        // Add a button that opens a window
        editor.addButton('blockquote', {
            text: 'blockquote',
            icon: 'fa-quote-right',
            onclick: function() {
                // Open window
                editor.windowManager.open({
                    title: 'Please input text',
                    body: [
                        {type: 'textbox', name: 'description', label: 'Text'}
                    ],
                    onsubmit: function(e) {
                        // Insert content when the window form is submitted
                        editor.insertContent('<blockquote>' + e.data.description + '</blockquote>');
                    }
                });
            }
        });
        // Adds a menu item to the tools menu
        editor.addMenuItem('customEmElementMenuItem', {
            text: '<blockquote>',
            context: 'tools',
            icon: 'fa-quote-right',
            onclick: function() {
                editor.insertContent('<blockquote>Enter your blockquote</blockquote>');
            }
        });
    });

    $.fn.filemanager = function(type, options) {
        type = type || 'file';

        this.on('click', function(e) {
            var path_absolute = '/';
            var options = {
                prefix: path_absolute + 'admin/thezil-media/',
            };

            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function(items) {
                var file_path = items.map(function(item) {
                    return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.val('').val(file_path).trigger('change');

                // clear previous preview
                target_preview.html('');

                // set or change the preview image src
                items.forEach(function(item) {
                    target_preview.append(
                        $('.image-preview').attr('src', item.thumb_url)
                    );
                });

                // trigger change event
                target_preview.trigger('change');
            };
            return false;
        });
    }

    $('.uploadFile').filemanager('image', options);

    $document.ready(function() {
        // Show/hidden SEO section.
        $document.on("click", ".btn-trigger-show-editor", function(e) {
            e.preventDefault();
            $(".content-section").toggleClass("d-none");
        });
    });
})(jQuery); // End of use strict

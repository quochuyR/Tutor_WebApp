(function() {
    let MyEditor;
    // data table
    jQuery(document).ready(function($) {

        document.querySelector('#editor') && ClassicEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Nhấn vào đây và hãy viết mô tả chi tiết!',

            })
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer?.appendChild(editor.ui.view.toolbar.element);
                MyEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    });
    // $.validator.addMethod("ck_editor", function() {
    //     var content_length = MyEditor.getData().trim().length;
    //     return content_length > 0;
    // }, "Please insert content for the page.");


})(jQuery)
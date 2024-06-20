
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        convert_urls:false,
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'autosave advlist nonbreaking save preview fullscreen importcss insertdatetime directionality code table lists image media anchor autolink charmap codesample emoticons link searchreplace visualblocks wordcount file-manager',
        Flmngr: {
            urlFileManager: '{{ route('admin.file-manager.index' , ['type' => $data['type'], 'folderId' => $data['folderId']]) }}',
            urlFiles: '{{ asset('storage/assets/'.$data['type'].'/'.$data['folderId']) }}',
        },
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        images_file_types: 'jpg,jpeg,png,gif,svg',
    });
</script>




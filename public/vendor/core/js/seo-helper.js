function createSlug(name, exist) {
    $.ajax({
        url: $('#js-slug-input').data('url'),
        type: 'POST',
        data: {
            name: name
        },
        success: function success(slug) {
            if (exist) {
                $('#sample-permalink .permalink').prop('href', $('#js-slug-input').data('view') + '/' + slug);
            } else {
                $('#sample-permalink').html('<a class="permalink" target="_blank" href="' + $('#js-slug-input').data('view') + '/' + slug + '">' + $('#sample-permalink').html() + '</a>');
            }

            $('#editable-post-name').text(slug);
            $('#current-slug').val(slug);

            let domail = $('#js-seo-preview__google-url').text();
            $('#js-seo-preview__google-url').text(domail + slug);

            $('#edit-slug-box .cancel').hide();
            $('#edit-slug-box .save').hide();
            $('#change-slug').show();
            $('#edit-slug-box').removeClass('d-none');
        },
        error: function error(data) {
            console.log(data);
        }
    });
};

$(document).ready(function() {
    $('#change-slug').click(function() {
        $('.default-slug').unwrap();
        $('#editable-post-name').html('<input type="text" id="new-post-slug" class="input-sm" value="' + $('#editable-post-name').text() + '" autocomplete="off">');
        $('#edit-slug-box .cancel').show();
        $('#edit-slug-box .save').show();
        $(this).hide();
    });

    $('#edit-slug-box .cancel').click(function() {
        let currentSlug = $('#current-slug').val();
        $('#sample-permalink').html('<a class="permalink" href="' + $('#js-slug-input').data('view') + '/' + currentSlug + '">' + $('#sample-permalink').html() + '</a>');
        $('#editable-post-name').text(currentSlug);
        $('#edit-slug-box .cancel').hide();
        $('#edit-slug-box .save').hide();
        $('#change-slug').show();
    });

    $('#edit-slug-box .save').click(function() {
        let name = $('#new-post-slug').val();
        if (name != null && name != '') {
            createSlug(name, false);
        } else {
            $('#new-post-slug').closest('.form-group').addClass('has-error');
        }
    });

    $('#title').on('blur', function() {
        if ($('#edit-slug-box').hasClass('d-none')) {
            createSlug($('#title').val(), true);
        }
    });

    $('#title').on('keyup', function(e) {
        e.preventDefault();

        $('#meta-title').val($(this).val());
    });

    $('#bodySummary').on('keyup', function(e) {
        e.preventDefault();

        $('#meta-description').val($(this).val());
    });

    $.seoPreview({
        google_div: "#seopreview-google",
        facebook_div: "#seopreview-facebook",
        metadata: {
            title: $('#meta-title'),
            desc: $('#meta-description'),
            url: {
                full_url: $('#current-slug'),
                use_slug: true,
                base_domain: ThezilVariables.jsonData.homepage_domain,
                auto_dash: true
            }
        },
        google: {
            show: true,
            date: false
        },
        facebook: {
            show: true,
            featured_image: $('#thumbnailSeoTool')
        }
    });

    // Character counter with multiple inputs
    $('.word-count').on('change keydown keyup keydown blur focus', function() {
        var maxlength = $(this).attr('data-counter');
        var currentCount = $(this).val().length;
        var charLeft = maxlength - currentCount;

        if (charLeft > 0) {
            $(this).next(".counter").text('(' + currentCount + ' characters)');
            $(this).next(".counter").css("color", "black");
        } else {
            $(this).next(".counter").text('(' + currentCount + ' characters)');
            // this.value = this.value.substring(0, maxlength);
            $(this).next(".counter").css("color", "red");
        }
    }); //Keyup Function Ends
}); //Doc Ready Ends

BA.Events = {

    AddBlockContentClick: function (e) {
        $.get($(this).prop('href') + '/' + $('.media').length, null, BA.Events.NewBlockContentResponse, 'json');

        e.preventDefault();
    },

    CityChanged: function () {
        if ($(this).val() == '')
            $('.new_city').slideDown();
        else
            $('.new_city').slideUp();

    },
    RelatedType: function (e) {
        $('#data_holder_type').slideUp();
        //$(this).val() - �������� �� �������
        $.get('/admin/type?related=' + $(this).val(), null, function (data) {

            var content = $(data.content);
            BA.Actions.init(content);
            $('#data_holder_type').slideDown().html('').append(content);
            console.log(data.data);
            console.log(data);
        }, 'json');
    },
    TabContentManage: function (e) {
        e.preventDefault();
        var href = $(this).prop('href');
        $.get(href, null, BA.Events.TabContentManageLoaded, 'json');
    },

    TabContentManageLoaded: function (data) {
        if (data.error_code != 0) {
            alert('Error happened');
            return;
        }

        var content = $(data.content);

        var title = data.title || "";

        BA.Actions.OpenModal(title, content);
        BA.Actions.init(content);
    },
    MoveUpBlockClick: function (e) {
        var block = $(this).parents('.media');
        var line_block = block.prev();
        var next_block = line_block.prev();

        if (next_block.hasClass('media')) {
            next_block.prev().after(block);
            block.after(line_block);
        }

        BA.Actions.RebuildUIBlocks();
        e.preventDefault();

    },

    MoveDownBlockClick: function (e) {
        var block = $(this).parents('.media');
        var line_block = block.next();
        var next_block = line_block.next();

        if (next_block.hasClass('media')) {
            next_block.next().after(block);
            block.after(line_block);
        }

        BA.Actions.RebuildUIBlocks();
        e.preventDefault();
    },

    DeleteBlockClick: function (e) {
        $(this).parents('.media').slideUp('slow', function () {
            $(this).prev().remove();
            $(this).remove();

            BA.Actions.RebuildUIBlocks();

        });

        e.preventDefault();
    },

    DeletePhotoClick: function (e) {
        $.get($(this).prop('href'), null);
        $(this).parent().find('img').remove();
        $(this).remove();

        e.preventDefault();
    },

    UploadPhotoClick: function (e) {
        $(this).parent().find('input').click();
        e.preventDefault();
    },

    NewBlockContentResponse: function (data) {
        if (data.status == 'ok') {
            var content = $(data.content);
            BA.Actions.init(content);

            var last_item = $('.media').last();

            if (last_item.length > 0) {
                last_item.after(content);
                last_item.after('<hr />');
            }
            else {
                last_item = $('hr.limiter')
                last_item.before('<hr />');
                last_item.after(content);
            }

            BA.Actions.RebuildUIBlocks();
        }
    },

    ResourceTypeChanged: function () {
        var type = $(this).val();
        var image_field_holder = $('.media_upload_image');
        var youtube_link_holder = $('.media_youtube_link');

        if (type == 'image') {
            image_field_holder.show();
            youtube_link_holder.hide()
        }
        else {
            image_field_holder.hide();
            youtube_link_holder.show();
        }
    },

    CaruselDeleteRow: function (e) {
        e.preventDefault();

        $(this).parents('tr').remove();
    },

    CaruselAddRow: function (e) {
        console.log($(this).prop('href'));
        $.get($(this).prop('href') + '/' + ($('table.carusel-rows tr').length - 1), null, BA.Events.NewCaruselRowResponse, 'json');
        e.preventDefault();

    }, ModalClosed: function (e) {
        $(this).remove();
        e.preventDefault();
    },

    ModalClosing: function (e) {
        BA.Bindings.CurrentWindow = null;
    },

    SubmitAjaxForm: function (e) {
        e.preventDefault();

        var _form = $(this);
        _form.find('.error_desc').remove();
        _form.find('.form-group').removeClass('has-error');

        $.ajax({
            type: "POST",
            url: $(this).prop('action'),
            data: $(this).serialize(),
            success: function (data, status) {
                BA.Events.AjaxFormHandler(data, status, _form)
            },
            error: function (response, status) {
                BA.Events.AjaxFormHandlerFailed(response, status, _form)
            },
            dataType: 'json'
        });
    },

    AjaxFormHandler: function (data, status, _form) {
        if (data.error_code == 0) {
            data = data.data;
            $.get(data.url, null, ERP.Events.TabContentLoaded, 'json');
        }
    },

    TabContentLoaded: function (data, type) {
        if (data.error_code == 0) {
            data = data.data;
            var tab = $('#tab_' + data.type);
            tab.html('');
            var content = $(data.content);
            BA.Actions.init(content);
            tab.append(content);

            if (BA.Bindings.CurrentWindow != null)
                BA.Bindings.CurrentWindow.find('.close').click();
        }

    },

    AjaxFormHandlerFailed: function (response, status, _form) {
        if (response.status == 422) {
            for (var i in response.responseJSON) {
                var block = _form.find("[name='" + i + "']").parents('.form-group');

                block.addClass('has-error');
                block.append('<p class="help-block error_desc">' + response.responseJSON[i].join('<br/>') + '</p>')
            }
        }
        console.log(response);
    },

    SubmitMainForm: function (e) {
        e.preventDefault();

        $('.main_form_' + $(this).data('form')).submit();
    },

    NewCaruselRowResponse: function (data) {
        if (data.status == 'ok') {
            var content = $(data.content);
            BA.Actions.init(content);

            $('table.carusel-rows').append(content);


        }
    },

    RelatedName: function (e) {
        if ($(this).val() == '') {
            $.get('/payment_extended_info?related=' + $(this).val(), null, function (data) {
                $('#data_holder').html(data);
            })
        }
        else {
            $('#data_holder').html('');
        }
    },
    RelatedPayment: function (e) {
        if (BA.Bindings.CurrentAmountRequest != null)
            BA.Bindings.CurrentAmountRequest.abort();

        var t = $('.related-payment').map(function (key, item) {
            return $(item).val()
        }).toArray();

        BA.Bindings.CurrentAmountRequest = $.get('/payment_total?event=' + $('#amount').data('event') + '&amounts=' + JSON.stringify(t), null, function (data) {
            $('#total_payment').html(data);
            BA.Bindings.CurrentAmountRequest = null;
        })
    },
    AnotherEntry: function (e) {
        //if ($('#another_entry > div').length + 1 < 4) {
        $.get('/another_entry?event=' + $('#another').data('event') + '&id=' + $(this).data('id'), null, function (data) {
            var content = $(data);
            $('#another_entry').append(content);
            BA.Actions.init(content);
            $('.participant_number').each(function(index){
                $(this).text("Participant #" + (index + 2));
            });
            var i = parseInt($('#another').data('id')) + 1;
            $('#another').data('id', i);
            if ($('#another_entry > div').length > 2) {
                $('#another').hide();
            }
        });
        //}
        console.log('th');

    },

    DeleteAnotherEntry: function (e) {
        var that = this;
        $.get('/another_entry?event=' + $('#another').data('event') + '&id=' + $(this).data('id'), null, function (data) {
            var content = $(data);
            BA.Actions.init(content);
            $('.participant_number').each(function(index){
                $(this).text("Participant #" + (index + 2));
            });
        });
        $('#another_' + $(that).data('id')).remove();
        if ($('#another_entry > div').length < 3) {
            $('#another').show();
        }

    },

    ParticipantSubmit: function (e) {
        $.ajax({
            type: 'post',
            url: '/participant',
            data: $("#payment_form").serialize(),
            dataType: 'json',
            success: function (data) {
                window.location.href = data.previous_url;
            },
            error: function (data) {
                $(".help-block").remove();
                $(".has-error").removeClass("has-error");
                if (data.status === 422) {
                    var errors = data.responseJSON;
                    console.log(errors);
                    $.each(errors, function (key, value) {
                        $(document.getElementsByName(key)).parent().parent().addClass("has-error");
                        $(document.getElementsByName(key)).parent().parent().append("<span class=\" help-block\">" + value + "</span>");
                    });
                }
            }
        });
        return false;
        //var amount = parseInt($(this).find('[name="amount_deposited"]').val());
        //if (isNaN(amount))
        //    amount = 0;
        //if (amount == 0) {
        //    $(document.getElementsByName("amount_deposited")).parent().parent().addClass("has-error");
        //    $(document.getElementsByName("amount_deposited")).parent().parent().append("<span class=\" help-block\">The amount field is required</span>");
        //    $(this).find('[type="submit"]').prop('disabled', false);
        //    return false;
        //}
    }
};
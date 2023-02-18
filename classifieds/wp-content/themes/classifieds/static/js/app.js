// Callback functions
function autoRemoveFn($this) {
    $this.fadeOut('slow', function() {
        $(this).remove();
    });
}

function showAdStatsFn($this) {
    $this.find('i.fa').toggleClass('fa-chevron-up');
}

function authorSendMsgFn($this) {
    var authorname = $('.page-title h1').text() || null
    ,   target = $this.attr('data-target') || null;

    if (target && authorname) {
        $(target).find('textarea').attr('placeholder', 'Your message to ' + authorname + '...');
    }
}


// Common functions
function setLayout(type, $target)
{
    type = type.toUpperCase();
    var isTarget = typeof $target != 'undefined'

    if (type == 'POPUP') {
        // Set Layout
        if (! isTarget) {
            $target = $('.popup.act');
            if (! $target.length) {
                // Do nothing if no more active popups are there.
                return false;
            }
        }

        if (IS_MD_DVC) {
            var width = '80%'
            ,   left  = '10%';
        } else {
            var dataW = $target.attr('data-width') || 50 // in %
            ,   width = ($(window).width() / 100 ) * parseInt(dataW) + 'px'
            ,   left  = ((100 - dataW) / 2) + '%'; // in %
        }

        $target.css({'width': width, 'left': left});
    }
}


$(function() {
    /** Settings Page **/
    $(document).on('click', '.chk-all', function() {
        var $chkBox = $(this).parent().closest('.chk-box')
        ,   $chkGroup= $chkBox.parent().closest('.chk-group')
        ,   toCheck = !$chkBox.find('input[type="checkbox"]').is(':checked');

        $chkGroup.find('.chk-box-set input[type="checkbox"]').prop('checked', toCheck);
    });

    $(document).on('click', '.chk-group .chk-box label', function() {
        var $chkBox = $(this).parent().closest('.chk-box')
        ,   $chkBoxSet= $chkBox.parent().closest('.chk-box-set')
        ,   $chkGroup = $chkBoxSet.parent().closest('.chk-group')
        ,   toCheck   = ! $chkBox.find('input[type="checkbox"]').is(':checked')
        ,   chkLen    = $chkBoxSet.find('input[type="checkbox"]').not(':checked').length;

        if (toCheck) {
            chkLen--; // Ignore Current checkbox.
            // Check any one is not checked?
            toCheck = chkLen == 0
        }

        var $chkBoxAll = $chkGroup.find('.chk-all').parent().closest('.chk-box');
        $chkBoxAll.find('input[type="checkbox"]').prop('checked', toCheck);
    });

    $('#block-user').on('keyup', function() {
        var $this = $(this)
        ,   value = $this.val();

        if (value.length > 0) {
            // Ajax: Get user.

            // Show Block btn
            $('#block-user-btn').fadeIn('slow');
        } else {
            $('#block-user-btn').fadeOut('slow');
        }
    });

    /** My Account Page **/
    $(document).on('click', '#messages .ad-reply-btn', function() {
      var   html    = $('#reply-form').html()
        ,   $row    = $(this).parent().closest('.row')
        , replyId   = $row.attr('id');

        if (! $('#reply-'+ replyId).length) {
            var replyTo   = $row.find('.username:first').text();

            html = '<div class="row-item reply-form" id="reply-'+ replyId +'">' + html + '</div>';
            $row.find('> .content').append(html);

            $('#reply-'+ replyId +' textarea')
              .attr('placeholder', 'Reply to @'+ replyTo + '...')
              .attr('data-reply-to', replyTo)
              .val('@' + replyTo + ': ');
            //$('#reply-'+ replyId).slideDown('slow');
        }

        setTimeout(function() {
            $('#reply-'+ replyId + ' textarea').focus();
        }, 100);
    });

    $(document).on('click', '.info-opener', function() {
        // Ad stats info
        var $fa    = $(this).find('svg')
        ,   isShow = $fa.hasClass('fa-chevron-up')
        ,   $info  = $(this).parent().next('.info'); //.find('.ad-info');

        if (isShow) {
            $(this).find('b').text('Less');
            $fa.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $info.slideDown('slow', function() {

            });
        } else {
            // Hide
            $(this).find('b').text('More');
            $fa.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            $info.slideUp('slow', function() {
            });
        }
    });

    $('#dob-month, #dob-day, #dob-year').on('change', function() {
        // Calculate the Age
        var month = $('#dob-month').val();
        if (month != '') {
            var day = $('#dob-day').val();
            if (day != '') {
                var year = $('#dob-year').val();
                $('#age span').text(getAge(year, month, day));
            }
        }
    });

    /** Single Page **/
    $(document).on('keyup', '.comment-form textarea', function() {
        var text = $(this).val().trim();

        if (text == '') {
            // Set '@username:' at beginning.
            var username = $(this).attr('data-reply-to') || null;
            if (username) {
                $(this).val('@' + username + ': ');
            }
        }
    });

    $(document).on('click', '.reply-cancel-btn', function() {
        var isDiscard = true
        ,   $row = $(this).parent().closest('.row-item')
        ,   text = $row.find('textarea').val().trim();

        if (text != '') {
            // Remove '@user name:' from actual string
            var pat = /^@(.*?)\:(.*)/i
            ,   match= text.match(pat);

            if (match == null || (match.length && match[2].length != 0)) {
                if (! window.confirm('Are you sure to discard the changes?')) {
                    isDiscard = false;
                }
            }
        }

        if (isDiscard) {
            $row.fadeOut('slow', function() {
                $(this).remove();
            });
        }
        return false;
    });

    $(document).on('click', '.comment-reply-btn', function() {
        var html    = $('#comment-form').html()
        ,   $row    = $(this).parent().closest('.row')
        , commentId = $row.attr('id');

        if (! $('#reply-'+ commentId).length) {
            var replyTo   = $row.find('.replied-username:first span').text();

            html = '<div class="row row-item comment-form" id="reply-'+ commentId +'">' + html + '</div>';
            $row.find('> .content').append(html);

            $('#reply-'+ commentId +' textarea')
              .attr('placeholder', 'Reply to @'+ replyTo + '...')
              .attr('data-reply-to', replyTo)
              .val('@' + replyTo + ': ');
            //$('#reply-'+ commentId).slideDown('slow');
        }

        setTimeout(function() {
            $('#reply-'+ commentId + ' textarea').focus();
        }, 100);
    });

    $(document).on('click', '.reply-opener', function() {
        var $this= $(this)
        ,   $row = $this.parent().closest('.row')
        ,   $ul  = $row.find('> ul') || null;

        if ($ul) {
            if ($ul.hasClass('act')) {
                // Close
                $ul.removeClass('act').slideUp('slow', function() {
                    $this.html('Show Replies');
                });

            } else {
                $ul.addClass('act').slideDown('slow', function() {
                    $this.html('Hide Replies');
                });
            }
        }
    });

    $(document).on('click', '.advanced-options-btn', function() {
        $(this).parent().next().toggleClass('hide');
        return false;
    });

    $(document).on('click', '.close-btn', function() {
        var $row = $(this).parent().closest('.row');

        if ($row.hasClass('popup')) {
            // Close Dim Cover
            $('.dim-cover').fadeOut('slow');
        }

        $row.removeClass('active').fadeOut('slow');
    });

    $('.target').on('click', function() {
        var $this   = $(this)
        ,   target  = $this.attr('data-target') || null;

        if (target != null) {
            var $target = $(target);

            $('.dialog.act, .popup.act').fadeOut('slow');

            // Popup
            if ($target.hasClass('popup')) {
                // Add Dim Layout
                $('.dim-cover').fadeIn('slow');

                setLayout('POPUP', $target);
            }

            $(target).addClass('act').fadeIn(function() {
                  var callback= $this.attr('data-callback') || null;
                  if (callback) {
                      eval(callback + '($this)');
                  }
                  $(this).find('[autofocus]').focus();
            });
        }
    });

    // Resize
    $(window).resize(function() {
        // Resize the Popup window.
        //setLayout('POPUP');
    });

});

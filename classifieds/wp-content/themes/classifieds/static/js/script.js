var IS_MD_DVC = false
,   wH = $(window).height() - 21
,   cH = wH - $('footer').height()
,   isHome = $('#categories-grid').length ? true : false
,   imgExtArray = ['JPG', 'PNG', 'JPEG', 'GIF', 'BMP', 'ICO']
,   previewExtArray = ['TXT', 'PDF', 'HTML', 'SHTML'] // Able to open by iframe
,   searchBarOffsetT = $('#search-bar').length ? $('#search-bar').offset().top : 0;

if (isHome) {
    $('.page:first').attr('id', 'home-page');
}

//document.getElementById('featured-image').style.minHeight = wH + 'px';
//document.getElementById('content').style.marginTop = -wH + 'px';

/*var parent = document.getElementById('con');
var child = document.getElementById('con2');
child.style.right = child.clientWidth - child.offsetWidth + "px";*/

function onResize() {
    IS_MD_DVC = screen.width <= 768;
    
    if ($('.tab-arrow').length > 0) {
        $('.tab-arrow').remove();
    }
}

function toggleAccordion($li, isOpen) {
    isOpen = typeof isOpen == 'undefined';
    if (isOpen) {
        $li.find('.accordion-content').slideDown(300, function() {
            $li.addClass('act');
        });
        $li.find('.accordion-title').addClass('active');
        $li.find('.accordion-title svg').removeClass('fa-plus-circle').addClass('fa-minus-circle');
    } else {
        // Close it.
        $li.find('.accordion-content').slideUp(300, function() {
            $li.removeClass('act');
        });
        $li.find('.accordion-title').removeClass('active');
        $li.find('.accordion-title svg').removeClass('fa-minus-circle').addClass('fa-plus-circle');
    }
}
function clearLocation($this) {
    $this.find('span').text('Restore My Location');
    $this.removeClass('danger').addClass('active').attr('data-restored', 0);
}

function getVarName(str) {
    str = str.replace(/\W+/g, ' ').trim();
    var s = ''
    ,   passLetter = '';
    for (var i=0; i < str.length; i++) {
        if (str[i] == ' ') {
            passLetter = str[i+1].toUpperCase();
        } else  {
            passLetter =(passLetter != '' ? passLetter : str[i]);
            s += (s == '') ? passLetter.toLowerCase() : passLetter;
            passLetter = '';
        }
    }
    return s;
}    
    
$(function() {
    // Basic setup
    onResize();
    
    $('.autocomplete').on('keyup', function() {
        if ($(this).val() == '') {
            if ($(this).attr('data-target') == '.detect-loc-btn') {
                clearLocation($('.detect-loc-btn'));
            }
        }
    });
    
    
    /** Accordion **/
    $('.accordion-title').on('click', function() {
        var $li = $(this).parent().closest('li');

        if ($li.hasClass('act')) {
            // Hide
            toggleAccordion($li, false);
        } else {
            // Close others & open this one.
            toggleAccordion($('.accordion li.act'), false);
            toggleAccordion($li);
        }
    });

    $('.tgl-btn').on('click', function() {
        var $this     = $(this)
        ,   $target   = $this.attr('data-target') || null
        ,   $callback = $this.attr('data-callback') + '($this)' || null;

        if ($target) {
            if ($($target).hasClass('act')) {
                // Hide
                $($target).slideUp('slow', function() {
                    $(this).removeClass('act');
                });
            } else {
                $($target).addClass('act').slideDown('slow', function() {
                      if ($callback) {
                          eval($callback);
                      }
                });
            }
        }

        return false;
    });

    $(document).on('click', '.carousel .nav-row svg', function() {
        var isMore = $(this).hasClass('plus') ? true : false
        ,   $parent= $(this).parents().find('.carousel')
        ,   slideNo= $parent.attr('data-slide');

        if (typeof slideNo == 'undefined') {
          if (isMore) {
              slideNo = 1;
          } else {
            // First time & left side button is clicked.
            return false;
          }
        } else {
              slideNo = isMore ? ++slideNo : --slideNo;
        }
        $parent.find('.nav-row').prop('disabled', true);

        var parentW= $parent.width()
        ,   itemW  = $parent.find('.items .card-item:first').outerWidth()
        ,   noOfMove= Math.floor(parentW / itemW)
        ,   movePx = Math.ceil(noOfMove * itemW);

        if (isMore) {
            // Do ajax call to get more items from server

            // Scroll to right
            var maxSlides = Math.floor($parent.find('.items')[0].scrollWidth / movePx);
            if (slideNo > maxSlides) {
                // Fully moved to right side.
                return false;
            }
            movePx *= slideNo;
        } else {
            // Scroll to left
            if (slideNo < 0) {
                // Fully moved to left side.
                return false;
            }
            movePx = slideNo * movePx;
        }

        $parent.find('.items').stop().animate({'scrollLeft': (movePx + 'px')}, 1000, function() {
            console.log('Slide No: ' + slideNo);

            $parent.attr('data-slide', slideNo);
            $parent.find('.nav-row').prop('disabled', false);
        });
    });

    $('#search-btn-more').on('click', function() {
        var $this = $(this);
        if ($this.hasClass('opened')) {
            $('#search-bar-more').slideUp('slow', function() {
                $('#search-bar').css({'background': 'none'});
                $this.removeClass('opened');
                $this.find('svg').addClass('fa-chevron-down').removeClass('fa-chevron-up');
            });
        } else {
            $('#search-bar').css({'background': 'rgba(255, 255, 255, 0.9)'}); //'#f8f8f8'});
            $('#search-bar-more').slideDown('slow', function(){

                if ($('#search-bar-more').is(':hidden')) {
                    scrollTo('#search-bar', 500);
                }
                $this.addClass('opened');
                $this.find('svg').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            });
        }
    });

    // ------------------------    Common Functions ----------------------------
    
    $(document).on('click', '.mini-chk-box', function() {
        var $this = $(this);
        if ($this.find('svg').hasClass('fa-check-circle')) {
            // Uncheck
            $this.find('svg').removeClass('fa-check-circle').addClass('fa-times-circle');
            $this.find('input[type="checkbox"]').prop('checked', false);
        } else {
            $this.find('svg').addClass('fa-check-circle').removeClass('fa-times-circle');
            $this.find('input[type="checkbox"]').prop('checked', true);
        }
    });

    $('#scroll-up-btn').on('click', function() {
        scrollTo();
    });

    $(document).on('scroll', function() {
        var wsTop = $(window).scrollTop();

        // Fit Search Bar as fixed.
        if (isHome && $(window).width() > 750) {
            if (wsTop > searchBarOffsetT) {
                $('#search-bar').addClass('fixed');
            } else {
                $('#search-bar').removeClass('fixed');
            }
        }

        // Show Scroll up button.
        if (wsTop > wH/3) {
            $('#scroll-up-btn').fadeIn('slow');
        } else {
            $('#scroll-up-btn').fadeOut('slow');
        }

    });

    //var catH = $('#categories-grid').height();
    //wH  -= catH;
    $('.fit-height').each(function() {
        $(this).css({'height': (cH - $(this).offset().top) + 'px'});
    });

    setFiles();
    setTabs();
    setRating();
    setLocation();

});


$(window).on('resize', function(){
    // Re-setup the global vars.
    onResize();
    
    $('.tabs').each(function() {
        if ($(this).find('.tab-header > div.active').length > 0) {
            setTabArrow($(this).find('.tab-header > div.active')); 
        }
    });
});

function scrollTo(_ele, speed)
{
    var scrollTop = 0
    ,   speed     = typeof speed == 'undefined' ? 1000 : speed;
    if (typeof _ele != 'undefined') {
        var offset = $(_ele).offset();
        scrollTop = offset.top;
    }
    $('html, body').animate({'scrollTop': scrollTop + 'px'}, speed);
}

function setPreviwer($previwer, nthChild) {
    // Set slide show previwer
    if ($('#preview-loader').length == 0) {
        // First time. Create the necessary preview loader elements.
        var html = '<div id="preview-loader" class="row popup">'
                 +    '<i class="fa fa-times-circle close-btn"></i>'
                 +    '<div class="content">No Content.</div>'
                 + '</div>';
        $('body').append(html);

        // Set Layout
        setLayout('POPUP', $('#preview-loader'));
    }
    // Add Dim Layout
    $('.dim-cover, #preview-loader').fadeIn('slow');

    nthChild = typeof nthChild == 'undefined' ? 1 : nthChild + 1;
    var $previewLoader= $('#preview-loader .content')
    ,   $icon       = $previwer.find('> .icon:nth-child('+ nthChild +')')
    ,   fileUrl     = $icon.find('[data-url]').attr('data-url') || null;

    if (fileUrl) {
        var fileInfo = getFileInfo(fileUrl);
        if (isImage(fileInfo['ext'])) {
            $previewLoader.html('<img src="' + fileInfo['filePath'] +'" /><div class="text-center">File Name: '+ fileInfo['fileName'] +'</div>');
        } else if(canPreview(fileInfo['ext'])) {
            $previewLoader.html('<div>File Name: '+ fileInfo['fileName'] +'</div><iframe src="' + fileInfo['filePath'] +'" style="width: 100%;"></iframe>');
        } else {
            var html = '<div class="no-results _bg">'
                     +      '<i class="fa fa-info-circle"></i> Preview Handler is not found, File is opened on the new tab...'
                     +      '<div class="ctrls">File URL: <b><a href="'+ fileInfo['filePath'] +'" target="_blank">'+ fileInfo['filePath'] +'</a></b></div>'
                     + '</div>';
            $previewLoader.html(html);
            window.open(fileInfo['filePath'], '_blank');
        }
    } else {
        var html = '<div class="no-results warning">'
               +      '<i class="fa fa-times-circle"></i> URL is not found. Please try again by reloading the page.'
               +      '<div class="ctrls"><a class="btn col-md-4" href="javascript: window.location.reload();">Reload</a></div>'
               + '</div>';
        $previewLoader.html(html);
    }
}

function setFilePreview(_this, $id) {
    if (_this.files && _this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $id.attr('src', e.target.result);
        }
        reader.readAsDataURL(_this.files[0]);
    }
}

function canPreview(ext) {
    var isPreiew = false
    ,   ext = ext.toUpperCase();
    for(var i in previewExtArray) {
        if (previewExtArray[i] == ext) {
            isPreiew = true;
            break;
        }
    }
    return isPreiew;
}

function isImage(ext) {
    var isImg = false
    ,   ext = ext.toUpperCase();
    for(var i in imgExtArray) {
        if (imgExtArray[i] == ext) {
            isImg = true;
            break;
        }
    }
    return isImg;
}

function getFileInfo(filePath) {
    // Replace all back slash to forward slash.
    filePath = filePath.replace(/\\/g, '/');

    var nameS   = filePath.split('/')
    ,   fileName= nameS[nameS.length - 1]
    ,   extS    = fileName.split('.')
    ,   ext     = extS.length > 1 ? extS[extS.length-1].toUpperCase() : '' //substring(src.length-3).toUpperCase()

    return {
        'fileName': fileName,
        'ext'     : ext,
        'filePath': filePath
    }
}

function getAge(year, month, day) {
    // Convert to date
    var now = new Date()
    ,   dob = new Date(year, month-1, day);

    // Convert millisecond to no. of years (365 * 24 * 60 * 60 * 1000)
    return Math.floor((now - dob) / 31536000000);
}

function setRating() {
    if ($('.rating-box').length > 0) {
        $('.rating-stars span').mouseover(function(event){
            var $parent = $(this).parents().find('.rating-box');
            if ($parent.hasClass('rated')) {
                return false;
            }

            var $stars  = $parent.find('.rating-stars')
            ,   idx     = $(this).index()
            ,   cls     = 'high'
            ,   msg     = 'Like it, '
            ,   isHalf  = false;

            // Check is half?
            /*$stars.find('svg').addClass('fa-star').removeClass('fa-star-half low medium high');
            $parent.find('.rating-msg').html('&nbsp;').removeClass('low medium high');
            var e = $stars.find('svg:eq('+ idx +')')
            ,   event = event || window.event
            ,   offset = e.offset()
            ,   left   = offset.left + e.width();

            console.log(event.clientX + ',' + left+','+(idx+1));
            if (event.clientX < (left + (left/.25))) {
                // Half
                isHalf = true;
                console.log('Half');
                $(e).addClass('fa-star-half');
            }*/

            if (idx < 2) {
                cls = 'low';
                msg = 'Don\'t Like it, ';
                msg += idx == 0 ? 'Worst!' : 'Bad';
            } else if (idx < 3) {
                cls = 'medium';
                msg = 'Just Ok, But ';
                msg += isHalf ? 'don\'t like it.' : 'like it.';
            } else {
                msg += idx == 3 ? 'Good.' : 'Super!';
            }

            for (var i=0; i <= idx; i++) {
                $stars.find('svg:eq('+ i +')').addClass(cls);
            }
            $parent.find('.rating-msg').html(msg).addClass(cls);
        });

        $('.rating-stars span').mouseleave(function(){
            var $parent = $(this).parents().find('.rating-box');
            if ($parent.hasClass('rated')) {
                return false;
            }
            $parent.find('.rating-stars svg').removeClass('fa-star-half low medium high');
            $parent.find('.rating-msg').html('&nbsp;').removeClass('low medium high');
        });

        $('.rating-stars span').on('click', function() {
              var $parent = $(this).parents().find('.rating-box');
              if ($parent.hasClass('rated')) {
                  return false;
              }

              var $stars  = $parent.find('.rating-stars')
              ,   idx     = $(this).index()
              ,   msg     = 'Thanks for your likes!'
              ,   cls     = idx < 2 ? 'low' : (idx == 2 ? 'medium' : 'high')
              ,   ico     = '<i class="fa fa-thumbs-up ico '+ cls +'" title="Like it"></i>';

              if (idx < 2) {
                  // UnLike it
                  msg = 'Hmm, Thanks for your rating.';
                  ico = '<i class="fa fa-thumbs-down ico '+ cls +'" title="Don\'t Like it"></i>';
              }

              msg += '<div><span class="rating-undo">Undo</span></div>';
              $parent.find('.rating-advice').html(msg);
              $parent.find('.rating-msg').html(ico);
              $parent.addClass('rated').attr('data-rating', idx);

              // CLear 'undo' button.
              window.setTimeout(function() {
                  if ($parent.find('.rating-undo').length && $parent.hasClass('rated')) {
                      $parent.find('.rating-undo').fadeOut('slow', function(){
                          $(this).remove();
                      })
                  }
              }, (10 * 1000)); // 10 sec
        });

        $(document).on('click', '.rating-undo', function() {
              var $parent = $(this).parents().find('.rating-box');
              $parent.removeClass('rated').removeAttr('data-rating');
              $parent.find('.rating-stars svg').removeClass('fa-star-half low medium high');
              $parent.find('.rating-msg').html('&nbsp;').removeClass('low medium high');
              $parent.find('.rating-advice').html('Ok, Let\'s rate it again!');
        });
    }
}

function setFiles() {
    $(document).on('click', '.previwer > .icon', function() {
        var $previwer = $(this).parent().closest('.previwer')
        ,   nthChild  = $(this).index();
        setPreviwer($previwer, nthChild);
    });

    if ($('.files').length > 0) {
        $('.files').not('.loaded').each(function() {
            var html = '<div class="icon add-new-btn">'
                      +    '<i class="fa fa-file main-icon"></i>'
                      +    '<i class="fa fa-plus sub-icon"></i>'
                      + '</div>';
            $(this).append(html).addClass('loaded');
        });

        $(document).on('click', '.files .add-new-btn', function() {
              var $parent = $(this).parents().find('.files')
              ,   _id     = $parent.attr('id') || 'files_' + $('.files').length;
              $parent.attr('id', _id);
              $('#file-dialog-opener').attr('data-target', _id).trigger('click');
        });

        $(document).on('click', '.files .del-btn', function() {
            $(this).parent('.icon').remove();
        })

        $('#file-dialog-opener').on('change', function() {
            var src = $(this).val() || null;
            if (src != null) {
                var fileInfo= getFileInfo(src)
                ,   fileName= fileInfo['fileName']
                ,   ext     = fileInfo['ext']
                ,   isImg   = isImage(ext)
                ,   isPreview= canPreview(ext)
                ,   _target = $(this).attr('data-target')
                ,   $parent = $('#' + _target)
                ,       _id = 'icon_' + _target +'_'+ $parent.find('.icon').length
                ,      html = '<div class="icon" id="'+ _id +'" title="'+ fileName +'">';
                html +=   '<i class="fa fa-times sub-icon del-btn" title="Remove this item!"></i>';

                if (isImg) {
                      html  += '<img src="#" class="main-icon" />'
                } else if (isPreview) {
                      html  += '<iframe src="#" class="main-icon" style="overflow: hidden;"></iframe>';
                      //html  += '<video class="main-icon" style="overflow: hidden;" controls autoplay width="320" height="240"><source src="#" type="video/'+ ext.toLowerCase() +'"></video>';
                } else {
                      var extText = (ext != '' ? (ext.length > 5 ? ext.substring(0, 3) + '...' : ext) : '...');
                      html  += '<div class="main-icon unknown"><span>'+ extText +'</span><br><span>Preview not available</span></div>';
                }

                html += '</div>';
                $parent.append(html);
                if (isImg || isPreview) {
                  setFilePreview(this, $('#'+_id + ' ' + (isImg ? 'img': 'iframe'))) //'video > source')));
                }
            }
        });
    }
}

function setTabArrow($this) {
    var style = ''
    ,   cls = 'fa-caret-down'
    ,   $parent = $this.parent()
    ,   $tabs = $this.parents().closest('.tabs');
    
    if (typeof $tabs.attr('data-arrow-type') != 'undefined') {
        var tabArrowType = IS_MD_DVC && typeof $tabs.attr('data-alt-arrow-type') != 'undefined' ? $tabs.attr('data-alt-arrow-type') : $tabs.attr('data-arrow-type');
    
        if ($this.siblings('.tab-arrow').length == 0) {
            if (tabArrowType == 'tabs-left') {
                cls = 'fa-caret-left';
                style += 'border-width: 0px 3px 3px 0px;'; // Left Arrow
                style += 'margin-left: -12px; '; /*style += 'margin-left: -5px; ';*/
            } else if (tabArrowType == 'tabs-right') {
                cls = 'fa-caret-right';
                style += 'border-width: 3px 0px 0px 3px;'; // Right Arrow
                style += 'left: ' + ($this.outerWidth(true) + 10) + 'px;';
            } else if (tabArrowType == 'tabs-up') {
                cls = 'fa-caret-up';
                style += 'border-width: 0px 0px 3px 3px;'; // Up Arrow
                style += 'margin-top: -28px;'; /*style += 'margin-top: -15px;';*/
            } else {
                style += 'border-width: 3px 3px 0px 0px;'; // Down Arrow
                style += 'margin-top: '+ (($this.outerHeight(true) / 2) + 15) +'px;';
            }
            $parent.prepend('<i class="tab-arrow fa '+ cls +'" style="'+ style +'"></i>');
        }

        // 20 = 3
        // 30 = 2
        // 10 = 4

        var H = 0
        ,   attr = {display: 'inline-block'}
        ,   idx = $this.index();
        if (tabArrowType == 'tabs-left' || tabArrowType == 'tabs-right') {
            H = $this.outerHeight(true);
            //alert($parent.offset().top + ', ' + $this.offset().top + ', ' + H);
            var T = ($this.offset().top - $parent.offset().top) - ((H/2)-16); //- ((H/(H/16))-16);//((H/3) - (H/2));
            //transformAttr = 'translateY('+ (((idx-1) * H) + (H/2) - 15) +'px)';
            attr['transform'] = 'translateY('+ T +'px)';
            var m = (H-$this.height());
            //attr['margin-top'] = H-(H/((H/32)*1.2)) + 'px';
            //attr['margin-top'] = (H-32)-(H/((H/32)*2)) + 'px';
            //alert(H + ', ' + $this.height());  // (5, 5) => 38, 18 = 3 OK // (5, 10) => 48,18 = 2 OK
        } else {
            H = $this.outerWidth(true);
            //attr['transform'] = 'translateX('+ ($this.offset().left + (H/3) - 15) +'px)';
            attr['left'] = ($this.offset().left + ($this.outerWidth(true) / 10) - 15) + 'px';
        }

        attr['transform'] += ' rotate(-135deg)';
        window.setTimeout(function(){ $this.siblings('.tab-arrow').css(attr); }, 0);
    }
}

function setTabs() {
    $( document ).on( 'click','.tab-header > div', function(e){
        var $this = $(this)
        ,   $tabs = $this.closest('.tabs')
        ,   $tabId = $this.attr('data-target');

        //$tabs.find('.tab.act:first').removeClass('act').fadeOut('slow');
        //alert($($tabId).closest('.row').find('.tab.act').attr('class'))
        $($tabId).closest('.row').find('.tab.act').removeClass('act').fadeOut('slow');
        $tabs.find('.tab-header:first > div').removeClass('active');
        $this.addClass('active');
        $($tabId).addClass('act');
        window.setTimeout(function(){
            $($tabId).fadeIn('slow', function() {
                if ($tabs.hasClass('active') && !$this.hasClass('onpage-load')) {
                    $tabs.find('.tabs .tab-header > div.active').trigger('click');
                }
                $(this).find('[autofocus]').focus();
            });
        }, 500);

        /*if (!$this.hasClass('onpage-load')) {
            var top = Math.floor( $(window).height()/4 );
            if ($this.offset().top > top) {
                //$('html, body').animate({'scrollTop': $('.tabs').offset().top}, 'slow', 'swing');
                $('html, body').animate({scrollTop: $this.offset().top-top}, 1000);
            }
        } else {
            //$this.removeClass('onpage-load');
        }*/
        
        // Set the Arrow
        setTabArrow($this);
        e.preventDefault();
    });

    $('.tabs:first .tab-header > div.active').addClass('onpage-load').trigger('click');
}

function setLocation() {
    
    $('.detect-loc-btn').on('click', function() {
          var $this   = $(this)
          ,   $span   = $this.find('span')
          ,   _target = $this.attr('data-target') || null;

          if (_target != null && $(_target).val() != '' && $this.attr('data-restored') == '1') {
              // Clear Location
              $(_target).val('');
              clearLocation($this);
          } else {
              // Detect current location.
              if (navigator.geolocation) {
                  navigator.geolocation.getCurrentPosition(function(position) {
                      var latitude = position.coords.latitude
                      ,   longitude= position.coords.longitude
                      ,   locInfo  =  {
                          'lat'     : latitude,
                          'lng'     : longitude,
                          'accuracy': position.coords.accuracy
                      };
                      
                      $('body').attr('loc-enabled', 'yes');
                      if ($('#loc-lat-lng').length == 0) {
                          $this.after('<input type="hidden" name="loc_lat_lng" id="loc-lat-lng" value="">');
                      } 
                      
                      if (_target != null) {
                            if ($('#loc-lat-lng').attr('data-loaded') != '1') { 
                                // Already got the address once before.
                                var url = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + locInfo['lat'] + '&lon='+ locInfo['lng'] +'&zoom=18&addressdetails=1';

                                $.get(url, function(res){
                                    $(_target).val(res['address']['city']); // + ', ' + res['address']['state']);

                                    if ($('#loc-lat-lng').val() != '') {
                                        locInfo = JSON.parse($('#loc-lat-lng').val());
                                    }

                                    locInfo['city']     = res['address']['city'];
                                    locInfo['state']    = res['address']['state'];
                                    locInfo['country']  = res['address']['country'];
                                    locInfo['postCode'] = res['address']['postcode'];
                                    locInfo['countryCode'] = res['address']['country_code'];
                                    $('#loc-lat-lng').val(JSON.stringify(locInfo)).attr('data-loaded', '1');
                                });
                            } else if ($('#loc-lat-lng').val() != '') {
                                locInfo = JSON.parse($('#loc-lat-lng').val());
                                $(_target).val(locInfo['city']); // + ', ' + locInfo['state']);
                            }
                            
                            $span.text('Clear My Location');
                            $this.removeClass('active').addClass('danger');
                      }
                      
                      $('#loc-lat-lng').val(JSON.stringify(locInfo));
                      return locInfo;

                  }, function error(msg) {
                        if ($('body').attr('loc-enabled') == 'no') {
                            alert('Please enable your location by clicking the location icon on top right corner of your browser Address bar.');
                        } else {
                            alert('Hint: Enabling your location may helps your Ad. to reach to the most closest customers from your City.');
                            $('body').attr('loc-enabled', 'no');
                        }
                  },
                  {maximumAge:10000, timeout:5000, enableHighAccuracy: true});
              } else {
                  alert("Sorry, Unable to detect your location. Sometime upgrading your browser may helps.");
              }
              
              $this.attr('data-restored', 1);
          }

          return false;
    });

    if (navigator.geolocation && $('.detect-loc-btn').length > 0) {
        $('.detect-loc-btn').trigger('click');
    }
}
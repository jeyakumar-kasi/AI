var sliderLen = $('.slider').length
,   leastHeight  = 100
,   slidersArr = {};

if( sliderLen > 0 ){
    function getSlideOptions( $this ) {
        var sliderId = $this.attr( 'id' )
        ,   dataDelay = $this.attr( 'data-delay' )
        ,   imgLen  = $this.find('img').length
        ,   slideNo = $this.attr( 'slide-no' )
        ,   options = {
            'imgLen'  : imgLen,
            'slideNo' : slideNo
        };

        if( typeof sliderId == 'undefined' ) {
            sliderId = 'slider-'+options.slideNo;
            $this.attr( 'id', sliderId );
        }
        options['sliderId'] = sliderId;

        if( typeof dataDelay == 'undefined' ) {
            dataDelay = 5000;
        }
        options['dataDelay'] = dataDelay;

        var animateDur = Math.floor( dataDelay/4 );
        options['animateDur'] = animateDur;

        return options;
    }

    function slide( $this ) {
        var options = getSlideOptions( $this )
        ,   sliderId = options.sliderId;

        //objToArr( options );

        var timer = window.setInterval(function(){
            var dataId = $('#'+sliderId+' > img.active').attr('data-id');

            // Hide Current Img
            $('#'+sliderId+' > .img-'+dataId).fadeOut( options.animateDur );
            window.setTimeout( function(){
                setSlide( $this, 1 );
            }, (options.animateDur-options.imgLen));
        }, options.dataDelay );

        slidersArr[$(this)] = timer;
        $('#'+sliderId+' .controls svg.fa-play ').removeClass( 'fa-play' ).addClass( 'fa-pause' );
    }

    function setSlide( $this, seek ) {
        var options = getSlideOptions( $this )
        ,   sliderId = options.sliderId
        ,   dataId      = parseInt( $this.find(' > img.active').attr('data-id') );

        if( typeof seek != 'undefined' ) {
            dataId += seek;
        }

        if( dataId >= options.imgLen || seek == 'first' ) {
            // Reached Max Slide
            dataId = 0;
        } else if( dataId < 0 || seek == 'last' ) {
            dataId = options.imgLen-1;
        }

        $('#'+sliderId+' > img.active').fadeOut(function(){
            $(this).removeClass('active');
            $('#'+sliderId+' > .img-'+dataId).fadeIn( options.animateDur ).addClass('active');
            $('#'+sliderId+' .controls .count').html( '<span>'+(dataId+1) + '</span>/'+options.imgLen );
        });

    }

    $('.slider').each(function(i, key){
        $(this).attr( 'slide-no', i );

        var options = getSlideOptions( $(this) )
        ,   sliderId = options.sliderId
        ,   maxHeight = $(this).width()
        ,   minHeight = maxHeight;

        $('#'+sliderId+' > img').each(function(k){
            $(this).attr('data-id', k).attr('class', 'img-'+k);

            if( $(this).height() > minHeight ) {
                minHeight = $(this).height();
            }
        })

        if( minHeight > maxHeight ) {
            minHeight = maxHeight;
        }

        if( minHeight < leastHeight ) {
            minHeight = leastHeight;
        }

        $('#'+sliderId).css({'height': minHeight+'px', 'min-height': minHeight+'px', 'min-width': minHeight+'px'});
        $('#'+sliderId+' > img').css({ 'max-height': minHeight+'px' });
        //$('#'+sliderId+' > .controls').css({ 'top': (minHeight+145)+'px', 'width' : $('#'+sliderId).width()+'px' });
        $('#'+sliderId+' > .controls').css({ 'top': (minHeight)+'px', 'width' : $('#'+sliderId).width()+'px' });

        $('#'+sliderId+' > img:first').addClass('active');

        if( options.imgLen > 1 ) {
            $('#'+sliderId+' .controls').slideDown('slow');
            slide( $(this) );
        }
    }); // each

    $(document).on('click', '.controls svg', function(){
        var $slider = $(this).parents('.slider');
        window.clearInterval( slidersArr[$slider] );
        if( $(this).hasClass( 'fa-pause' ) ) {
            // Pause
            $(this).removeClass( 'fa-pause' ).addClass( 'fa-play' );
        }else if( $(this).hasClass( 'fa-play' ) ) {
            // Play
            slide( $slider );
        }else {

            if( $(this).hasClass( 'fa-chevron-right' ) ) {
                // Next Slide
                setSlide( $slider, 1 );
                //slide( $slider );
            } else if( $(this).hasClass( 'fa-chevron-left' ) ) {
                // Prev Slide
                setSlide( $slider, -1 );
                //slide( $slider );
            } else if( $(this).hasClass( 'fa-fast-forward' ) ) {
                // Last Slide
                setSlide( $slider, 'last' );
                //slide( $slider );
            } else if( $(this).hasClass( 'fa-fast-backward' ) ) {
                // Last Slide
                setSlide( $slider, 'first' );
                //slide( $slider );
            }
            $slider.find('.controls .fa-pause').removeClass( 'fa-pause' ).addClass( 'fa-play' );
        }
    });
}

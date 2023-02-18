
$(function() {
    $('#post-tabs .tab-header > div').on( 'click', function(e){
        var tabId = $(this).attr('data-target')
        ,   data = {
            action: 'get-posts',
            type: getVarName(tabId)
        }
        $.get(siteURL + '/ajax/common.php', data, function(results) {
            $(tabId).html(results);
        });
    });
    
    $('#browse-states-list').on('change', function() {
        var data = {
            action: 'get-cities',
            stateCode: $(this).val(),
            isValid: true
        }
        $.get(siteURL + '/ajax/common.php', data, function(results) {
//            var results = JSON.parse(results);
//            console.log(results);
            $('#browse-by-location .container .row:first').html(results);
        });
    }); 
    
});

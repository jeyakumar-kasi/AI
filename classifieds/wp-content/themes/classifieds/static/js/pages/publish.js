/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    $('#category').on('change', function() {
        var data = {
            action: 'get-sub-cats',
            categoryId: $(this).val(),
            isValid: true
        }
        $.get(siteURL + '/ajax/common.php', data, function(res) {
            res = JSON.parse(res);
            var html = '<option value="" readonly="">-- Options --</option>';
            if (res['statusCode'] == 200) {
                var results = res['results'];
                if (results.length > 0) {
                    results = results[0]; 
                    console.log(results);
                    if (results['sub_cat_count'] > 0) {
                        Object.keys(results['children']).map(function(k, v) {
                            html += '<option value="'+ v['_id'] +'">'+ v['label'] +'</option>';
                        });
                    }
                }
            }
            $('#sub-category').html(html);
        });
    });
});



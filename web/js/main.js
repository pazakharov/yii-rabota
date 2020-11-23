$(function () {
    $('.vakancy-btn').click(function () {
        $(this).find('.arrowDown').toggleClass('rotate blue');
        $(this).toggleClass('blue');
    });

    $('.vakancy-btn').blur(function () {
        $(this).find('.arrowDown').removeClass('rotate blue');
        $(this).removeClass('blue');
    });
});

$(function () {
    $('.arrow-toggle-down-btn').click(function () {
        $(this).find('.arrowDown').toggleClass('rotate');
    });

    $('.arrow-toggle-down-btn').blur(function () {
        $(this).find('.arrowDown').removeClass('rotate');
    });
});

$(function () {
    $('.nselectlist-static').nSelect();
    $('#no-filter').editableSelect({
        filter: false
    });
    $('.dpicker').datepicker({
        language: "ru",
        todayHighlight: true
    });
});

$(function () {
    $('.vacancy-filter-btn').click(function () {
        $('.vakancy-page-filter-block').toggleClass('vakancy-page-filter-block-dnone dblock scroll');
        $('body').toggleClass('cover');
        $(this).addClass('opacity-none');
    });
});

$(function () {
    $('.vakancy-page-filter-block__row img').click(function () {
        $('.vakancy-page-filter-block').toggleClass('vakancy-page-filter-block-dnone dblock scroll');
        $('body').toggleClass('cover');
        $('.vacancy-filter-btn').removeClass('opacity-none');
    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(function () {
    $('.navigation-toggler').click(function () {
        $(this).toggleClass('change');
        $('.navigation-menu__mobile').toggleClass('navigation-menu__mobile-width');
        $('body').toggleClass('cover');
    });
});

$(function () {
    $('.vakancy-page-block__flag-img img').hover(function () {
        var el = $(this)
        el.data('orig', el.attr('src'))
        el.attr('src', el.data('img2'))
    }, function () {
        $(this).attr('src', $(this).data('orig'))
    })
});

$(function () {
    $("input:radio[name='radio-group3']").click(function () {
        $('.hide-block').hide();
        $('#' + $("input:radio[name='radio-group3']:checked").val()).show();
    });
});


$(function () {
    $("#fotochooser").click(function () {
        $("#resumeFotoFile").click( );
    });
});

$(function () {
    $('#resumeFotoFile').on("change", function () {
        $.ajax({
            type: 'POST',
            url: UrlFotoForm,
            data: new FormData(document.getElementById("resumeFotoForm")),
            processData: false,
            contentType: false,
            success: function (response) {
                $("#resumeimg").attr("src",response);
                $("#resume-foto").attr("value",response);
            }
        });
    });
});

$(function () {

    $('input:radio[name="Resume[opyt_check]"]').on('change', function (){
        if ($(this).val() === '0') {
            
              $('#exp_div').slideUp("slow");      
              $('#add_div').slideUp("slow");     

        }else{
          
              $('#exp_div').slideDown("slow");      
              $('#add_div').slideDown("slow");      
        }
    });

});

$(function () {

    $('body').on('click', '#add', function (){

       var index =  $('.mesto').length ;
       
                          
        $($($($('#stamp').html()).hide()).appendTo('#exp_div')).slideDown('2000'); 
       
        $('#exp_div .mesto:last').html($('#exp_div .mesto:last').html().replace(/iteration/g, index));
         
       
        $('#exp_div .mesto:last .nselectlist').nSelect();
        

    }); 
    
    $('body').on('change', '[id^="Date2-check-"]', function (){

        //alert ($(this).attr('index'));
        if($('input[index='+ $(this).attr('index') +']').prop("checked")){
           
            $('div[index='+ $(this).attr('index') +']').slideUp('slow');
        
        }else{
            
            $('div[index='+ $(this).attr('index') +']').slideDown('slow');
        }        
        
    });

});

$(function () {

    $('body').on('click','.delbutton', function (e){
        
        $(this).closest('.mesto').slideUp('2000', function (e){
            $(this).closest('.mesto').remove();
        } );
        

    });

});
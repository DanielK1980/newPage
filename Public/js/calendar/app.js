jQuery(function ($) {

    var options = {
        events_source: 'events.json.php',
        view: 'month',
        tmpl_path: 'Public/tmpls/',
        tmpl_cache: false,
        day: '2018-06-11',
        onAfterEventsLoad: function (events) {
            if (!events) {
                return;
            }
            var list = $('#eventlist');
            list.html('');

            $.each(events, function (key, val) {
                $(document.createElement('li'))
                        .html('<a href="' + val.url + '">' + val.title + '</a>')
                        .appendTo(list);
            });
        },
        onAfterViewLoad: function (view) {
            $('.page-header h3').text(this.getTitle());
            $('.btn-group button').removeClass('active');
            $('button[data-calendar-view="' + view + '"]').addClass('active');

            var newmonth = this.options.position.start.getMonth() + 1;
            var startdate = this.options.position.start.getFullYear() + '-' + (newmonth < 10 ? '0' + newmonth : newmonth) + '-' + '01';
            var enddate = new Date(this.options.position.start.getFullYear(), newmonth, 1);// this.options.position.start.getFullYear() + '-' + (newmonth < 10 ? '0' + newmonth : newmonth) + '-' + this.options.classes.months;
            /*
             $.ajax({
             type: "POST",
             data: {
             datestart:startdate,
             dateend:enddate.toISOString().slice(0,10)
             },
             url: "PHPClass/AttandanceHandler.php",
             dataType: "JSON",
             async: false,
             success: function(data){
             var i = 0;
             var j = 0;
             for(i = 0; data.wynik.length > i;i++){
             
             for(j = 0; data.wynik[i].work.length > j;j++){                                                     
             $("#resp-"+data.wynik[i].day+"")
             .append(data.wynik[i].work[j].type+ " :  " + data.wynik[i].work[j].timestart + " :  " + data.wynik[i].work[j].timeend + "<br>" );
             }
             
             }                                           
             
             }
             });
             */

        },
        classes: {
            months: {
                general: 'label'
            }
        }/*,
         $(this).setLanguage('pl-PL')*/
    };

    var calendar = $('div#calendar').calendar(options);
   
     $('.btn-group button[data-calendar-nav]').each(function() {
     var $this = $(this);
     $this.click(function() {
     calendar.navigate($this.data('calendar-nav'));
     });
     });
     
     $('.btn-group button[data-calendar-view]').each(function() {
     var $this = $(this);
     $this.click(function() {
     calendar.view($this.data('calendar-view'));
     });
     });
     
     $('#first_day').change(function(){
     var value = $(this).val();
     value = value.length ? parseInt(value) : null;
     calendar.setOptions({first_day: value});
     calendar.view();
     });
     
     $('#language').change(function(){
     calendar.setLanguage($(this).val());
     calendar.view();
     });
     
     $('#events-in-modal').change(function(){
     var val = $(this).is(':checked') ? $(this).val() : null;
     calendar.setOptions({modal: val});
     });
     $('#format-12-hours').change(function(){
     var val = $(this).is(':checked') ? true : false;
     calendar.setOptions({format12: val});
     calendar.view();
     });
     $('#show_wbn').change(function(){
     var val = $(this).is(':checked') ? true : false;
     calendar.setOptions({display_week_numbers: val});
     calendar.view();
     });
     $('#show_wb').change(function(){
     var val = $(this).is(':checked') ? true : false;
     calendar.setOptions({weekbox: val});
     calendar.view();
     });
     $('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
     //e.preventDefault();
     //e.stopPropagation();
     });
    
});


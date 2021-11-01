$(document).ready(function () {
    function bindModalFunctions() {
        $('#call_date, #start_date, #end_date, #datetimepicker1').datetimepicker({
            allowInputToggle: true,
            locale: 'fr',
            format: 'YYYY-MM-DD HH:mm',
            stepping: 15,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
        $('#start_date').on('change.datetimepicker', (e) => {
            if (e.date) {
                if (!e.oldDate || e.date.dayOfYear() !== e.oldDate.dayOfYear()) {
                    $('#invoice_number').val(e.date.format('YYYYMMDD') + 'A');
                }
            }
            console.log('change.datetimepicker');
        });

        $('.autonumeric').autoNumeric('init');

        function calculateTotal() {
            var price = parseInt($('#price').val())
            var booking_fees = parseInt($('#booking_fees').val())
            $('#total').val(price + booking_fees);
        }
        calculateTotal();
        $('#booking_fees, #price').on('change', calculateTotal);
        $('#select_guest_number').change(function () {
            $('#guest_number').val($(this).val());
        })

        const endpoint = '/clients/get-clients-json';
        const clients = [];
        fetch(endpoint)
        .then(blob => blob.json())
        .then(data => clients.push(...data));

        var input = document.getElementById("client_search");
        if (input) {
            autocomplete({
                input: input,
                disableAutoSelect: true,
                fetch: function (text, update) {
                    text = text.toLowerCase();
                    // you can also use AJAX requests instead of preloaded data
                    // var suggestions = clients.filter(n => n.label.toLowerCase().startsWith(text));
                    var suggestions = clients.filter(client => {
                        const regex = new RegExp(text, 'gi')
                        return client.label.match(regex);
                        // n.label.toLowerCase().startsWith(text)

                    })
                    update(suggestions);
                },
                render: function (item, currentValue) {
                    var div = document.createElement("div");
                    div.textContent = item.label;
                    if (item.rating === 'accept') {
                        div.classList = 'bg-success';
                    } else if (item.rating === 'warning') {
                        div.classList = 'bg-warning';
                    } else if (item.rating === 'block') {
                        div.classList = 'bg-danger';
                    }
                    return div;
                },
                onSelect: function (item) {
                    input.value = '';
                    document.getElementById("client.id").value = item.id;
                    document.getElementById("client_id").value = item.id;
                    document.getElementById("enterprise_name").value = item.enterprise_name;
                    document.getElementById("firstname").value = item.firstname;
                    document.getElementById("lastname").value = item.lastname;
                    document.getElementById("telephone").value = item.telephone;
                    document.getElementById("email").value = item.email;
                    document.getElementById("notes").value = item.notes;
                    document.getElementById(item.rating).checked = true;

                    document.getElementById('current_client_id').textContent = 'ID Client: ' + item.id;
                    $('#current_client_id').removeClass('hide');
                    $('#new_client_id').addClass('hide');
                }
            });
        }


        $('#new_client').click(function () {
            document.getElementById("client.id").value = '';
            document.getElementById("client_id").value = '';
            document.getElementById("enterprise_name").value = '';
            document.getElementById("firstname").value = '';
            document.getElementById("lastname").value = '';
            document.getElementById("telephone").value = '';
            document.getElementById("email").value = '';
            document.getElementById("notes").value = '';
            document.getElementById('accept').checked = true;

            $('#new_client_id').removeClass('hide');
            $('#current_client_id').addClass('hide');
        })
    }


    scheduler.showLightbox = function (id) {
        let event = scheduler.getEvent(id);
        let url = '/reservations/' + id + '/editxhr';
        if (id > 100000000) {
            url = '/reservations/createxhr'
        }
        $.ajax({
            url: url,
            dataType: 'html'
        }).done(function (data) {
            $('#form_lightbox').html(data);
            let reservationForm = document.getElementById('scheduler_reservation_lightbox');
            $('#scheduler_reservation_lightbox').modal('show');
            scheduler.startLightbox(id, reservationForm);
            bindModalFunctions();
        });
    }
    scheduler.attachEvent("onEventAdded", function(id,ev){
        console.log([id, ev.start_date]);
        scheduler.showLightbox(id);

        //any custom logic here
    });
    function close_form() {
        scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
    }
    function delete_event() {
        var event_id = scheduler.getState().lightbox_id;
        scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
        scheduler.deleteEvent(event_id);
    }
    //Scheduler Config
    scheduler.config.all_time = 'short'
    scheduler.config.time_step = 15;
    scheduler.config.start_on_monday = true;
    scheduler.locale.labels.day_tab = "Jour";
    scheduler.locale.labels.week_tab = "Semaine";
    scheduler.locale.labels.month_tab = "Mois";
    scheduler.attachEvent("onBeforeViewChange", function (old_mode, old_date, mode, date) {
        if (mode === "month")
            scheduler.config.dblclick_create = false;
        if (mode !== "month")
            scheduler.config.dblclick_create = true;
        return true;
    });
    scheduler.attachEvent("onBeforeDrag", function (id, mode, e) {
        var schedMode = scheduler.getState().mode;
        if (schedMode === "month") {
            return false;
        }
        return true;
    });
    scheduler.attachEvent("onDblClick", function (id, e) {
        var schedMode = scheduler.getState().mode;
        if (schedMode === "month") {
            return false;
        }
        return false;
    })
    // different configs for different screen sizes
    var compactView = {
        xy: {
            nav_height: 80
        },
        config: {
            header: {
                rows: [
                    {
                        cols: [
                            "prev",
                            "date",
                            "next",
                        ]
                    },
                    {
                        cols: [
                            "day",
                            "week",
                            "month",
                            "spacer",
                            "today"
                        ]
                    }
                ]
            }
        },
        templates: {
            month_scale_date: scheduler.date.date_to_str("%D"),
            week_scale_date: scheduler.date.date_to_str("%D, %j"),
            event_bar_date: function(start,end,ev) {
                return "";
            }

        }
    };
    var fullView = {
        xy: {
            nav_height: 80
        },
        config: {
            header: [
                "day",
                "week",
                "month",
                "date",
                "prev",
                "today",
                "next"
            ]
        },
        templates: {
            month_scale_date: scheduler.date.date_to_str("%l"),
            week_scale_date: scheduler.date.date_to_str("%l, %F %j"),
            event_bar_date: function(start,end,ev) {
                return "• <b>"+scheduler.templates.event_date(start)+"</b> ";
            }
        }
    };

    function resetConfig(){
        var settings;
        if(window.innerWidth < 1000){
            settings = compactView;
        }else{
            settings = fullView;

        }
        scheduler.utils.mixin(scheduler.config, settings.config, true);
        scheduler.utils.mixin(scheduler.templates, settings.templates, true);
        scheduler.utils.mixin(scheduler.xy, settings.xy, true);
        return true;
    }

    scheduler.config.responsive_lightbox = true;
    resetConfig();
    scheduler.attachEvent("onBeforeViewChange", resetConfig);
    scheduler.attachEvent("onSchedulerResize", resetConfig);
    scheduler.templates.event_class = function (start, end, ev) {
        return 'event_' + ev.reservation_type;
    }
    scheduler.init("scheduler");
    scheduler.load('/reservations/get-reservations');

    $('#scheduler_reservation_lightbox').on('submit', '#reservation_form', function(e){
        e.preventDefault()

        let form = $('#reservation_form');
        //
        $.ajax({
            url: form.attr('action'),
            type:"POST",
            data: form.serialize(),
            success:function(response){
                var ev = scheduler.getEvent(scheduler.getState().lightbox_id);
                let event = ev;
                // scheduler.changeEventId(ev.id, )
                ev.text = document.getElementById("enterprise_name").value;
                // ev.custom1 = html("custom1").value;
                // ev.custom2 = html("custom2").value;
                $('#scheduler_reservation_lightbox').modal('hide');
                scheduler.endLightbox(true, document.getElementById('scheduler_reservation_lightbox'));
                // $('#successMsg').show();
                console.log(response);
            },
            error: function(response) {
                console.log(response.responseJSON.errors);
                $('#reservation_errors').show();
                $('#reservation_errors ul').html('');
                for (var error in response.responseJSON.errors) {
                    $('#reservation_errors ul').append('<li>' + response.responseJSON.errors[error] + '</li>')
                }
                $(window).scrollTop(0);
            },
        });
    });
    $('#scheduler_reservation_lightbox').on('submit', '#delete_reservation_form', function(e){
        let form = $('#delete_reservation_form');
        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: form.serialize(),
            success: function (response) {
                var event_id = scheduler.getState().lightbox_id;
                scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
                $('#scheduler_reservation_lightbox').modal('hide');
                scheduler.deleteEvent(event_id);
            }
        })
    })
    $('#scheduler_reservation_lightbox').on('hidden.bs.modal', function() {
        scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
    });

});

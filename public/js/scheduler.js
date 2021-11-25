$(document).ready(function () {
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
            if (id > 100000000) {
                let start_date = moment(event.start_date).hours(9).minutes(0);
                $('#start_date').val(start_date.format('YYYY-MM-DD HH:mm'));
                let end_date = start_date.hours(24).minutes(0);
                $('#end_date').val(end_date.format('YYYY-MM-DD HH:mm'));
            }
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
            nav_height: 80,
            scale_height: 40
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
            week_scale_date: function(date) {
                return scheduler.date.date_to_str('%j')(date) + '<br/>' + scheduler.date.date_to_str('%D')(date);
            },
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
            month_scale_date: scheduler.date.date_to_str("%D"),
            week_scale_date: scheduler.date.date_to_str("%D, %M %j"),
            event_bar_date: function(start,end,ev) {
                return "• <b>"+scheduler.templates.event_date(start)+"</b> ";
            }
        }
    };

    function resetConfig() {
        var settings;
        if (window.innerWidth < 1000) {
            settings = compactView;
        } else {
            settings = fullView;
        }
        scheduler.utils.mixin(scheduler.config, settings.config, true);
        scheduler.utils.mixin(scheduler.templates, settings.templates, true);
        scheduler.utils.mixin(scheduler.xy, settings.xy, true);
        return true;
    }
    resetConfig();
    scheduler.attachEvent("onBeforeViewChange", resetConfig);
    scheduler.attachEvent("onSchedulerResize", resetConfig);
    scheduler.templates.event_class = function (start, end, ev) {
        return 'event_' + ev.reservation_type;
    }
    //Scheduler Config
    scheduler.config.all_timed = "short";
    scheduler.config.multi_day = true;
    scheduler.config.limit_time_select = true;
    scheduler.config.time_step = 15;
    scheduler.config.start_on_monday = true;
    scheduler.locale.labels.day_tab = "Jour";
    scheduler.locale.labels.week_tab = "Semaine";
    scheduler.locale.labels.month_tab = "Mois";
    scheduler.config.responsive_lightbox = true;
    scheduler.init("scheduler");
    scheduler.load('/reservations/get-reservations');

    function reservationLabel(enterprise_name, firstname, lastname, telephone, email) {
        let label = '';
        if (enterprise_name) {
            label = enterprise_name += '<br/>';
        }
        label += firstname + ' ' + lastname + '<br/>' + telephone;
        if (email) {
            label += '<br/>' + email;
        }
        return label;
    }
    $('#scheduler_reservation_lightbox').on('submit', '#reservation_form', function(e){
        e.preventDefault()
        $('#reservation_form').data('changed', false);
        let form = $('#reservation_form');
        //
        $.ajax({
            url: form.attr('action'),
            type:"POST",
            data: form.serialize(),
            success:function(response){
                let client = response.client;
                var event = scheduler.getEvent(scheduler.getState().lightbox_id);
                // let event = ev;
                scheduler.changeEventId(event.id, response.id);
                event.start_date = moment(response.start_date).toDate();
                event.end_date = moment(response.end_date).toDate();
                event.text = reservationLabel(client.enterprise_name, client.firstname, client.lastname, client.telephone, client.email);
                scheduler.updateEvent(event.id);


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
                    if ($.isArray(response.responseJSON.errors[error])) {
                        for (var index in response.responseJSON.errors) {
                            $('#reservation_errors ul').append('<li>' + response.responseJSON.errors[error][index] + '</li>')
                        }
                    } else {
                        $('#reservation_errors ul').append('<li>' + response.responseJSON.errors[error] + '</li>')
                    }
                }
                $('#scheduler_reservation_lightbox').scrollTop(0)
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
                $('#reservation_form').data('changed', false);
                var event_id = scheduler.getState().lightbox_id;
                scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
                $('#scheduler_reservation_lightbox').modal('hide');
                scheduler.deleteEvent(event_id);
            }
        })
    })
    $('#scheduler_reservation_lightbox').on('click', '#cancelChanges', function() {
        if ($('#reservation_form').data('changed')) {
            $('#modalCancelChanges').modal('show');
        } else {
            $('#modalCancelChanges').modal('hide');
            $('#scheduler_reservation_lightbox').modal('hide');
            scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
        }
    });
    $('#modalCancelChanges').on('click', '#cancelChangesAccept', function() {
        $('#reservation_form').data('changed', false);
        $('#modalCancelChanges').modal('hide');
        $('#scheduler_reservation_lightbox').modal('hide');
        scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
    });
    $('#scheduler_reservation_lightbox').on('click', '#dismissDeleteModal', function() {
        $('#modalDelete').modal('hide');
    });
    $('#scheduler_reservation_lightbox').on('hide.bs.modal', function(e) {

        if (e.target.id === 'scheduler_reservation_lightbox') {
            if ($('#reservation_form').data('changed')) {
                alert('Dess changements ont été apporté à la réservation');
                return false;
            } else {
                scheduler.endLightbox(false, document.getElementById('scheduler_reservation_lightbox'));
            }
        }
    });

});

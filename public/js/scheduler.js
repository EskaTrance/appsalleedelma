$(document).ready(function () {
    scheduler.config.all_time = 'short'
    // scheduler.showLightbox = function (id) {
    //     $.ajax({
    //         url: '/reservations/' + id + '/edit',
    //         dataType: 'html'
    //     }).done(function (data) {
    //         // let reservationForm = $('#reservation_form');
    //         // reservationForm.html(data);
    //         // let reservationForm = document.getElementById('reservation_form');
    //         // reservationForm.innerHtml = data;
    //         // scheduler.startLightbox(id, reservationForm.get(0));
    //     });
    //     let ev = scheduler.getEvent(id);
    //
    //     // html("description").focus();
    //     // html("description").value = ev.text;
    //     // html("custom1").value = ev.custom1 || "";
    //     // html("custom2").value = ev.custom2 || "";
    //
    // };
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
    scheduler.load('/reservations/get-reservations')
});

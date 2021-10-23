$(document).ready(function() {
    scheduler.config.all_time = 'short'
    scheduler.showLightbox = function (id) {
        $.ajax({
            url: '/reservations/' + id + '/edit',
            dataType: 'html'
        }).done(function (data) {
            let reservationForm = $('#reservation_form');
            reservationForm.html(data);
            // let reservationForm = document.getElementById('reservation_form');
            // reservationForm.innerHtml = data;
            scheduler.startLightbox(id, reservationForm.get(0));
        });
        let ev = scheduler.getEvent(id);

        // html("description").focus();
        // html("description").value = ev.text;
        // html("custom1").value = ev.custom1 || "";
        // html("custom2").value = ev.custom2 || "";

    };
    scheduler.templates.event_class = function(start, end, ev) {
        return ev.type;
    }
    scheduler.init("scheduler");
    scheduler.load('/reservations/get-reservations')
});

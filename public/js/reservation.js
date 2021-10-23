// $(function() {
(function ($) {

    'use strict';
    $(document).ready(function () {
        $('#datetimepicker12').datetimepicker({
            inline: true,
            sideBySide: true,
            icons: {
                time: "fa fa-clock",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
        });
        // $('#datetimepicker12').on('change', (event) => {
        //     console.log('change');
        // })
        //
        // $('#datetimepicker12').on('change.datetimepicker', (event) => {
        //     console.log('change.datetimepicker');
        // })
        // $('#call_date, #end_date').datetimepicker({
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
        // $('#start_date, #end_date').datetimepicker({
        //     allowInputToggle: true,
        //     locale: 'fr',
        //     format: 'YYYY-MM-DD HH:mm',
        //     stepping: 15
        // });
        $('.autonumeric').autoNumeric('init');
        $('#select_guest_number').change(function () {
            $('#guest_number').val($(this).val());
        })

        const endpoint = '/clients/get-clients-json';
        const clients = [];
        fetch(endpoint)
        .then(blob => blob.json())
        .then(data => clients.push(...data));

        var input = document.getElementById("client_search");
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
    });
})(window.jQuery);
// })

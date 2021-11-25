// $(function() {
(function ($) {

    'use strict';
    $(document).ready(function () {
        window.bindModalFunctions = function bindModalFunctions() {
            $('#call_date, #start_date, #end_date, #security_deposit_return_date, #security_deposit_paid_date').datetimepicker({
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
            $('#repeat_end').datetimepicker({
                allowInputToggle: true,
                locale: 'fr',
                format: 'YYYY-MM-DD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
            $('#security_deposit_return_date').on('show.datetimepicker', (e) => {
                if (!e.oldDate) {
                    let end_date = $('#end_date').val();
                    if (moment(end_date).isValid()) {
                        end_date = moment(end_date).set('hours', moment().hours()).set('minutes', moment().minutes()).add(1, 'days');
                        $('#security_deposit_return_date').val(end_date.format('YYYY-MM-DD HH:mm'));
                    }
                }
            });
            $('#start_date').on('change.datetimepicker', (e) => {
                var end_date = $('#end_date').val();
                if (!moment(end_date).isValid() || e.date > moment(end_date) || (e.oldDate && e.date.dayOfYear() !== e.oldDate.dayOfYear())) {
                    let start_date = moment(e.date);
                    let end_date = start_date.hours(24).minutes(0);
                    $('#end_date').val(end_date.format('YYYY-MM-DD HH:mm'));
                }
                generateInvoiceNumber();
            });
            function generateInvoiceNumber() {
                var price = parseInt($('#price').val());
                var booking_fees = parseInt($('#booking_fees').val());
                var security_deposit = parseInt($('#security_deposit').val());
                var start_date = $('#start_date').val();

                if ($('input[name=reservation_type]:checked').val() === 'reservation' && price + booking_fees + security_deposit > 0 && moment(start_date).isValid()) {
                    $('#invoice_number').val(moment(start_date).format('YYYYMMDD') + 'A');
                } else {
                    $('#invoice_number').val('');
                }
            }
            $('.phone-mask').inputmask({"mask": "(999) 999-9999"});
            $('.autonumeric').autoNumeric('init');
            $('#firstname, #lastname').on('keyup', function() {
                $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1));
            });

            function calculateTotal() {
                var price = parseInt($('#price').val())
                var booking_fees = parseInt($('#booking_fees').val())
                $('#total').val(price + booking_fees);
            }
            calculateTotal();
            $('#booking_fees, #price').on('change', calculateTotal);
            $('#booking_fees, #price, #security_deposit, input[name=reservation_type]').on('change', generateInvoiceNumber);
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
                        document.getElementById("cellphone1").value = item.cellphone1 ? item.cellphone1 : '';
                        document.getElementById("cellphone2").value = item.cellphone2 ? item.cellphone2 : '';
                        document.getElementById("email").value = item.email;
                        document.getElementById("client_notes").value = item.notes;
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
                document.getElementById("cellphone1").value = '';
                document.getElementById("cellphone2").value = '';
                document.getElementById("email").value = '';
                document.getElementById("client_notes").value = '';
                document.getElementById('accept').checked = true;

                $('#new_client_id').removeClass('hide');
                $('#current_client_id').addClass('hide');
            })
            $('#reservation_form :input, #reservation_form textarea').change(function() {
                $('#reservation_form').data('changed', true);
            })
        }
        if ($('#reservation_form').length) {
            bindModalFunctions();
        }
    });
})(window.jQuery);
// })

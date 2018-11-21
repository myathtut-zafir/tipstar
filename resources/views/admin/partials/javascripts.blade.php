<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script src="{{ url('quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ url('quickadmin/js') }}/main.js"></script>

<script>

    $('.datepicker').datepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}"
    });

    $('.datetimepicker').datetimepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}",
        timeFormat: "{{ config('quickadmin.time_format_jquery') }}"
    });

    $('#datatable').dataTable({
        "language": {
            "url": "{{ trans('quickadmin::strings.datatable_url_language') }}"
        }
    });


    $('#league').on('change', function (e) {
        let leagueId;
        leagueId = $("#league option:selected").val();
//            #ajax
        $.get('/ajax-team?leagueId=' + leagueId, function (data) {
            $('#home_team').empty();
            $('#away_team').empty();

            $.each(data, function (index, subdetailObj) {
                $('#home_team').append('<option value="' + subdetailObj.team_name + '">' + subdetailObj.team_name + '</option>');
            });
            $.each(data, function (index, subdetailObj) {
                $('#away_team').append('<option value="' + subdetailObj.team_name + '">' + subdetailObj.team_name + '</option>');
            });
        });
    });
    $('#home_team').on('change', function (e) {
        let leagueId;
        leagueId = $("#home_team option:selected").val();
//            #ajax
        $("#away_team option[value=" + leagueId + "]").remove();

    });
</script>

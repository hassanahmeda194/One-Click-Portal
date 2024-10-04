<script>
    (function ($) {
        $('form').attr('autocomplete', 'off');
        $('input').attr('autocomplete', 'off');
        $('.Phone-Number').mask("(+99) 999 9999999");
        $('.CNIC-Number').mask("99999 - 9999999 - 9");
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        $('.min-date').attr('min', today);
        function showLoader() {
            var html = '<div class="dimmer active loader"><div class="spinner4"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>';
            var loader = $(html);
            $('body').append(loader);
        }
     
    })(jQuery);
</script>


@if (Session::has('Success!'))
    <script>
        $('.loader').remove();
        not1('{!! Session::get('Success!') !!}');
    </script>
@endif
@if (Session::has('Error!'))
    <script>
        $('.loader').remove();
        not2('{!! Session::get('Error!') !!}');
    </script>
@endif
@if (Session::has('Warning!'))
    <script>
        $('.loader').remove();
        not3('{!! Session::get('Warning!') !!}');
    </script>
@endif
@if (Session::has('Info!'))
    <script>
        $('.loader').remove();
        not4('{!! Session::get('Info!') !!}');
    </script>
@endif

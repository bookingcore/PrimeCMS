<script>
    var Prime = {
        url: '{{url('/')}}',
        admin_url: '{{route('admin.index')}}',
        csrf: '{{csrf_token()}}',
        date_format: '{{get_moment_date_format()}}',
        isAdmin: {{is_admin() ? 1 : 0}},
        currentUser: {{(int)Auth::id()}},
        media: {
            groups: {!! json_encode(config('bc.media.groups')) !!},
        },
        language: '{{ app()->getLocale() }}',
    };
    var i18n = {
        warning: "{{__("Warning")}}",
        success: "{{__("Success")}}",
        confirm_delete: "{{__("Do you want to delete?")}}",
        confirm_recovery: "{{__("Do you want to restore?")}}",
        confirm: "{{__("Confirm")}}",
        cancel: "{{__("Cancel")}}",
        custom_range: "{{ __("Custom Range") }}",
        apply: "{{ __("Apply") }}",
    };
    var daterangepickerLocale = {
        'applyLabel': "{{__('Apply')}}",
        'cancelLabel': "{{__('Cancel')}}",
        'fromLabel': "{{__('From')}}",
        'toLabel': "{{__('To')}}",
        'customRangeLabel': "{{__('Custom')}}",
        'weekLabel': "{{__('W')}}",
        'first_day_of_week': {{ setting_item("site_first_day_of_the_weekin_calendar","1") }},
        'daysOfWeek': [
            "{{__('Su')}}",
            "{{__('Mo')}}",
            "{{__('Tu')}}",
            "{{__('We')}}",
            "{{__('Th')}}",
            "{{__('Fr')}}",
            "{{__('Sa')}}",
        ],
        'monthNames': [
            "{{__('January')}}",
            "{{__('February')}}",
            "{{__('March')}}",
            "{{__('April')}}",
            "{{__('May')}}",
            "{{__('June')}}",
            "{{__('July')}}",
            "{{__('August')}}",
            "{{__('September')}}",
            "{{__('October')}}",
            "{{__('November')}}",
            "{{__('December')}}",
        ],
    };
</script>

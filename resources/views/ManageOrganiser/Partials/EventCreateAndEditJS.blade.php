{!! HTML::script('vendor/simplemde/dist/simplemde.min.js') !!}
{!! HTML::style('vendor/simplemde/dist/simplemde.min.css') !!}

{!! HTML::script('assets/javascript/bootstrap-switch.min.js') !!}
{!! HTML::style('assets/stylesheet/bootstrap-switch.min.css') !!}

{!! HTML::style('assets/stylesheet/activity.css') !!}



<script>
    $(function() {
        try {
            $(".geocomplete").geocomplete({
                    details: "form.gf",
                    types: ["geocode", "establishment"]
                }).bind("geocode:result", function(event, result) {
                    console.log(result);
            }, 1000);

        } catch (e) {
            console.log(e);
        }

        $('.editable').each(function() {
            var simplemde = new SimpleMDE({
                element: this,
                spellChecker: false,
                status: false
            });
            simplemde.render();
        })

        $("#DatePicker").remove();
        var $div = $("<div>", {id: "DatePicker"});
        $("body").append($div);
        $div.DateTimePicker({
            dateTimeFormat: window.Attendize.DateTimeFormat
        });

        $("#is_activity").bootstrapSwitch({
            onText: 'Yes',
            onColor: 'success',
            offText: 'No',
            offColor: 'warning',
            labelWidth: 10,
        }).on('switchChange.bootstrapSwitch', function(event, is_activity) {
          $('#event_date_fields').toggle(500);
          $('#activity_date_fields').toggle(500);
        });


    });


</script>
<style>
    .editor-toolbar {
        border-radius: 0 !important;
    }
    .CodeMirror, .CodeMirror-scroll {
        min-height: 100px !important;
    }

    .create_organiser, .address-manual {
        padding: 10px;
        border: 1px solid #ddd;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: #FAFAFA;
    }

    .in-form-link {
        display: block; padding: 5px;margin-bottom: 5px;padding-left: 0;
    }
</style>
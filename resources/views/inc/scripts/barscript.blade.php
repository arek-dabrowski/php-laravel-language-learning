@section('script')
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        var data1 = <?php echo $res; ?>;
            
        $("#chart1").shieldChart({
            exportOptions: {
                image: false,
                print: false
            },
            axisY: {
                title: {
                    text: "Postęp w nauce"
                }
            },
            dataSeries: [{
                seriesType: "bar",
                data: data1
            }]
        });
    });
</script>
@endsection
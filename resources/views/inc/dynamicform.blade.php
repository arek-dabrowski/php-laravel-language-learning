@section('jquery')
<script>
    $(document).ready(function(e){
        var html = '<div><div class="row"><div class="col-4"><input class="form-control" placeholder="Słówko 1" name="word1[]" type="text" value=""></div><div class="col-4"><input class="form-control" placeholder="Słówko 2" name="word2[]" type="text" value=""></div><div class="col-4"><a class="float-right" href="#" id="remove"><i class="fa fa-times fa-2x" aria-hidden="true" style="color:red"></i></a></div></div></div>';
        var maxRows = 14;
        var x = 1;
    
        $("#add").click(function(e){
            if(x <= maxRows)
            {
                $("#container").append(html);
                x++;
            }
        });
    
        $("#add2").bind('click', function(event, w1, w2) {
            if(x <= maxRows)
            {
                var html2 = '<div><div class="row"><div class="col-4"><input class="form-control" placeholder="Słówko 1" name="word1[]" type="text" value="'+w1+'"></div><div class="col-4"><input class="form-control" placeholder="Słówko 2" name="word2[]" type="text" value="'+w2+'"></div><div class="col-4"><a class="float-right" href="#" id="remove"><i class="fa fa-times fa-2x" aria-hidden="true" style="color:red"></i></a></div></div></div>';
                $("#container").append(html2);
                x++;
            }
        }); 
        
        $("#container").on('click','#remove',function(e){
            $(this).parent('div').parent('div').parent('div').remove();
            x--;
        });
    });
</script>
@endsection
@section('script')
<script>
    var count = <?php echo count($array); ?>;
    var i;
    var good = 0;
    var flipped = 0;
    for (i = 1; i<count; i++){
        var x = document.getElementById("container"+i);
        x.style.display = "none";
    }

    function nextWord(z, v) {
        event.preventDefault();
        if(v == 1) good++;
        if(z<count){
            if(z<count-1){
                if(flipped%2 != 0) flip();
                var x = document.getElementById("container"+z);
                var y = document.getElementById("container"+(z+1));
                x.style.display = "none";
                y.style.display = "block";
                flipped = 0;
            }
            if(z==count-1) {
                document.form.result.value = good;
                document.forms["form"].submit();
            }
        }
    }

    function flip() {
        event.preventDefault();
        $('.flashcard').toggleClass('flipped');
        flipped++;
    }
</script>
@endsection
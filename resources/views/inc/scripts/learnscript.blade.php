@section('script')
<script>
    var count = <?php echo count($array); ?>;
    var i;
    var good = 0;
    var checked = false;
    for (i = 1; i<count; i++){
        var x = document.getElementById("container"+i);
        x.style.display = "none";
    }

    function nextWord(z) {
        event.preventDefault();
        if(z<count){
            if(checked == false && document.getElementById("w2id"+z).value == document.getElementById("checkid"+z).value) {
                good++;
            }
            if(z<count-1){
                var x = document.getElementById("container"+z);
                var y = document.getElementById("container"+(z+1));
                x.style.display = "none";
                y.style.display = "block";
                checked = false;
                document.getElementById("w2id"+(z+1)).focus();
            }
            if(z==count-1) {
                document.form.result.value = good;
                document.forms["form"].submit();
            }
        }
    }

    function checkWord(z) {
        event.preventDefault();
        if(checked == false){
            checked = true;
            if(document.getElementById("w2id"+z).value == document.getElementById("checkid"+z).value) {
                good++;
                window.alert('Dobrze!');
            }
            else window.alert('Źle, poprawny wyraz: '+document.getElementById("checkid"+z).value);
        }
    }
</script>
@endsection
@section('script')
<script>
    var count = <?php echo count($array); ?>;
    var i;
    var good = 0;
    var checked = false;
    var isGood = new Array(count).fill(0);
    for (i = 1; i<count; i++){
        var x = document.getElementById("container"+i);
        x.style.display = "none";
    }

    function nextWord(z) {
        event.preventDefault();
        if(z<count){
            if(checked == false && document.getElementById("w2id"+z).value == document.getElementById("checkid"+z).value) {
                isGood[z] = 1;
                good++;
            }
            if(!isGood.includes(0)) {
                document.form.result.value = good;
                document.forms["form"].submit();
            }
            else{
                var bar = document.getElementById("bar");
                bar.setAttribute("style", "width:"+(good/count)*100+"%");
                var x = document.getElementById("container"+z);
                x.style.display = "none";
                document.getElementById("w2id"+z).value = "";
                if(z == count-1) z=0;
                else z++;
                while(isGood[z] == 1){
                    if(z == count-1) z=0;
                    else z++;
                }
                var y = document.getElementById("container"+z);
                y.style.display = "block";
                checked = false;
                document.getElementById("w2id"+z).focus();
            }
        }
    }

    function checkWord(z) {
        event.preventDefault();
        if(checked == false){
            checked = true;
            if(document.getElementById("w2id"+z).value == document.getElementById("checkid"+z).value) {
                isGood[z] = 1;
                good++;
                window.alert('Dobrze!');
            }
            else window.alert('Źle, poprawny wyraz: '+document.getElementById("checkid"+z).value);
        }
    }
</script>
@endsection
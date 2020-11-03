<script src="../jquery-3.5.1.min.js"></script>
<form id="target">
    <input type="text" name="one" value="Hello there"
           style="vertical-align: middle;"/>
    <img id="spinner" src="https://icon-library.com/images/spinner-icon-gif/spinner-icon-gif-10.jpg" height="25"
         style="vertical-align: middle; display:none;">
</form>
<div id="result"></div>
<script type="text/javascript">
    $('#target').change(function (event) {
            $('#spinner').show();
            var form = $('#target');
            var txt = form.find('input[name="one"]').val();
            console.log('Sending POST');
            $.post('autoecho.php', {'val': txt},
                function (data) { // data is the response of our request
                    console.log(data);
                    $('#result').empty().append(data);
                    $('#spinner').hide();
                }
            )
        }
    );
</script>
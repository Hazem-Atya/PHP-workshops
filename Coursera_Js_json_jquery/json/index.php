<?php
?>
<div id="back">

</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $(document).ready( function () {
            $.getJSON('json.php', function(data) {
                $("#back").html(data.first);
            console.log(data);
            })
        }
    );
</script>
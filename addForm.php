<form action="javascript:addWord();" class="search" id="search">
    <fieldset>
        <input required pattern=".*\S+.*" title="හිස් තියන්න එපා!" type="text" id="thewordbox" placeholder="නව වචනයක් ඇතුලත් කරන්න..." value='<?php echo $word ?>' >
    </fieldset>
    <fieldset>
        <textarea required rows=3  type="text" id="themeaningbox" placeholder="තේරුම ඇතුළත් කරන්න..."></textarea>
    </fieldset>
    <fieldset></fieldset>
    <fieldset>
        <textarea required rows=3 type="text" id="theexamplebox" placeholder="උදාහරණයක් ඇතුලත් කරන්න..."></textarea>
    </fieldset>
    <fieldset></fieldset>
    <fieldset>
        <textarea required rows=3 type="text" id="theenglishbox" placeholder="ඉංග්‍රීසි වචනය ඇතුලත් කරන්න..."></textarea>
    </fieldset>
    <fieldset></fieldset>
    <fieldset>
        <input type="submit" id="themeaningbox" value="හරි">
    </fieldset>
    <fieldset></fieldset>
    <script>
        function addWord() {
            var w = document.getElementById("thewordbox").value.trim();
            var a = document.getElementById("themeaningbox").value.trim();
            var e = document.getElementById("theexamplebox").value.trim();
            var en = document.getElementById("theenglishbox").value.trim();

            var url = "<?php echo $requestURl; ?>" + "?m=addWord&w=" + w + "&a=" + a + "&e=" + e + "&en=" + en;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", url, false);
            xmlHttp.send();
            var message = xmlHttp.responseText;
            alert(message);
            document.forms['search'].reset();
        }
    </script>
</form>
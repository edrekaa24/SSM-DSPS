 <form  name="form1" method="get" action="nomina2.php" class="searchbar">
                <input autocomplete="off" name="rfc" id="rfc" type="text" maxlength="13" style="height: 20px; width: 522px;" onKeyUp="this.value=this.value.toUpperCase();"/>
               
                <input type="submit" name="Submit" value="Buscar" style="width:80px; position: relative;left: 570px;" />
                 <div id="suggesstion-box"></div>
                </form>
            </div>
            <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
            <script>
            // AJAX call for autocomplete 
            $(document).ready(function(){
                $("#rfc").keyup(function(){
                    $.ajax({
                    type: "POST",
                    url: "busqueda.php",
                    data:'keyword='+$(this).val(),
                    beforeSend: function(){
                        $("#rfc").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function(data){
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#rfc").css("background","#FFF");

                    }
                    });
                });
            });
            //To select country name
            function selectrfc(val) {
            $("#rfc").val(val);
            $("#suggesstion-box").hide();
            }
            </script>
        
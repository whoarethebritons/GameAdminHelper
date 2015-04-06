<html>
<head>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <?php
        include '../UsefulFunctions.php';
        getServHeader();
        getNavHeader();
    ?>
</head>
<body>
<div id="error">
</div>
<div id="here" style="text-align:left"> 
	<form id='mapcommand' action='javascript:alert("success!")' method='post'>
	</form>
</div>

<script type="text/javascript">
var url='List%20of%20maps%20-%20Official%20TF2%20Wiki%20%20%20Official%20Team%20Fortress%20Wiki.html';
var end="<input type='submit' value='Submit' onClick='get()'>";
$.ajax({
       url: url,
       type: 'GET',
       success: function(data) {
       		$(data).find('table.grid').each(function() {
       			end+="<table class='wikitable sortable grid jquery-tablesorter'>";
       			$(this).find('tr:first-child').each(function() {
       				end+="<tr>"
       				$(this).find('th:lt(4)').each(function(){
       					
				  		end+=$(this).html();
				  		
       			})
       				end+="</tr>";
       			});
	            $(this).find('tr:not(:first-child)').each(function() {
	            	end+="<tr>";
	            	end+="<td><input type='radio' name='map' value ='" + $(this).find('code').html() + "'>";
	            		end+="</input></td>";
		            $(this).find('td:lt(4)').each(function(){
						end+="<td>";
				  		end+=$(this).html();
				  		end+="</td>";
				  })
		            end+="</tr>";

				})
            });
            end+="</table>";
            $('#mapcommand').append(end);
       }
     });
</script><script type="text/javascript">
function get(){
        $('#error').hide();
        $.post(
            '/ExecuteCommand.php',
            { command: "changelevel " + $('input:radio[name=map]:checked').val() },
            function(output){
            	alert($('input:radio[name=map]:checked').val());
                $('#error').html(output).fadeIn(100);
            }
        )       
    }

</script>

</body>
</html>
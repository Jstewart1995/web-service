<html>
<head>
<title> NBA Teams' Web Services</title>
<style>
body {font-family:georgia;}

    .team{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
    max-width:50px;
  }
  
</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function nbateamTemplate(team) {
  return `<div class="team">
      <b>Team: </b> ${team.Team}<br />
      <b>Name: </b> ${team.Name}<br />
      <b>Location: </b> ${team.Location}<br />
      <b>Value: </b> ${team.Value}<br />
      <b>Owner: </b> ${team.Owner}<br />
      <b>Coach: </b> ${team.Coach}<br />
      <div class="pic"><img src="thumbnails/${team.Image}" /></div>
    </div>`;
}



  
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href"); //get category from URL

    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data);
      //place the title on the page
      $("#teamtitle").html(data.title);
      
      //clears the previous teams
      $("#teams").html("");
      $("#output").html("");
      //loops through teams and adds to page
      $.each(data.teams, function(key,value){
      let str = nbateamTemplate(value);

        $("<div></div>").html(str).appendTo("#teams");
      });

      //view JSON as a string
      /*
      let myData = JSON.stringify(data, null, 4);
      myData = "<pre>" + myData + "</pre>";
      $("#output").html(myData);
      */
  
    });
    request.fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });


    
	});
});	

</script>
</head>
	<body>
	<h1>NBA Teams</h1>
		<a href="rankings" class="category">NBA Teams By Rankings</a><br />
		<a href="value" class="category">NBA Teams By Value</a>
		<h3 id="teamtitle">Name of NBA Teams</h3>
		<div id="teams">
			<p>This webpage was displays texts and images of NBA Top 10 NBA teams by Rakings and Values. We use mutliple methods and created our own function to work with the JavaScript. Please feel free to click away to see the Top 10 NBA Teams!</p>
		</div>
    <!--
    <div class="team">
      <b>Film: </b> 1<br />
      <b>Title: </b> Dr. No<br />
      <b>Year: </b> 1962<br />
      <b>Director: </b> Terence Young<br />
      <b>Producers: </b> Harry Saltzman and Albert R. Broccoli<br />
      <b>Writers: </b> Richard Maibaum, Johanna Harwood and Berkely Mather<br />
      <b>Composer: </b> Monty Norman<br />
      <b>Bond: </b> Sean Connery<br />
      <b>Budget: </b> $1,000,000.00<br />
      <b>BoxOffice: </b> $59,567,035.00<br />
      <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
    </div>
    -->
		<div id="output">Results go here</div>
	</body>
</html>
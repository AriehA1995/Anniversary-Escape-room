$(function(){
	$(".place").click(function(event){
		id = $(event.target).parent().attr("id");
		$.getJSON("places.json", function(data){
			var title = data[id].label;
			var content = data[id].content;
			var clueData = data[id].clue;
			if (Array.isArray(clueData) == false){
				$.getJSON("indice.json", function(data){
					var clue = data[clueData].text;
					message(title, content, clue);
				});
			}
			else {
				message(title, content);
			}
		});
	});
	$(".home").click(function(event){
		id = $(event.target).parent().attr("id");
		$.getJSON("places.json", function(data){
			var home = data[pageId].clue;
			var title = home[id].label;
			var content = home[id].content;
			var clueData = home[id].clue;
			$.getJSON("indice.json", function(data){
				clue = data[clueData].text;
				message(title, content, clue);
			});
		});
	});
	$("img.citymap").dblclick(function(event){
		message("אין מה ללחוץ סתם!","תחשבי בהיגיון ותיעזרי בעכבר...");
	});
});
function message(title = "כותרת", content = "תוכן", clue = false){
	var msg = $("<article></article>").html("<p>" + content + "</p>");
	var title = $("<h1></h1>").text(title);
	msg.attr("id","message");
	var but = $("<button></button>").text("סגור");
	but.attr("id","close");
	but.click (function(){
		if (typeof id !== "undefined"){
			if (typeof pageId === "undefined"){
				var placeId = id;
				var hid = "a";
			}
			else {
				var placeId = pageId;
				var hid = id;
			}
			$.getJSON("update.php?id=" + placeId + "&status=1&hid=" + hid, function (answer){
				if (answer.code == "changed"){
					if (answer.data.clue == "G1"){
						window.location.href = "game.php";
					}
					var newCity = $("<div></div>").text(answer.data.label);
					newCity.attr("class", "vcity");
					$("#visited .scroll").append(newCity);
					var counter = $(".vcity.counter").text();
					counter = counter.split("/");
					counter[0] = Number(counter[0]) + 1;
					counter = counter[0] + "/" + counter[1];
					$(".vcity.counter").text(counter);
					if (answer.data.clue !="X0" && answer.data.clue !="G1" && !Array.isArray(answer.data.clue)){
						var newClue = $("<div></div>").text(clue);
						newClue.attr("class", "fclue");
						$("#found .scroll").append(newClue);
						var counter = $(".fclue.counter").text();
						counter = counter.split("/");
						counter[0] = Number(counter[0]) + 1;
						counter = counter[0] + "/" + counter[1];
						$(".fclue.counter").text(counter);
					}
					// the left is working but not the right one. additionally, in the start, the nice button not working.
				}
			});
		}
		$(this).parent().remove();
	});
	msg.prepend(title);
	if (clue){
		var box = $("<div></div>").html(clue);
		box.attr("id","clue");
		msg.append(box);
	}
	msg.append(but);
	$("body").append(msg);
}
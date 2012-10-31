//JavaScript document

var canvas="";
var canvasContext="";
var canvasOffset=Array();

var initCanvas = function(){
	canvas=$("#drawingCanvas")[0];
	canvasContext=canvas.getContext("2d");
	canvasContext.fillStyle="#FF0000";
  canvasContext.strokeStyle = 'red';
	canvasOffset=$(canvas).offset();
	
	$(canvas).mousedown(startDrawing);

}

function startDrawing(e){

	var startX = e.clientX-canvasOffset.left;
	var startY = e.clientY-canvasOffset.top;
	//moveTo(startX,startY);
	
	sendMoveTo(startX,startY);

	$(canvas).mousemove(function(e2){
		var startX = e2.clientX-canvasOffset.left;
		var startY = e2.clientY-canvasOffset.top;
		//draw(startX,startY);
		
		sendDraw(startX,startY);
	});

	$(canvas).mouseup(function(){
    $(canvas).unbind('mousemove');
    $(canvas).unbind('mouseup');
	});


}

function draw(x,y){
	canvasContext.lineTo(x,y);
	canvasContext.stroke();
}

function moveTo(x,y){
	canvasContext.beginPath();
  canvasContext.moveTo(x,y);
}

function clearCanvas(){
	canvas.width = canvas.width;
	sendClearCanvas();
}

initCanvas();

sendMoveTo = function(x,y) {
  var obj = new Object;
  obj.action="move";
  obj.x = x;
  obj.y = y;

  i.send(userQuery, obj, true);
}

sendDraw = function(x,y) {
  var obj = new Object;
  obj.action="draw";
  obj.x = x;
  obj.y = y;
  i.send(userQuery, obj, true);
}

pickcolour = function (c) {
  i.send(userQuery, {action: "colour", colour: c}, true);
}

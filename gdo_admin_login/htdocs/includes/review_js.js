$(document).ready(function(){
	$("#applicationTogl").click(function() {
		$("#application").removeClass("d-none");
		$("#waiver2").addClass("d-none");
		$("#waiver3").addClass("d-none");
		$("#waiver1").addClass("d-none");
		$("#notes").addClass("d-none");
		
	});	
	$("#waiverOneTogl").click(function() {
		$("#waiver1").removeClass("d-none");
		$("#waiver2").addClass("d-none");
		$("#waiver3").addClass("d-none");
		$("#application").addClass("d-none");
		$("#notes").addClass("d-none");
		
	});
	$("#waiverTwoTogl").click(function() {
		$("#waiver2").removeClass("d-none");
		$("#waiver1").addClass("d-none");
		$("#waiver3").addClass("d-none");
		$("#application").addClass("d-none");
		$("#notes").addClass("d-none");
		
	});
	$("#waiverThreeTogl").click(function() {
		$("#waiver3").removeClass("d-none");
		$("#waiver2").addClass("d-none");
		$("#waiver1").addClass("d-none");
		$("#application").addClass("d-none");
		$("#notes").addClass("d-none");
		
	});
	$("#notesTogl").click(function() {
		$("#notes").removeClass("d-none");
		$("#waiver2").addClass("d-none");
		$("#waiver1").addClass("d-none");
		$("#application").addClass("d-none");
		$("#waiver3").addClass("d-none");
		
	});
	$("select#statChanger").change(function(){
        var selectedStat = $(this).children("option:selected").val();
        if (selectedStat == "Denied")
        {
        $("#denyOption").removeClass("d-none");
        }
        if (selectedStat != "Denied")
        {
        	$("#denyOption").addClass("d-none");
        }
        		
    });




});
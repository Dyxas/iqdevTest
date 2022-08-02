

// Show - Hide menu of Checkbox
$( "#inputRadio_depositAct" ).click(function() {
   if (this.checked) {
        $("#replenishmentAmount").show();
   } else {
        $("#replenishmentAmount").val("").hide();
   }
});


function GetValueOfTermInput(){
     if ($("#typeDimension").val() == 'y') {
          return $("#depTerm").val() * 12;
     } else {
          return $("#depTerm").val();
     }
}

function CorrectValues(serializeArray){
     var termValue = GetValueOfTermInput();
     
     serializeArray[1]['value'] = termValue;

     if (serializeArray[4]['value'] == ''){
          serializeArray[4]['value'] = '0';
     }

     return serializeArray;
}

function ShowResultPanel() 
{ 
     $("#hide_block").show()
};

function handleSubmit(){
     if (!$("#sendedData").valid()){
          return false;
     }

     var serializeArray = CorrectValues($("#sendedData").serializeArray());
     var jsonData = JSON.stringify(serializeArray);
     
     $.ajax({
          contentType: "application/json",
          dataType : "json",
          method: "POST",
          url: "calc.php",
          data: jsonData
      })
      .done(function(data) {  
          $("#result_Price_label").html('₽ ' + data['sum']);
          ShowResultPanel();
      })
      .fail(function(data) {
          console.log("Error: ", data);
      });

     return false;
}

$( "#typeDimension" ).change(function() {
     if ($(this).val() == "y") {
          $("#depTerm").attr('min', 1).attr('max', 5);
     } else {
          $("#depTerm").attr('min', 1).attr('max', 60);
     }
});

$("#resultButton").on("click", handleSubmit);

$( document ).ready(function() {
     new AirDatepicker('#date_el');
 });
$.getJSON('https://5ce8007d9f2c390014dba45e.mockapi.io/books', function(data) {
    //data is the JSON string
});

$(document).ready(function(){
 $('#upload_csv').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"class.php",
   method:"POST",
   data:new FormData(this),
   dataType:'json',
   contentType:false,
   cache:false,
   processData:false,
   success:function(jsonData)
   {
    $('#csv_file').val('');
    $('#data-table').DataTable({
     data  :  jsonData,
     columns :  [
      { data : "ISBN" },
      { data : "Title" },
      { data : "Author" }
     ]
    });
   }
  });
 });
});
<!DOCTYPE html>
<html>
 <head>
  <title>Notification using PHP along with Ajax Bootstrap</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="stylesheet.css" >
 </head>
 <body>
  <br /><br />
  <div class="container">
   <nav class="navbar navbar-inverse"style= "background-color: #0c84e4">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="#"style= "color: black">Notification System</a>
     </div>
     <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px; color:black;"></span></a>
       <ul class="dropdown-menu"></ul>
        <!-- The fetched notifications will be added here with a scrollable area for comments -->
      </li>
     </ul>
    </div>
   </nav>
   <br />
   <form method="post" id="comment_form">

   
   <div class="form-group">
     <label>Enter name </label>
     <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group">
     <label>Enter email </label>
     <input type="email" name="email" id="email" class="form-control">
    </div>
    
    <div class="form-group">
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
     <label>Enter Comment</label>
     <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label>Gender:</label>
        <input type="radio" name="gender" value="male"> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other
    </div>

    <div class="form-group">
     <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
    </div>
   </form>
   
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = ''){
    // ajax request
  $.ajax({
   url:"fetch.php", // server side php script that will fetch notifications 
   method:"POST",
   data:{view:view},
   dataType:"json",  // datatype expected in response from the server is set to json 
   success:function(data){
    $('.dropdown-menu').html(data.notification); // updates contents of element with class = dropdown menu
    if(data.unseen_notification > 0){
     $('.count').html(data.unseen_notification); // updates count of element with class = count
    }
   }
  });
 }
 
 // once the page is loaded we call the load_unseen_function
 load_unseen_notification();  
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if(  $('#name').val() != '' && $('#email').val() != '' && $('#subject').val() != '' && $('#comment').val() != ''){
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data){
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }else{
   alert("all fields are required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Restaurant finder</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  
  <div class='page-header'>
  <h1> Restaurant finder <small> App</small></h1>
  <p> Search restaurants near you.</p>
</div>
  
</head>
<body>

<div class="container" style="width:40%;">
  <h2>Search restaurants</h2>
  <form action='get_restaurants.php' method='POST'>
    <div class="form-group">
      <label>Address:</label>
      <input type="text" class="form-control" required = 'required' name='addr' id="addr" placeholder="Enter your location">
    </div>
    <div class="form-group">
      <label>Distance:</label>
        <select id="dist" name='dist' class="form-control">
          <option value="1000">Within 1 km</option>
		  <option value="3000">Within 3 km</option>
          <option value="5000">Within 5 km</option>
		  <option value="8000">Within 8 km</option>
          <option value="10000">Within 10 km</option>
		  <option value="12000">Within 12 km</option>
		  <option value="15000">Within 15 km</option>
		  <option value="17000">Within 17 km</option>
		  <option value="20000">Within 20 km</option>
        </select> 
    </div>
    <button type="submit" class="btn btn-default">Search</button>
  </form>
</div>

</body>
</html>

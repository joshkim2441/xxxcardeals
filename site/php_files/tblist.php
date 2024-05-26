<?php
include("db.php");
$query2 = "SELECT * FROM register";
$result = $conn->query($query2);
if ($result->num_rows > 0) { 
echo "<table id='tsa' border='1' id='example' class='table table-striped responsive-utilities table-hover'>
    <thead>
        <tr>
            <th>id</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email_id</th>
            <th>company</th>
            <th>title</th>
            <th>password</th>
         </tr>
     </thead> ";
     while($row = $result->fetch_assoc()) {
     echo "<tr id='green' ",">",
     "<td>", $row["id"],"</td>",
     "<td>", $row["first_name"],"</td>",
     "<td>", $row["last_name"],"</td>",
     "<td>", $row["email_id"],"</td>",
     "<td>", $row["company"],"</td>",
     "<td>", $row["title"],"</td>",
     "<td>", $row["password"],"</td>",
     "<td>",
     "<form action='update.php' method='post'>
         <input name='id' value='",$row["id"],"' hidden>
         <button type='submit' name='update' value='update'>Edit</button>
         </form>",
         "</td>",
         "<td>",
         "<form action='form-post.php' method='post'>
             <input name='id' value='",$row["id"],"' hidden>
             <button type='submit' name='delete' value='delete'>Delete</button>
             </form>",
             "</td>",
             "</tr>"; 
             }
             echo "</table>";
              }else {
             echo "No Records!"; 
             }
?>

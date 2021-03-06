<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
    <title>Registration Approval</title>
    <link rel="stylesheet" type="text/css" href="includes/styles.css">
  </head>
  <body id="approval" class="mainpage">
    <?php
      if (!isset($is_home)) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include "$root/retirement-home/includes/nav.php";
        // always include session_start in pages that you want to reference session variables in.
        if ($_SESSION['role'] != 1) {
          header("Location: home.php");
        }
      }
    ?>
    <main>
      <h1>Registration Approval</h1>
      <!-- a table with the name and role of all unapproved registrations, and an option yes/no whether to approve either of them -->

      <table id="approvaltable">
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th></th>
          <th></th>
        </tr>
        <?php
          include_once "database/db.php";

          $sql = "SELECT Users.id AS id, roleid, name, fname, lname, approved FROM `Users`
          JOIN `Roles` ON Users.roleid = Roles.id
          WHERE approved = 0;";
          $results = mysqli_query($conn, $sql);

          if($results){
            while($row = mysqli_fetch_assoc($results)){
              $userid = $row['id'];
              $role = $row['name'];
              $fname = $row['fname'];
              $lname = $row['lname'];
              $approved = $row['approved'];
              $roleid = $row['roleid'];

              echo "<tr>
                <td>$fname $lname</td>
                <td>$role</td>
                <td><a href=\"approve.php?id=$userid\" id=\"approve\">Approve</a></td>
                <td><a href=\"disapprove.php?id=$userid&roleid=$roleid\" id=\"remove\">Remove</a></td>
              </tr>";
            }
          }

        ?>
      </table>
    </main>
  </body>
</html>

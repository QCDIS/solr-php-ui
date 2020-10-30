<?php
$db_password="fachmann573";
$errors = array();

// connect to database
$db = mysqli_connect('localhost', 'root', $db_password, 'SearchHistory');

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL ."<br/>";
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL."<br/>";
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL."<br/>";

    if(mysqli_connect_errno()=="1049"){
        $db = mysqli_connect('localhost', 'root', $db_password);
        $sql = "CREATE DATABASE SearchHistory";
        if ($db->query($sql) === TRUE) {
            //echo "Database created successfully"."<br/>";
            $db = mysqli_connect('localhost', 'root', $db_password, 'SearchHistory');
            $sql = "CREATE TABLE SearchLog (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        UID VARCHAR(50) NOT NULL,
                        SearchQuery VARCHAR(250) NOT NULL,
                        Frequency BIGINT,
                        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";

            if ($db->query($sql) === TRUE) {
                //echo "The table created successfully"."<br/>";
            }
            else {
              echo "Error creating table: " . $db->error."<br/>";
            }
        }
        else {
          echo "Error creating database: " . $db->error."<br/>";
        }
    }
    exit;
}
else
{
    if($_SESSION['role']=="admin"){
        $sql = "
        SELECT
            search.Frequency as Frequency,
            search.SearchQuery as SearchQuery,
            user.email as email,
            user.username as username,
            user.role as role
        FROM
            SearchHistory.SearchLog as search,
            registration.users as user
        WHERE
            search.UID = user.id";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row

           $cnt=0;
           echo '<div class="table-responsive">';
           echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
           echo '<thead> <th> # </th> <th> Search query <th> Frequency </th> </th> <th> username </th> <th> role </th> </thead>';
           echo '<tfoot> <th> # </th> <th> Search query <th> Frequency </th> </th> <th> username </th> <th> role </th> </tfoot>';
           echo "<tbody>";

           while($row = $result->fetch_assoc()) {
                $cnt++;
                echo '<tr> <td>' . $cnt .'</td> <td>' . $row["SearchQuery"] .'</td> <td>' . $row["Frequency"] . '</td>  <td> ' . $row["username"] . '</td>  <td>' . $row["role"] . '</td> </tr> ';
                //echo "UID: " . $row["UID"]. " Search Query:" . $row["SearchQuery"]."<br>";
           }

           echo '</tbody>';
           echo '</table>';
           echo '</div>';
        }
         else {
             echo "0 results";
        }
    }
    else{
        $UID=$_SESSION['userid'];
        $sql = "SELECT * FROM SearchLog WHERE UID='$UID'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row

           $cnt=0;
           echo '<div class="table-responsive">';
           echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
           echo '<thead> <th> # </th> <th> Search query </th> <th> Frequency </th> </thead>';
           echo '<tfoot> <th> # </th> <th> Search query </th> <th> Frequency </th></tfoot>';
           echo "<tbody>";

           while($row = $result->fetch_assoc()) {
                $cnt++;
                echo '<tr> <td>' . $cnt .'</td> <td>' . $row["SearchQuery"] .'</td> <td>' . $row["Frequency"] . '</td> </tr> ';
                //echo "UID: " . $row["UID"]. " Search Query:" . $row["SearchQuery"]."<br>";
           }

           echo '</tbody>';
           echo '</table>';
           echo '</div>';
        }
        else {
             echo "0 results";
        }
    }
}
$db->close();
?>
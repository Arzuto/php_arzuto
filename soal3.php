<!DOCTYPE html>
<html>
<head>
    <title>Data Person & Hobi</title>
</head>
<body>
    <h1>Data Person & Hobi</h1>

    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Nama: <input type="text" name="nama">
        Alamat: <input type="text" name="alamat">
        <input type="submit" value="Search">
    </form>

    <br>

    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Hobi</th>
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testdb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT person.nama, person.alamat, GROUP_CONCAT(hobi.hobi SEPARATOR ', ') AS hobinya
                FROM person
                LEFT JOIN hobi ON person.id = hobi.person_id";

        if (isset($_GET['nama']) || isset($_GET['alamat'])) {
            $nama = $_GET['nama'];
            $alamat = $_GET['alamat'];

            if (!empty($nama)) {
                $sql .= " WHERE person.nama LIKE '%$nama%'";
            }

            if (!empty($alamat)) {
                $sql .= empty($nama) ? " WHERE" : " AND";
                $sql .= " person.alamat LIKE '%$alamat%'";
            }
        }

        $sql .= " GROUP BY person.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['nama']."</td>";
                echo "<td>".$row['alamat']."</td>";
                echo "<td>".$row['hobinya']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>

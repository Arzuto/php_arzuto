<!DOCTYPE html>
<html>
<head>
    <title>Form Pengisian Data</title>
</head>
<body>
    <?php
    // Inisialisasi variabel
    $nama = $umur = $hobi = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nama"])) {
        } else {
            $nama = test_input($_POST["nama"]);
        }

        if (empty($_POST["umur"])) {
        } else {
            $umur = test_input($_POST["umur"]);
        }

        if (empty($_POST["hobi"])) {
        } else {
            $hobi = test_input($_POST["hobi"]);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <?php if (empty($nama)) { ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Nama: <input type="text" name="nama">
            <input type="submit" name="submit" value="Submit">
        </form>
    <?php } elseif (empty($umur)) { ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Umur: <input type="number" name="umur">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            <input type="submit" name="submit" value="Submit">
        </form>
    <?php } elseif (empty($hobi)) { ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Hobi: <input type="text" name="hobi">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            <input type="hidden" name="umur" value="<?php echo $umur; ?>">
            <input type="submit" name="submit" value="Submit">
        </form>
    <?php } else { ?>
        <p>Nama: <?php echo $nama; ?></p>
        <p>Umur: <?php echo $umur; ?></p>
        <p>Hobi: <?php echo $hobi; ?></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="submit" name="reset" value="Reset">
        </form>
    <?php } ?>
</body>
</html>

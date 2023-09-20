<!DOCTYPE html>
<html>

<head>
    <title>Pro-control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <div class="container">
        <div class="button-container">
            <a href="Input.php" class="index-button">Add new record</a>
            <a href="Edit.php" class="index-button">Edit existing records</a>
        </div>

        <div class="history">
            <?php history(); ?>
      

            </div>
        </div>
    </div>
    <?php Footer() ?>
</body>

</html>
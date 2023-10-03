<!DOCTYPE html>
<html>

<head>
    <title>Delete Record</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <?php
    $pdo = DBconnect();

    try {
        if (isset($_GET['id'])) {
            $id_to_delete = $_GET['id'];

            // Retrieve and display the record with the specified ID
            $stmt = $pdo->prepare("SELECT * FROM devicestable WHERE id = :id");
            $stmt->bindParam(':id', $id_to_delete, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($record) {
                ?>
                <form class="margin" method="POST" action="">
                    <input type="hidden" name="id_to_delete" value="<?= $id_to_delete ?>">
                    <table>
        <tr>
        <td>
                <label for="newCategory">Category:</label>
                <span><?= $record['Category'] ?></span><br>
            </td>
            <td>
                <label for="newInstruments">Instruments:</label>
                <span><?= $record['Instruments'] ?> </span>
            </td>
            <td>
                <label for="newPrice">Price:</label>
                <span> <?= $record['Price'] ?> </span>
            </td>
            <td>
                <label for="newDescription">Description:</label>
                <span> <?= $record['Description'] ?> </span> 
             </td>
        </tr>
    </table>
    <div class="flexcontainer">
        <div class="inputcontainer">
            <table>
                <tr>
                    <td>
                        <label for="newDO">Di:</label>
                        
                    </td>
                    <td>
                        <label for="nowDO">DO:</label>
                        <span> <?= $record['DO'] ?> </span> 
                    </td>
                <tr>
                <tr>
                    <td>
                        <label for="newAI">AI:</label>
                        <span> <?= $record['AI'] ?> </span> 
                    </td>
                    <td>
                        <label for="newAO">AO:</label>
                        <span> <?= $record['AO'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newTC">TC:</label>
                        <span> <?= $record['TC'] ?> </span> 
                    </td>
                    <td>
                        <label for="newPT100">PT100:</label>
                        <span> <?= $record['PT100'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newTSA">TSA:</label>
                        <span> <?= $record['TSA'] ?> </span> 
                    </td>
                    <td>
                        <label for="newFI">FI:</label>
                        <span> <?= $record['FI'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newRSxxx">RSxxx:</label>
                        <span> <?= $record['RSxxx'] ?> </span> 
                    </td>
                    <td>
                        <label for="newTCP">TCP:</label>
                        <span> <?= $record['TCP'] ?> </span> 
                    </td>
                </tr>
            </table>
        </div>
        <div class="hourcontainer">
            <h1>Hours work time</h1>
            <table id="edit_single_table">
                <tr>
                    <td><label for="newpre_eng">pre_eng:</label>
                    <span> <?= $record['Pre_Eng'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td><label for="newpaneel_uren">paneel_uren:</label>
                    <span> <?= $record['Paneel_Uren'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td><label for="newsoftware_PLC">software_PLC:</label>
                    <span> <?= $record['Software_PLC'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td><label for="newsoftware_HMI">software_HMI:</label>
                    <span> <?= $record['Software_HMI'] ?> </span> 
                    </td>
                </tr>
                <tr>
                    <td><label for="test_internal">test_internal:</label>
                    <span> <?= $record['Test_internal'] ?> </span> 
                    </td>
                </tr>
            </table>
            <div class="cablecontainer">
                <h1>Cable amount</h1>
                <table>
                    <tr>
                        <td> <label for="newmm_Din">mm_Din:</label>
                        <td> <span> <?= $record['mm_Din'] ?> </span> 
                    <tr>
                        <td> <label for="newconnector_signal">connector_signal:</label>
                        <td> <span> <?= $record['Connector_Signal'] ?> </span> 
                    </tr>
                    <tr>
                        <td> <label for="newcable_signal">cable_signal:</label>
                        <td> <span> <?= $record['Cable_signal'] ?> </span> 
                    </tr>
                    <tr>
                        <td> <label for="newCable_Simple">Cable_Simple:</label>
                        <td> <span> <?= $record['Cable_simple'] ?> </span> 
                    </tr>
                </table>
                    <input id="delete" type="submit" name="delete" value="Delete">
                </form>
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
                    // Handle the deletion of the record
                    $id_to_delete = $_POST['id_to_delete'];
                    $stmt = $pdo->prepare("DELETE FROM devicestable WHERE id = :id");
                    $stmt->bindParam(':id', $id_to_delete, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo '<script>
                            alert("Record with ID ' . $id_to_delete . ' deleted successfully.");
                            window.location.href = "edit.php"; 
                        </script>';
                    } else {
                        echo '<script>alert("Error deleting record with ID ' . $id_to_delete . '.");</script>';
                    }
                }
            } else {
                echo "Record with ID $id_to_delete not found.";
            }
        } else {
            echo "No ID specified for deletion.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        if ($pdo !== null) {
            $pdo = null;
        }
    }
    ?>
    <?php Footer() ?>
</body>

</html>

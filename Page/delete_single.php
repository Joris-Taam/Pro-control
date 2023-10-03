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
                <input type="text" id="newCategory" name="category" value="<?= $record['Category'] ?>" placeholder="change the category name"><br>
            </td>
            <td>
                <label for="newInstruments">Instruments:</label>
                <input type="text" id="newInstruments" name="Instruments" value="<?= $record['Instruments'] ?>" placeholder="Change the instrument name"><br>
            </td>
            <td>
                <label for="newPrice">Price:</label>
                <input type="text" id="newPrice" name="Price" value="<?= $record['Price'] ?>" placeholder="Change the price"><br>
            </td>
            <td>
                <label for="newDescription">Description:</label>
                <input type="text" id="newPrice" name="Description" value="<?= $record['Description'] ?>" placeholder="Change the description"><br>
            </td>
        </tr>
    </table>
    <div class="flexcontainer">
        <div class="inputcontainer">
            <table>
                <tr>
                    <td>
                        <label for="newDO">Di:</label>
                        <input type="text" id="newDO" name="inout-DO" value="<?= $record['DI'] ?>"><br>
                    </td>
                    <td>
                        <label for="nowDO">DO:</label>
                        <input type="text" id="nowDO" name="inout-DO" value="<?= $record['DO'] ?>"><br>
                    </td>
                <tr>
                <tr>
                    <td>
                        <label for="newAI">AI:</label>
                        <input type="text" id="newAI" name="inout-AI" value="<?= $record['AI'] ?>"><br>
                    </td>
                    <td>
                        <label for="newAO">AO:</label>
                        <input type="text" id="newAO" name="inout-AO" value="<?= $record['AO'] ?>"><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newTC">TC:</label>
                        <input type="text" id="newTC" name="inout-TC" value="<?= $record['TC'] ?>"><br>
                    </td>
                    <td>
                        <label for="newPT100">PT100:</label>
                        <input type="text" id="newPT100" name="inout-PT100" value="<?= $record['PT100'] ?>"><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newTSA">TSA:</label>
                        <input type="text" id="newTSA" name="inout-TSA" value="<?= $record['TSA'] ?>"><br>
                    </td>
                    <td>
                        <label for="newFI">FI:</label>
                        <input type="text" id="newFI" name="inout-FI" value="<?= $record['FI'] ?>"><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="newRSxxx">RSxxx:</label>
                        <input type="text" id="newRSxxx" name="inout-RSxxx" value="<?= $record['RSxxx'] ?>"><br>
                    </td>
                    <td>
                        <label for="newTCP">TCP:</label>
                        <input type="text" id="newTCP" name="inout-TCP" value="<?= $record['TCP'] ?>"><br>
                    </td>
                </tr>
            </table>
        </div>
        <div class="hourcontainer">
            <h1>Hours work time</h1>
            <table id="edit_single_table">
                <tr>
                    <td><label for="newpre_eng">pre_eng:</label></td>
                    <td><input type="text" id="newpre_eng" name="pre_eng" value="<?= $record['Pre_Eng'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="newpaneel_uren">paneel_uren:</label></td>
                    <td><input type="text" id="newpaneel_uren" name="paneel_uren" value="<?= $record['Paneel_Uren'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="newsoftware_PLC">software_PLC:</label></td>
                    <td><input type="text" id="newsoftware_PLC" name="software_PLC" value="<?= $record['Software_PLC'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="newsoftware_HMI">software_HMI:</label></td>
                    <td><input type="text" id="newsoftware_HMI" name="software_HMI" value="<?= $record['Software_HMI'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="test_internal">test_internal:</label></td>
                    <td><input type="text" id="test_internal" name="test_internal" value="<?= $record['Test_internal'] ?>"></td>
                </tr>
            </table>
            <div class="cablecontainer">
                <h1>Cable amount</h1>
                <table>
                    <tr>
                        <td> <label for="newmm_Din">mm_Din:</label>
                        <td> <input type="text" id="newmm_Din" name="mm_Din" value="<?= $record['mm_Din'] ?>">
                    <tr>
                        <td> <label for="newconnector_signal">connector_signal:</label>
                        <td> <input type="text" id="newconnector_signal" name="connector_signal" value="<?= $record['Connector_Signal'] ?>">
                    </tr>
                    <tr>
                        <td> <label for="newcable_signal">cable_signal:</label>
                        <td> <input type="text" id="newcable_signal" name="cable_signal" value="<?= $record['Cable_signal'] ?>">
                    </tr>
                    <tr>
                        <td> <label for="newCable_Simple">Cable_Simple:</label>
                        <td> <input type="text" id="newCable_Simple" name="Cable_Simple" value="<?= $record['Cable_simple'] ?>">
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

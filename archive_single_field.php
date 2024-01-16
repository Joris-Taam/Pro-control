<!DOCTYPE html>
<html>

<head>
    <title>Delete Record</title>
    <?php include './function/function.php'; ?>
    <link rel="stylesheet" href="./Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <?php
    $pdo = DBconnect();

    try {
        if (isset($_GET['id'])) {
            $id_archive = $_GET['id'];

            // Retrieve and display the record with the specified ID
            $stmt = $pdo->prepare("SELECT * FROM field_devices WHERE id = :id");
            $stmt->bindParam(':id', $id_archive, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($record) {
                ?>
                <form class="margin">
                    <input type="hidden" name="id_archive" value="<?= $id_archive ?>">
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
                </form>
                <button id="delete" onclick="archiveRecord(<?= $id_archive ?>)">Archive</button>
                <?php
                // checks of the row is true or false
                if (isset($_GET['archive']) && isset($_GET['id'])) {
                    $archive = $_GET['archive'] === 'true' ? true : false;
                    $id = $_GET['id'];

                    $sql = "UPDATE field_devices SET IsArchived = :archive WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':archive', $archive, PDO::PARAM_BOOL);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    
                    if ($stmt->execute()) {
                        echo '<script>
                            alert("Record with ID ' . $id_archive . ' archived successfully.");
                            window.location.href = "edit.php"; 
                        </script>';
                    } else {
                        echo '<script>alert("Error archiving record with ID ' . $id_archive . '.");</script>';
                    }
                }
            } else {
                echo "Record with ID $id_archive not found.";
            }
        } else {
            header("Location: edit.php");
            exit();
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
    <script>
    function archiveRecord(id) {
        var confirmation = confirm("Are you sure you want to archive this record?");
        if (confirmation) {
            window.location.href = 'archive_single_field.php?id=' + id + '&archive=true';
        }
    }
</script>

</body>

</html>
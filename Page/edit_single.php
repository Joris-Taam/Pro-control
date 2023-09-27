<!DOCTYPE html>
<html>

<head>
    <title>Edit Record</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <?php

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Check if the form was submitted for updating the record
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Update the record in the database
            $pdo = DBconnect();

            if ($pdo) {
                $sql = "UPDATE devicestable SET 
                Category = :category,
                Instruments = :instruments,
                Price = :price,
                Di = :di,
                DO = :do,
                AI = :ai,
                AO = :ao,
                TC = :tc,
                PT100 = :PT100,
                TCA = :tca,
                FI = :fi,
                RSxxx = :rsxxx,
                TCP = :tcp,
                pre_eng = :pre_eng,
                paneel_uren = :paneel_uren,
                software_PLC = :software_PLC,
                software_HMI = :software_HMI,
                test_internal = :test_internal,
                mm_Din = :mm_Din,
                cable_signal = :cable_signal,
                connector_signal = :connector_signal,
                Cable_Simple = :cable_simple
                WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':category', $_POST['newCategory'], PDO::PARAM_STR);
                $stmt->bindParam(':instruments', $_POST['newInstruments'], PDO::PARAM_STR);
                $stmt->bindParam(':price', $_POST['newPrice'], PDO::PARAM_STR);
                $stmt->bindParam(':do', $_POST['newDI'], PDO::PARAM_STR);
                $stmt->bindParam(':do', $_POST['nowDO'], PDO::PARAM_STR);
                $stmt->bindParam(':ai', $_POST['newAI'], PDO::PARAM_STR);
                $stmt->bindParam(':ao', $_POST['newAO'], PDO::PARAM_STR);
                $stmt->bindParam(':tc', $_POST['newTC'], PDO::PARAM_STR);
                $stmt->bindParam(':PT100', $_POST['newPT100'], PDO::PARAM_STR);
                $stmt->bindParam(':tca', $_POST['newTCA'], PDO::PARAM_STR);
                $stmt->bindParam(':fi', $_POST['newFI'], PDO::PARAM_STR);
                $stmt->bindParam(':rsxxx', $_POST['newRSxxx'], PDO::PARAM_STR);
                $stmt->bindParam(':tcp', $_POST['newTCP'], PDO::PARAM_STR);
                $stmt->bindParam(':pre_eng', $_POST['newpre_eng'], PDO::PARAM_STR);
                $stmt->bindParam(':paneel_uren', $_POST['newpaneel_uren'], PDO::PARAM_STR);
                $stmt->bindParam(':software_PLC', $_POST['newsoftware_PLC'], PDO::PARAM_STR);
                $stmt->bindParam(':software_HMI', $_POST['newsoftware_HMI'], PDO::PARAM_STR);
                $stmt->bindParam(':test_internal', $_POST['test_internal'], PDO::PARAM_STR);
                $stmt->bindParam(':mm_Din', $_POST['newmm_Din'], PDO::PARAM_STR);
                $stmt->bindParam(':cable_signal', $_POST['newcable_signal'], PDO::PARAM_STR);
                $stmt->bindParam(':connector_signal', $_POST['newconnector_signal'], PDO::PARAM_STR);
                $stmt->bindParam(':cable_simple', $_POST['newCable_Simple'], PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo "Record updated successfully. <a href='edit.php'>Back to List</a>";
                } else {
                    echo "Error updating record: " . $stmt->errorInfo()[2];
                }
            } else {
                echo "Database connection failed.";
            }
        } else {
            // Fetch the existing data for the specified ID
            $pdo = DBconnect();

            if ($pdo) {
                $sql = "SELECT * FROM devicestable WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);



                if ($row) {
                    // Display a form for editing the record
    ?>
                    <form method="POST" action="">
                        <label for="newCategory">Category:</label>
                        <input type="text" id="newCategory" name="newCategory" value="<?= $row['Category'] ?>"><br>

                        <label for="newInstruments">Instruments:</label>
                        <input type="text" id="newInstruments" name="newInstruments" value="<?= $row['Instruments'] ?>"><br>

                        <label for="newPrice">Price:</label>
                        <input type="text" id="newPrice" name="newPrice" value="<?= $row['Price'] ?>"><br>

                        <label for="newDO">Di:</label>
                        <input type="text" id="newDO" name="newDO" value="<?= $row['DI'] ?>"><br>

                        <label for="nowDO">DO:</label>
                        <input type="text" id="nowDO" name="nowDO" value="<?= $row['DO'] ?>"><br>

                        <label for="newAI">AI:</label>
                        <input type="text" id="newAI" name="newAI" value="<?= $row['AI'] ?>"><br>

                        <label for="newAO">AO:</label>
                        <input type="text" id="newAO" name="newAO" value="<?= $row['AO'] ?>"><br>

                        <label for="newTC">TC:</label>
                        <input type="text" id="newTC" name="newTC" value="<?= $row['TC'] ?>"><br>

                        <label for="newPT100">PT100:</label>
                        <input type="text" id="newPT100" name="newPT100" value="<?= $row['PT100'] ?>"><br>

                        <label for="newTSA">TCA:</label>
                        <input type="text" id="newTSA" name="newTSA" value="<?= $row['TSA'] ?>"><br>

                        <label for="newFI">FI:</label>
                        <input type="text" id="newFI" name="newFI" value="<?= $row['FI'] ?>"><br>

                        <label for="newRSxxx">RSxxx:</label>
                        <input type="text" id="newRSxxx" name="newRSxxx" value="<?= $row['RSxxx'] ?>"><br>

                        <label for="newTCP">TCP:</label>
                        <input type="text" id="newTCP" name="newTCP" value="<?= $row['TCP'] ?>"><br>

                        <label for="newpre_eng">pre_eng:</label>
                        <input type="text" id="newpre_eng" name="newpre_eng" value="<?= $row['Pre_Eng'] ?>"><br>

                        <label for="newpaneel_uren">paneel_uren:</label>
                        <input type="text" id="newpaneel_uren" name="newpaneel_uren" value="<?= $row['Paneel_Uren'] ?>"><br>

                        <label for="newsoftware_PLC">software_PLC:</label>
                        <input type="text" id="newsoftware_PLC" name="newsoftware_PLC" value="<?= $row['Software_PLC'] ?>"><br>

                        <label for="newsoftware_HMI">software_HMI:</label>
                        <input type="text" id="newsoftware_HMI" name="newsoftware_HMI" value="<?= $row['Software_HMI'] ?>"><br>

                        <label for="test_internal">test_internal:</label>
                        <input type="text" id="test_internal" name="test_internal" value="<?= $row['Test_internal'] ?>"><br>

                        <label for="newmm_Din">mm_Din:</label>
                        <input type="text" id="newmm_Din" name="newmm_Din" value="<?= $row['mm_Din'] ?>"><br>

                        <label for="newconnector_signal">connector_signal:</label>
                        <input type="text" id="newconnector_signal" name="newconnector_signal" value="<?= $row['Connector_Signal'] ?>"><br>

                        <label for="newcable_signal">cable_signal:</label>
                        <input type="text" id="newcable_signal" name="newcable_signal" value="<?= $row['Cable_signal'] ?>"><br>

                        <label for="newCable_Simple">Cable_Simple:</label>
                        <input type="text" id="newCable_Simple" name="newCable_Simple" value="<?= $row['Cable_simple'] ?>"><br>

                     
                        <input type="submit" value="Update">
                    </form>
    <?php
                } else {
                    echo "Record not found.";
                }
            } else {
                echo "Database connection failed.";
            }
        }
    } else {
        echo "Invalid or missing ID parameter.";
    }
    ?>
    <?php Footer() ?>
</body>

</html>
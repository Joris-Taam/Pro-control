<!DOCTYPE html>
<html>

<head>
    <title>Edit Record</title>
    <?php include './function/function.php'; ?>
    <link rel="stylesheet" href="./Style.css">
</head>

<body>
    <?php Navbar(); ?>
    <?php

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Check if the form was submitted for updating the record
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pdo = DBconnect();

            if ($pdo) {
                $sql = "UPDATE cabinet_devices SET 
    Category = :category,
    Instruments = :instruments,
    Price = :price,
    Description = :Description,
    DI = :di,
    DO = :do, 
    AI = :ai,
    AO = :ao,
    TC = :tc,
    PT100 = :pt100,     
    TSA = :tsa,
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
    Cable_Simple = :cable_simple,
    Added_Time = :Added_Time
    WHERE id = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':category', $_POST['newCategory'], PDO::PARAM_STR);
                $stmt->bindParam(':instruments', $_POST['newInstruments'], PDO::PARAM_STR);
                $stmt->bindParam(':Description', $_POST['newDescription'], PDO::PARAM_STR);
                $stmt->bindParam(':price', $_POST['newPrice'], PDO::PARAM_STR);
                $stmt->bindParam(':di', $_POST['newDI'], PDO::PARAM_STR);
                $stmt->bindParam(':do', $_POST['nowDO'], PDO::PARAM_STR);
                $stmt->bindParam(':ai', $_POST['newAI'], PDO::PARAM_STR);
                $stmt->bindParam(':ao', $_POST['newAO'], PDO::PARAM_STR);
                $stmt->bindParam(':tc', $_POST['newTC'], PDO::PARAM_STR);
                $stmt->bindParam(':pt100', $_POST['newPT100'], PDO::PARAM_STR);
                $stmt->bindParam(':tsa', $_POST['newTSA'], PDO::PARAM_STR);
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
                $stmt->bindParam(':Added_Time', $_POST['newAdded_Time'], PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        echo '<script>
                            alert("Record edited successfully.");
                            window.location.href = "edit.php"; 
                        </script>';
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
                $sql = "SELECT * FROM cabinet_devices WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
    ?>
                    <form class="margin" method="POST" action="">
                        <table>
                            <tr>
                                <td>
                                    <label for="newCategory">Category:</label>
                                    <input type="text" id="newCategory" name="newCategory" value="<?= $row['Category'] ?>" placeholder="change the category name"><br>
                                </td>
                                <td>
                                    <label for="newInstruments">Instruments:</label>
                                    <input type="text" id="newInstruments" name="newInstruments" value="<?= $row['Instruments'] ?>" placeholder="Change the instrument name"><br>
                                </td>
                                <td>
                                    <label for="newPrice">Price:</label>
                                    <input type="text" id="newPrice" name="newPrice" value="<?= $row['Price'] ?>" placeholder="Change the price"><br>
                                </td>
                                <td>
                                    <label for="newDescription">Description:</label>
                                    <input type="text" id="newDescription" name="newDescription" value="<?= $row['Description'] ?>" placeholder="Change the description"><br>
                                </td>
                            
                                <td>
                                    <label for="Added_Time">Added time:</label>
                                    <input type="text" id="newAdded_Time" name="newAdded_Time" value="<?= $row['Added_Time'] ?>" placeholder=" Change the date">
                                </td>
                          
                            </tr>
                        </table>
                        <div class="flexcontainer">
                            <div class="inputcontainer">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="newDI">Di:</label>
                                            <input type="text" id="newDI" name="newDI" value="<?= $row['DI'] ?>"><br>
                                        </td>
                                        <td>
                                            <label for="nowDO">DO:</label>
                                            <input type="text" id="nowDO" name="newDO" value="<?= $row['DO'] ?>"><br>
                                        </td>
                                    <tr>
                                    <tr>
                                        <td>
                                            <label for="newAI">AI:</label>
                                            <input type="text" id="newAI" name="newAI" value="<?= $row['AI'] ?>"><br>
                                        </td>
                                        <td>
                                            <label for="newAO">AO:</label>
                                            <input type="text" id="newAO" name="newAO" value="<?= $row['AO'] ?>"><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="newTC">TC:</label>
                                            <input type="text" id="newTC" name="newTC" value="<?= $row['TC'] ?>"><br>
                                        </td>
                                        <td>
                                            <label for="newPT100">PT100:</label>
                                            <input type="text" id="newPT100" name="newPT100" value="<?= $row['PT100'] ?>"><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="newTSA">TSA:</label>
                                            <input type="text" id="newTSA" name="newTSA" value="<?= $row['TSA'] ?>"><br>
                                        </td>
                                        <td>
                                            <label for="newFI">FI:</label>
                                            <input type="text" id="newFI" name="newFI" value="<?= $row['FI'] ?>"><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="newRSxxx">RSxxx:</label>
                                            <input type="text" id="newRSxxx" name="newRSxxx" value="<?= $row['RSxxx'] ?>"><br>
                                        </td>
                                        <td>
                                            <label for="newTCP">TCP:</label>
                                            <input type="text" id="newTCP" name="newTCP" value="<?= $row['TCP'] ?>"><br>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="hourcontainer">
                                <h1>Hours work time</h1>
                                <table id="edit_single_table">
                                    <tr>
                                        <td><label for="newpre_eng">pre_eng:</label></td>
                                        <td><input type="text" id="newpre_eng" name="newpre_eng" value="<?= $row['Pre_Eng'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="newpaneel_uren">paneel_uren:</label></td>
                                        <td><input type="text" id="newpaneel_uren" name="newpaneel_uren" value="<?= $row['Paneel_Uren'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="newsoftware_PLC">software_PLC:</label></td>
                                        <td><input type="text" id="newsoftware_PLC" name="newsoftware_PLC" value="<?= $row['Software_PLC'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="newsoftware_HMI">software_HMI:</label></td>
                                        <td><input type="text" id="newsoftware_HMI" name="newsoftware_HMI" value="<?= $row['Software_HMI'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="test_internal">test_internal:</label></td>
                                        <td><input type="text" id="test_internal" name="newtest_internal" value="<?= $row['Test_internal'] ?>"></td>
                                    </tr>
                                </table>
                                <div class="cablecontainer">
                                    <h1>Cable amount</h1>
                                    <table>
                                        <tr>
                                            <td> <label for="newmm_Din">mm_Din:</label>
                                            <td> <input type="text" id="newmm_Din" name="newmm_Din" value="<?= $row['mm_Din'] ?>">
                                        <tr>
                                            <td> <label for="newconnector_signal">connector_signal:</label>
                                            <td> <input type="text" id="newconnector_signal" name="newconnector_signal" value="<?= $row['Connector_Signal'] ?>">
                                        </tr>
                                        <tr>
                                            <td> <label for="newcable_signal">cable_signal:</label>
                                            <td> <input type="text" id="newcable_signal" name="newcable_signal" value="<?= $row['Cable_signal'] ?>">
                                        </tr>
                                        <tr>
                                            <td> <label for="newCable_Simple">Cable_Simple:</label>
                                            <td> <input type="text" id="newCable_Simple" name="newCable_Simple" value="<?= $row['Cable_simple'] ?>">
                                        </tr>
                                    </table>
                                </div>
                                <input id="update" type="submit" value="Update">
                    </form>
                    </div>
                    </div>
                    </div>
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
    // Function to insert a history record
function insertHistoryRecord($pdo, $device_id, $event_description) {
    $event_date = date("Y-m-d"); // Current date
    $sql = "INSERT INTO history (device_id, event_date, event_description) VALUES (:device_id, :event_date, :event_description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
    $stmt->bindParam(':event_date', $event_date, PDO::PARAM_STR);
    $stmt->bindParam(':event_description', $event_description, PDO::PARAM_STR);
    $stmt->execute();
}
    ?>
    <?php Footer() ?>
</body>

</html>
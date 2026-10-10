<!DOCTYPE html>
<html>

<head>
    <title>Edit Record</title>
    <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>
    <?php renderNavigation(); ?>
    <?php

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Check if the form was submitted for updating the record
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            PageController::updateDevice($deviceTable, (int) $id, $_POST);
            echo '<script>
                            alert("Record edited successfully.");
                            window.location.href = "Edit.php"; 
                        </script>';
        } else {
            // Fetch the existing data for the specified ID
            $row = PageController::findDevice($deviceTable, (int) $id);
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
                                    <input type="text" id="newPrice" name="newPrice" value="<?= number_format($row["Price"], 2) ?>" placeholder="Change the price"><br>
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
                                        <td><input type="text" id="newpre_eng" name="newpre_eng" value="<?= number_format($row['Pre_Eng'], 2) ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="newpaneel_uren">paneel_uren:</label></td>
                                        <td><input type="text" id="newpaneel_uren" name="newpaneel_uren" value="<?= number_format($row['Paneel_Uren'], 2) ?>"></td>

                                    </tr>
                                    <tr>
                                        <td><label for="newsoftware_PLC">software_PLC:</label></td>
                                        <td><input type="text" id="newsoftware_PLC" name="newsoftware_PLC" value="<?= number_format($row['Software_PLC'], 2) ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="newsoftware_HMI">software_HMI:</label></td>
                                        <td><input type="text" id="newsoftware_HMI" name="newsoftware_HMI" value="<?= number_format($row['Software_HMI'], 2) ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="test_internal">test_internal:</label></td>
                                        <td><input type="text" id="test_internal" name="newtest_internal" value="<?= number_format($row['Test_internal'], 2) ?>"></td>
                                    </tr>
                                </table>
                                <div class="cablecontainer">
                                    <h1>Cable amount</h1>
                                    <table>
                                        <tr>
                                            <td> <label for="newmm_Din">mm_Din:</label>
                                            <td> <input type="text" id="newmm_Din" name="newmm_Din" value="<?= $row['mm_Din'] ?>">
                                        </tr>
                                        <tr>
                                            <td> <label for="newcable_signal">cable_signal:</label>
                                            <td> <input type="text" id="newcable_signal" name="newcable_signal" value="<?= $row['Cable_signal'] ?>">
                                        </tr>
                                        <tr>
                                            <td> <label for="newConnector_Signal">connector_signal:</label>
                                            <td> <input type="text" id="newConnector_Signal" name="newConnector_Signal" value="<?= $row['Connector_Signal'] ?>">
                                        </tr>
                                        <tr>
                                            <td> <label for="newCable_Simple">Cable_Simple:</label>
                                            <td> <input type="text" id="newCable_Simple" name="newCable_Simple" value="<?= $row['Cable_simple'] ?>">
                                        </tr>
                                        <tr>
                                            <td> <label for="newConnector_Simple">Connector_Simple:</label>
                                            <td> <input type="text" id="newConnector_Simple" name="newConnector_Simple" value="<?= $row['Connector_Simple'] ?>">
                                        </tr>
                                    </table>
                                </div>
                                <input id="update" type="submit" value="Update">
                    </form>
                    </div>
                    </div>
                    </div>
    <?php

            }
        }
    } else {
        echo "Invalid or missing ID parameter.";
    }

    ?>
    <?php renderFooter(); ?>
</body>

</html>
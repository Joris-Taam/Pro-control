<!DOCTYPE html>
<html>

<head>
    <title>Pro-control</title>
    <link rel="stylesheet" href="./assets/css/global.css">
</head>
<body>
    <?php renderNavigation(); ?>
    <!-- from for the categories -->
    <form method="POST" action="insert_data.php">
        <table>

            <!-- Category 1 -->
            <tr>
                <td>
                    <label for="table_name">Select Table:</label>
                    <select id="table_name" name="table_name">
                        <option value="cabinet_devices">Cabinet Devices</option>
                        <option value="field_devices">Field Devices</option>
                    </select>
                </td>
                <td>
                    <label for="category_name">Category</label><br>
                    <select id="category_name" name="category_name">
                        <option value="Cabinet">Cabinet</option>
                        <option value="Flow control">Flow control</option>
                        <option value="Flow measurement">Flow measurement</option>
                        <option value="Generic">Generic</option>
                        <option value="Heating">Heating</option>
                        <option value="Motor">Motor</option>
                        <option value="Option">Option</option>
                        <option value="Pressure control">Pressure control</option>
                        <option value="Switch">Switch</option>
                        <option value="Valve">Valve</option>
                        <option value="Switch">Switch</option>
                        <option value="Others">Others</option>
                        <option value="Pump">Pump</option>
                        <option value="-">-</option>
                    </select>
                </td>
                <td>
                    <label for="category_data">Instrument</label><br>
                    <select name="category_data" id="category_data" required></select>
                </td>
                <td>
                    <label for="category_Price">Price</label><br>
                    <input type="text" name="category_Price" id="category_Price" placeholder="The price of the instrument" value="" required>
                </td>
                <td>
                    <label for="Description">Description</label><br>
                    <input type="text" name="Description" id="Description" placeholder="Description of the category" required>
                </td>

            </tr>
        </table>
        <!--  input / output -->
        <div class="flexcontainer">
            <div class="inputcontainer">
                <table>
                    <table>
                        <tr>
                            <td>
                                <label for="newDI">Di:</label>
                                <input type="text" id="newDI" name="quantity-DI"><br>
                            </td>
                            <td>
                                <label for="nowDO">DO:</label>
                                <input type="text" id="nowDO" name="quantity-DO"><br>
                            </td>
                        <tr>
                        <tr>
                            <td>
                                <label for="newAI">AI:</label>
                                <input type="text" id="newAI" name="quantity-AI"><br>
                            </td>
                            <td>
                                <label for="newAO">AO:</label>
                                <input type="text" id="newAO" name="quantity-AO"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="newTC">TC:</label>
                                <input type="text" id="newTC" name="quantity-TC"><br>
                            </td>
                            <td>
                                <label for="newPT100">PT100:</label>
                                <input type="text" id="newPT100" name="quantity-PT100"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="newTSA">TSA:</label>
                                <input type="text" id="newTSA" name="quantity-TSA"><br>
                            </td>
                            <td>
                                <label for="newFI">FI:</label>
                                <input type="text" id="newFI" name="quantity-FI"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="newRSxxx">RSxxx:</label>
                                <input type="text" id="newRSxxx" name="quantity-RSxxx"><br>
                            </td>
                            <td>
                                <label for="newTCP">TCP:</label>
                                <input type="text" id="newTCP" name="quantity-TCP"><br>
                            </td>
                        </tr>

                    </table>
            </div>


            <!-- Working hours -->
            <div class="hourcontainer">
                <h1> Hours work time</h1>
                <table>
                    <tr>
                        <td><label for="pre-eng">Pre_Eng:</label></td>
                        <td><input type="number" id="pre-eng" name="pre-eng" step="0.05" min="0" placeholder="0.00"></td>
                    </tr>
                    <tr>
                        <td><label for="paneel-uren">Paneel_Uren:</label></td>
                        <td><input type="number" id="paneel-uren" name="paneel-uren" step="0.05" min="0" placeholder="0.00"></td>
                    </tr>
                    <tr>
                        <td><label for="software-plc">Software_PLC:</label></td>
                        <td><input type="number" id="software-plc" name="software-plc" step="0.05" min="0" placeholder="0.00"></td>
                    </tr>
                    <tr>
                        <td><label for="software-hmi">Software_HMI:</label></td>
                        <td><input type="number" id="software-hmi" name="software-hmi" step="0.05" min="0" placeholder="0.00"></td>
                    </tr>
                    <tr>
                        <td><label for="test-internal">Test_internal:</label></td>
                        <td><input type="number" id="test-internal" name="test-internal" step="0.05" min="0" placeholder="0.00"></td>
                    </tr>

                </table>
                <!-- Cable types -->
                <div class="cablecontainer">
                    <h1>Cable amount</h1>
                    <table>
                        <tr>
                            <td><label for="mm_Din">mm_din</label></td>
                            <td><input type="number" id="mm_Din" name="mm_Din" step="1" min="0" placeholder="0"></td>
                        </tr>
                        <tr>
                            <td><label for="cable-signal">Cable_Signal:</label></td>
                            <td><input type="number" id="cable-signal" name="cable-signal" step="1" min="0" placeholder="0"></td>
                        </tr>
                        <tr>
                            <td><label for="connector-signal">Connector_Signal:</label></td>
                            <td><input type="number" id="connector-signal" name="connector-signal" step="1" min="0" placeholder="0"></td>
                        </tr>
                        <tr>
                            <td><label for="cable-simple">Cable_Simple:</label></td>
                            <td><input type="number" id="cable-simple" name="cable-simple" step="1" min="0" placeholder="0"></td>
                        </tr>
                        <tr>
                            <td><label for="connector-simple">Connector_Simple:</label></td>
                            <td><input type="number" id="connector-simple" name="connector-simple" step="1" min="0" placeholder="0"></td>
                        </tr>
                    </table>
                </div>
                <input id="update" type="submit" value="Submit">
    </form>
    </div>
    </div>
    </div>
    <p id="form-status" class="form-status" role="alert" hidden></p>
    <?php renderFooter(); ?>
    <script type="module" src="./assets/js/Controller/add-page.js"></script>
</body>

</html>
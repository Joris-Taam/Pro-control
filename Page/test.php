<!DOCTYPE html>
<html>

<head>
    <title>Pro-control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>
<?php Navbar(); ?>

<body>

    <!-- from for the categories -->
    <form method="POST" action="insert_data.php">
        <table>
            <!-- Category 1 -->
            <tr>
                <td id="add_category">
                    <label for="category_name">Category</label><br>
                    <select id="category_name" name="category_name" onchange="loadCategoryData()">
                        <?php $InstrumentData = GetCategoryData(); ?>
                        <?php foreach ($InstrumentData as $row) : ?>
                            <option value="<?php echo htmlspecialchars($row['Category']); ?>"><?php echo htmlspecialchars($row['Category']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td id="add_category">
                    <label for="category_name">Instrument</label><br>
                    <input type="text" name="category_data" id="category_price" placeholder="The name of instrument" required>
                </td>
                <td id="add_category">
                    <label for="category_price">Price</label><br>
                    <input type="text" name="category_Price" id="category_price" placeholder="De price of the instrument" name="category_price" required>
                </td>
            </tr>
        </table>
        <!--  input / output -->
        <div class="flexcontainer">
            <div class="inputcontainer">
                <table>
                    <tr>
                        <td class="vertical-align">
                            <label for="quantity-DI">DI:</label>
                            <select name="quantity-DI" id="quantity-DI" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td class="vertical-align">
                            <label for="quantity-DO">DO:</label>
                            <select name="quantity-DO" id="quantity-DO" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="vertical-align">
                            <label for="quantity-AI">AI:</label>
                            <select name="quantity-AI" id="quantity-AI" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td class="vertical-align">
                            <label for="quantity-AO">AO:</label>
                            <select name="quantity-AO" id="quantity-AO" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="vertical-align">
                            <label for="quantity-TC">TC:</label>
                            <select name="quantity-TC" id="quantity-TC" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td class="vertical-align">
                            <label for="quantity-PT100">PT100:</label>
                            <select name="quantity-PT100" id="quantity-PT100" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="vertical-align">
                            <label for="quantity-TSA">TSA:</label>
                            <select name="quantity-TSA" id="quantity-TSA" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td class="vertical-align">
                            <label for="quantity-FI">FI:</label>
                            <select name="quantity-FI" id="quantity-FI" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="vertical-align">
                            <label for="quantity-RSxxx">RSxxx:</label>
                            <select name="quantity-RSxxx" id="quantity-RSxxx" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td class="vertical-align">
                            <label for="quantity-TCP">TCP:</label>
                            <select name="quantity-TCP" id="quantity-TCP" class="quantity">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
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
                        <td><input type="number" id="pre-eng" name="pre-eng" step="0.25" min="0" placeholder="0.00" required></td>
                    </tr>
                    <tr>
                        <td><label for="paneel-uren">Paneel_Uren:</label></td>
                        <td><input type="number" id="paneel-uren" name="paneel-uren" step="0.25" min="0" placeholder="0.00" required></td>
                    </tr>
                    <tr>
                        <td><label for="software-plc">Software_PLC:</label></td>
                        <td><input type="number" id="software-plc" name="software-plc" step="0.25" min="0" placeholder="0.00" required></td>
                    </tr>
                    <tr>
                        <td><label for="software-hmi">Software_HMI:</label></td>
                        <td><input type="number" id="software-hmi" name="software-hmi" step="0.25" min="0" placeholder="0.00" required></td>
                    </tr>
                    <tr>
                        <td><label for="test-internal">Test_internal:</label></td>
                        <td><input type="number" id="test-internal" name="test-internal" step="0.25" min="0" placeholder="0.00" required></td>
                    </tr>
                    <tr>
                        <td><label for="mm_Din">mm_din</label></td>
                        <td><input type="number" id="mm_Din" name="mm_Din" step="0.25" min="0" placeholder="0.00" required></td>
                    </tr>
                </table>
                <!-- Cable types -->
                <div class="cablecontainer">
                    <h1>Cable amount</h1>
                    <table>
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
                <input type="submit" value="Submit">
    </form>
    </div>
    </div>
    </div>
    <?php Footer() ?>
</body>
<script>
    function loadCategoryData() {
        // Get the selected category from the first dropdown
        var selectedCategory = document.getElementById("category_name").value;

        // Send an AJAX request to a PHP script to fetch data
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_category_data.php?&category=" + selectedCategory, true);


        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Parse the JSON response from the PHP script
                var data = JSON.parse(xhr.responseText);

                // Populate the second dropdown with the retrieved data
                var categoryDataDropdown = document.getElementById("category_data");
                categoryDataDropdown.innerHTML = "";

                // Add new options to the second dropdown
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement("option");
                    option.value = data[i];
                    option.text = data[i];
                    categoryDataDropdown.appendChild(option);
                }
            }
        };

        xhr.send();
    }
</script>

</html>


</html>
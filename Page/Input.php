<!DOCTYPE html>
<html>

<head>
    <title>Pro-control</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>
<?php Navbar(); ?>


<body id="input-body">
    <div class="input-container">
        <!-- from for the categories -->
        <form>
            <h1 class="margin">Categories</h1>
            <table>
                <!-- Category 1 -->
                <tr>
                    <td>
                        <select id="category_name" name="category_name" onchange="loadCategoryData()">
                            <?php $InstrumentData = GetCategoryData(); ?>
                            <?php foreach ($InstrumentData as $row) : ?>
                                <option value="<?php echo htmlspecialchars($row['Category']); ?>"><?php echo htmlspecialchars($row['Category']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <label for="category_name">Name:</label><br>
                        <select id="category_data" name="category_data">
                            <?php foreach ($cabinetData as $row) : ?>
                                <option value="<?php echo htmlspecialchars($row['Instruments']); ?>"><?php echo htmlspecialchars($row['Instruments']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <label for="category_quantity">Quantity:</label><br>
                        <select id="category_quantity" name="category_quantity">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td>
                        <label for="category_price">Prices:</label><br>
                        <input type="text" id="category_price" name="category_price">
                    </td>
                </tr>

                <!-- second section -->
                <tr>
                    <td>
                        <select id="category_name" name="category_name" onchange="loadCategoryData()">
                            <?php $InstrumentData = GetCategoryData(); ?>
                            <?php foreach ($InstrumentData as $row) : ?>
                                <option value="<?php echo htmlspecialchars($row['Category']); ?>"><?php echo htmlspecialchars($row['Category']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <label for="category_name">Name:</label><br>
                        <select id="category_data" name="category_data">
                            <?php foreach ($cabinetData as $row) : ?>
                                <option value="<?php echo htmlspecialchars($row['Instruments']); ?>"><?php echo htmlspecialchars($row['Instruments']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>

                        <select id="category_quantity" name="category_quantity">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="category_price" name="category_price">
                    </td>
                </tr>
            </table>

            <!-- Type of input / output -->
            <div class="flexcontainer">
                <div class="inputcontainer">
                    <h1> Input / Output</h1>
                    <!-- Section 1 -->
                    <form>
                        <table>
                            <!-- Quantity Rows for DI -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-DI">DI:</label>
                                        <select id="quantity-DI" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for DO -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-DO">DO:</label>
                                        <select id="quantity-DO" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Repeat the above structure for other options (AI, AO, TC, PT100, TSA, FI, RSxxx, TCP) -->
                            <!-- Quantity Rows for AI -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-AI">AI:</label>
                                        <select id="quantity-AI" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for AO -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-AO">AO:</label>
                                        <select id="quantity-AO" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for TC -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-TC">TC:</label>
                                        <select id="quantity-TC" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for PT100 -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-PT100">PT100:</label>
                                        <select id="quantity-PT100" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for TSA -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-TSA">TSA:</label>
                                        <select id="quantity-TSA" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for FI -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-FI">FI:</label>
                                        <select id="quantity-FI" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for RSxxx -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-RSxxx">RSxxx:</label>
                                        <select id="quantity-RSxxx" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <!-- Quantity Rows for TCP -->
                            <tr>
                                <td>
                                    <div class="section">
                                        <label for="quantity-TCP">TCP:</label>
                                        <select id="quantity-TCP" class="quantity">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
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
                    </table>
                    <!-- Cable types -->
                    <div class="cablecontainer">
                        <h1>Cable amount</h1>
                        <table>
                            <tr>
                                <td><label for="cable-signal">Cable_Signal:</label></td>
                                <td><input type="number" id="cable-signal" name="cable-signal" step="1" min="0" placeholder="0" required></td>
                            </tr>
                            <tr>
                                <td><label for="connector-signal">Connector_Signal:</label></td>
                                <td><input type="number" id="connector-signal" name="connector-signal" step="1" min="0" placeholder="0" required></td>
                            </tr>
                            <tr>
                                <td><label for="cable-simple">Cable_Simple:</label></td>
                                <td><input type="number" id="cable-simple" name="cable-simple" step="1" min="0" placeholder="0" required></td>
                            </tr>
                            <tr>
                                <td><label for="connector-simple">Connector_Simple:</label></td>
                                <td><input type="number" id="connector-simple" name="connector-simple" step="1" min="0" placeholder="0" required></td>
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
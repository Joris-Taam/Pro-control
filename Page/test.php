<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <?php include '../function/function.php'; ?>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Pro-control</title>
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
                                    <option value="<?php echo htmlspecialchars($row['instruments']); ?>"><?php echo htmlspecialchars($row['instruments']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
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
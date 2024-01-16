# Quote's Website Guide

## Introduction

Welcome to the Quote's website guide! This guide provides comprehensive information about the Quote's website, a PHP, HTML, and JS webpage designed for adding cabinets and field devices to Excel quotes. The added devices are sent to the Microsoft SQL server, which is then connected to the Excel file. You can refresh the imported datasheet within the Excel file to ensure it reflects the latest updates.

## Website Structure

The website is structured with the following main pages:

1. **index.php**: Options to 'Add new record' and 'Edit existing record'. Use 'Add new record' for adding a non-existing Cabinet/Instrument and 'Edit existing record' for modifying an existing record.

2. **add.php**: Fields for adding new records, including:
   - Selected Table
   - Categories
   - Instruments
   - Price
   - Description
   - Digital Inputs/Outputs
   - Hours Work Time
   - Cable Amount


3. **edit.php**: Displays tables for Cabinet/Field devices with separate boxes for Categories, Instruments, Price, and added time. Options to Edit or Archive rows.



4. **archive.php**: View archived rows. To archive a row, go to edit.php, find the row, and click on 'Archive'. You can then view an overview of all archived rows on archive.php.



Feel free to explore and utilize the Quote's website functionalities for efficient management of cabinet and field device data in your Excel quotes.

# Code Documentation

This documentation provides insights into the structure and functionality of the code, primarily built using PHP, HTML, and JS.

## index.php

The `index.php` file utilizes the Navbar() and Footer() functions, which are sourced from the './function/function.php' file (line 5). The 'include' statement imports code from 'function.php' into 'index.php', promoting modularity. The code's architecture allows for seamless integration of these functions into any file without the need for individual edits.



## function.php

The `function.php` file contains the code for the Navbar() and Footer() functions encapsulated within their respective functions. This approach enables easy calling of these functions across different files, enhancing code reusability and maintainability.

## add.php

The `add.php` file incorporates the InsertData() function, responsible for transmitting data from the HTML form to the Microsoft server. The HTML code within the `<form>` section contains input fields necessary for creating a new record. The InsertData() function binds HTML input fields to SQL table columns and establishes a connection with the database using the DBconnect() function.

## function InsertData()

The `InsertData()` function transfers data from HTML input fields to a MySQL database. It dynamically retrieves input field names, binds variables to corresponding SQL table columns, and inserts data into the specified table. The presence of the `DBconnect()` function establishes the connection between the code and the database.

## edit.php

The `edit.php` file employs the `displayTable()` function to generate an HTML table showcasing non-archived records from a specified MySQL table. This function enhances user interaction by dynamically adjusting table headers for sorting, providing "Edit" links, and offering "Archive" or "Restore" links based on archival status.

## display the tables cabinet / field devices

The code to display the tables `cabinet_devices` and `field_devices` is within the `displayTable()` function, generating an HTML table for organized presentation of data.

## archive.php

The `archive.php` file features the `displayArchivedDevices()` function, displaying archived devices of a given type. With dynamic sorting options and a user-friendly interface, this function constructs and executes SQL queries to fetch archived records. Each row in the HTML table includes device details and links for user actions such as "Edit" and "Restore."

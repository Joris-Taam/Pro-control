<?php

function renderNavigation(): void
{
    ?>
    <nav class="navbar" aria-label="Main navigation">
        <a class="navbar-logo" href="./index.php">
            <img src="./assets/images/logo.png" alt="Pro-control home">
        </a>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./add.php">Add</a></li>
            <li><a href="./Edit.php">Edit</a></li>
            <li><a href="./archive.php">Archive</a></li>
        </ul>
    </nav>
    <?php
}

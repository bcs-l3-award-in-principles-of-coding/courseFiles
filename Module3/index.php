<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Manager</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 500px; margin: auto; }
        form > div { margin-bottom: 15px; }
        label { display: block; }
        input, button { width: 100%; padding: 8px; margin-top: 5px; }
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Contact Manager</h1>

    <!-- Form for adding new contacts -->
    <form action="add_contact.php" method="post">
        <div>
            <label>First Name:</label>
            <input type="text" name="firstName" required>
        </div>
        <div>
            <label>Last Name:</label>
            <input type="text" name="lastName" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Phone Number:</label>
            <input type="text" name="phoneNumber" required>
        </div>
        <button type="submit">Add Contact</button>
    </form>

    <!-- Form for searching contacts -->
    <form method="post" onsubmit="return showResults();">
        <div>
            <label>Search Contacts:</label>
            <input type="text" name="searchQuery" id="searchQuery">
            <button type="submit">Search</button>
        </div>
    </form>

    <!-- List of contacts with delete option -->
    <form action="delete_contact.php" method="post">
        <?php
        include 'db.php';
        $stmt = $conn->prepare("SELECT * FROM contacts");
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            echo "<div><input type='checkbox' name='selectedContacts[]' value='{$row['contact_id']}'> {$row['first_name']} {$row['last_name']}</div>";
        }
        ?>
        <button type="submit">Delete Selected</button>
    </form>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="resultsText">Search results will appear here...</p>
        </div>
    </div>

    <script>
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function showResults() {
            var searchQuery = document.getElementById('searchQuery').value;
            fetch('search_contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'searchQuery=' + encodeURIComponent(searchQuery)
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('resultsText').innerHTML = html;
                modal.style.display = "block";
            });
            return false; // Prevent form from submitting normally
        }
    </script>
</div>
</body>
</html>

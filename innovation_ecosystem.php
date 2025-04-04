<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovation Ecosystem Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 20px;
        }
        #faculty-list {
            display: none;
            max-height: 150px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-header">Innovation Ecosystem Form</h2>
            <form action="save_innovation.php" method="POST" enctype="multipart/form-data">
                <!-- Faculty ID Field -->
                <div class="mb-3">
                    <label for="faculty_id" class="form-label">Faculty ID</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="faculty_id" 
                        name="faculty_id" 
                        placeholder="Type or select Faculty ID" 
                        required>
                    <ul class="list-group" id="faculty-list"></ul>
                </div>

                <!-- Title of Innovation -->
                <div class="mb-3">
                    <label for="title_of_innovation" class="form-label">Title of Innovation</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="title_of_innovation" 
                        name="title_of_innovation" 
                        required>
                </div>

                <!-- Name of Award -->
                <div class="mb-3">
                    <label for="name_of_award" class="form-label">Name of Award</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name_of_award" 
                        name="name_of_award" 
                        required>
                </div>

                <!-- Date of Award -->
                <div class="mb-3">
                    <label for="date_of_award" class="form-label">Date of Award</label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="date_of_award" 
                        name="date_of_award" 
                        required>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="category" 
                        name="category" 
                        required>
                </div>

                <!-- Proof File -->
                <div class="mb-3">
                    <label for="proof_file" class="form-label">Proof File</label>
                    <input 
                        type="file" 
                        class="form-control" 
                        id="proof_file" 
                        name="proof_file" 
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dynamic Search Script -->
    <script>
        // Sample faculty data fetched dynamically from PHP
        const facultyData = [
            <?php
            // Fetch faculty data from the database
            $conn = new mysqli('localhost', 'root', '', 'faculty_registration');
            $query = "SELECT faculty_id, CONCAT(first_name, ' ', last_name) AS faculty_name FROM faculty_info";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "{ id: '{$row['faculty_id']}', name: '{$row['faculty_name']}' },";
            }
            $conn->close();
            ?>
        ];

        const facultyInput = document.getElementById('faculty_id');
        const facultyList = document.getElementById('faculty-list');

        // Handle user input for dynamic search
        facultyInput.addEventListener('input', () => {
            const query = facultyInput.value.toLowerCase();
            facultyList.innerHTML = '';
            if (query) {
                // Filter matching faculty data
                const matches = facultyData.filter(faculty => 
                    faculty.name.toLowerCase().includes(query) || faculty.id.toLowerCase().includes(query)
                );

                // Populate the list with matching results
                matches.forEach(faculty => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${faculty.name} (${faculty.id})`;
                    listItem.className = 'list-group-item list-group-item-action';
                    listItem.style.cursor = 'pointer';

                    // Set input value on click
                    listItem.addEventListener('click', () => {
                        facultyInput.value = faculty.id;
                        facultyList.style.display = 'none';
                    });

                    facultyList.appendChild(listItem);
                });
                facultyList.style.display = 'block';
            } else {
                facultyList.style.display = 'none';
            }
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!facultyList.contains(event.target) && event.target !== facultyInput) {
                facultyList.style.display = 'none';
            }
        });
    </script>
</body>
</html>

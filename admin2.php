<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dentist Admin</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <a href="#" class="nav_logo">Dentist Admin</a>
            <ul class="nav_items"></ul>
        </nav>
    </header>

    <!-- Home -->
    <section class="home">
        <table id="details">
            <tr>
                <th>Patient Name</th>
                <th>Scheduled Date</th>
                <th>Scheduled Time</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Address</th>
            </tr>
        </table>
    </section>

    <div class="footer">
        &copy; Copyright 2024. All rights reserved.
    </div>

    <script src="script.js"></script>
    <script>
        // Function to fetch appointments and update the table
        function fetchAppointments() {
            fetch('get_appointments.php')
                .then(response => response.json())
                .then(data => {
                    const table = document.getElementById('details');

                    // Clear existing rows except for the header
                    table.innerHTML = `
                        <tr>
                            <th>Patient Name</th>
                            <th>Scheduled Date</th>
                            <th>Scheduled Time</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Address</th>
                        </tr>
                    `;

                    // Loop through the data and create table rows
                    data.forEach(appointment => {
                        const row = table.insertRow();
                        row.insertCell(0).textContent = appointment.name;
                        row.insertCell(1).textContent = appointment.appointment_date;
                        row.insertCell(2).textContent = appointment.appointment_time;
                        row.insertCell(3).textContent = appointment.email;
                        row.insertCell(4).textContent = appointment.gender;
                        row.insertCell(5).textContent = appointment.date_of_birth;
                        row.insertCell(6).textContent = appointment.address;
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Initial fetch
        fetchAppointments();

        // Set interval to fetch appointments every 5 minutes (300000 milliseconds)
        setInterval(fetchAppointments, 300000); // Change the interval as needed
    </script>
</body>

</html>
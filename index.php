<?php
include "config.php"; // koneksi ke database
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vaccine Reservation Checkout</title>
</head>
<body>

<h2>Vaccine Reservation</h2>

<form action="process.php" method="POST">

    <h3>Select Vaccination</h3>
    <button type="button" onclick="openVaccineModal()">Select Vaccination</button>
    <p>Selected vaccine: <span id="selectedVaccine">-</span></p>
    <input type="hidden" id="vaccineInput" name="vaccine">

    <h3>Select Schedule</h3>
    <input type="date" id="datePicker">
    <button type="button" onclick="selectDate()">Select</button>

    <p>Selected schedule: <span id="selectedSchedule">-</span></p>
    <input type="hidden" id="scheduleInput" name="schedule">

    <h3>Select User</h3>
    <button type="button" onclick="openUserModal()">Select User</button>
    <p>Selected user: <span id="selectedUser">-</span></p>

    <input type="hidden" id="userNameInput" name="username">
    <input type="hidden" id="userPhoneInput" name="userphone">
    <input type="hidden" id="userEmailInput" name="useremail">

    <h3>Order Summary</h3>
    Vaccine: <span id="summaryVaccine">-</span><br>
    Schedule: <span id="summarySchedule">-</span><br>
    User: <span id="summaryUser">-</span><br>
    Contact: <span id="summaryPhone">-</span><br>
    Email: <span id="summaryEmail">-</span><br>

    <br><br>
    <button type="submit">Submit Reservation</button>
</form>

<!-- ========== MODAL SELECT VACCINATION ========== -->
<div id="vaccineModal" style="display:none; position:fixed; padding:20px; background:#eee; top:20%; left:25%; width:50%; border:1px solid #000;">
    <h3>Select Vaccination</h3>
    <ul>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM vaccines");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><button type='button' onclick=\"chooseVaccine(".$row['id'].", '".$row['vaccine_name']."')\">".$row['vaccine_name']."</button></li>";
        }
        ?>
    </ul>
    <button onclick="closeVaccineModal()">Close</button>
</div>

<!-- ========== MODAL SELECT SCHEDULE ========== -->
<div id="scheduleModal" style="display:none; position:fixed; padding:20px; background:#eee; top:20%; left:25%; width:50%; border:1px solid #000;">
    <h3>Select Schedule</h3>

    <input type="date" id="datePicker">
    <br><br>
    <button type="button" onclick="selectDate()">Select</button>
    <button onclick="closeScheduleModal()">Close</button>
</div>



<!-- ========== MODAL SELECT USER ========== -->
<div id="userModal" style="display:none; position:fixed; padding:20px; background:#eee; top:15%; left:25%; width:50%; border:1px solid #000;">
    <h3>Select User</h3>

    <h4>Choose Existing User</h4>
    <hr>

    <h4>Add New User</h4>
    <input type="text" id="newName" placeholder="Full Name"><br><br>
    <input type="text" id="newPhone" placeholder="Phone Number"><br><br>
    <input type="email" id="newEmail" placeholder="Email"><br><br>

    <button type="button" onclick="addUser()">Add User</button>
    <br><br>
    <button onclick="closeUserModal()">Close</button>
</div>

<script>
function openVaccineModal() {
    document.getElementById("vaccineModal").style.display = "block";
}

function closeVaccineModal() {
    document.getElementById("vaccineModal").style.display = "none";
}

function chooseVaccine(id, name) {
    document.getElementById("selectedVaccine").innerText = name;
    document.getElementById("summaryVaccine").innerText = name;
    document.getElementById("vaccineInput").value = id; 
    closeVaccineModal();
}
// ===== SCHEDULE MODAL =====
function selectDate() {
    let date = document.getElementById("datePicker").value;

    if (date === "") {
        alert("Please select a date");
        return;
    }

    document.getElementById("selectedSchedule").innerText = date;
    document.getElementById("summarySchedule").innerText = date;
    document.getElementById("scheduleInput").value = date;

    closeScheduleModal();
}


function selectDate() {
    let date = document.getElementById("datePicker").value;

    if (date === "") {
        alert("Please select a date");
        return;
    }

    document.getElementById("selectedSchedule").innerText = date;
    document.getElementById("summarySchedule").innerText = date;
    document.getElementById("scheduleInput").value = date;
    closeScheduleModal();
}


// ===== USER MODAL =====
function openUserModal() {
    document.getElementById("userModal").style.display = "block";
}

function closeUserModal() {
    document.getElementById("userModal").style.display = "none";
}

// Existing user selected
function chooseUser(name, phone, email) {
    updateUser(name, phone, email);
    closeUserModal();
}

// Add new user
function addUser() {
    let name = document.getElementById("newName").value;
    let phone = document.getElementById("newPhone").value;
    let email = document.getElementById("newEmail").value;

    if(name === "" || phone === "" || email === "") {
        alert("Please fill all fields");
        return;
    }

    updateUser(name, phone, email);
    closeUserModal();
}

function updateUser(name, phone, email) {
    document.getElementById("selectedUser").innerText = name;
    document.getElementById("summaryUser").innerText = name;
    document.getElementById("summaryPhone").innerText = phone;
    document.getElementById("summaryEmail").innerText = email;

    document.getElementById("userNameInput").value = name;
    document.getElementById("userPhoneInput").value = phone;
    document.getElementById("userEmailInput").value = email;
}

// ===== PAYMENT MODAL =====
function openPaymentModal() {
    document.getElementById("paymentModal").style.display = "block";
}

function closePaymentModal() {
    document.getElementById("paymentModal").style.display = "none";
}

function choosePayment(method) {
    document.getElementById("selectedPayment").innerText = method;
    document.getElementById("summaryPayment").innerText = method;
    document.getElementById("paymentInput").value = method;
    closePaymentModal();
}

</script>

</body>
</html>

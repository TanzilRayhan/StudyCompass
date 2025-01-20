<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - Manage Loan Plans</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script>
        function fetchLoanPlans() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '../controller/adminLoanController.php?action=fetch', true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const plans = JSON.parse(this.responseText);
                    renderLoanPlans(plans);
                }
            };
            xhr.send();
        }
        
        function renderLoanPlans(plans) {
            const plansContainer = document.getElementById('loan-plans');
            plansContainer.innerHTML = ''; 

            plans.forEach(plan => {
                const rowHTML = `
                    <tr>
                        <td>${plan.id}</td>
                        <td>${plan.name}</td>
                        <td>${plan.interest_rate}%</td>
                        <td>$${plan.max_amount}</td>
                        <td>
                            <button onclick="deletePlan(${plan.id})">Delete</button>
                        </td>
                    </tr>
                `;
                plansContainer.innerHTML += rowHTML;
            });
        }

        function addPlan() {
            const name = document.getElementById('name').value.trim();
            const interestRate = document.getElementById('interest-rate').value.trim();
            const maxAmount = document.getElementById('max-amount').value.trim();

            if (!name || !interestRate || !maxAmount) {
                alert('Please fill in all fields!');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/adminLoanController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status === 200) {
                    alert(JSON.parse(this.responseText).message);
                    fetchLoanPlans();
                }
            };
            xhr.send(`action=add&name=${name}&interest_rate=${interestRate}&max_amount=${maxAmount}`);
        }

        function deletePlan(id) {
            if (!confirm('Are you sure you want to delete this plan?')) return;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/adminLoanController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status === 200) {
                    alert(JSON.parse(this.responseText).message);
                    fetchLoanPlans();
                }
            };
            xhr.send(`action=delete&id=${id}`);
        }

        document.addEventListener('DOMContentLoaded', fetchLoanPlans);
    </script>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>  Manage Loan Plans</h1>
        <form class="loan-form" onsubmit="event.preventDefault(); addPlan();">
            <input type="text" id="name" placeholder="Plan Name" required>
            <input type="number" id="interest-rate" placeholder="Interest Rate (%)" required>
            <input type="number" id="max-amount" placeholder="Max Amount ($)" required>
            <button type="submit">Add Plan</button>
        </form>
        <table class="loan-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Interest Rate</th>
                    <th>Max Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="loan-plans"></tbody>
        </table>
    </div>
</body>

</html>
